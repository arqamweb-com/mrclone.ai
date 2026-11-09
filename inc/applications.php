<?php
/**
 * Application form: REST endpoint, email notification and an admin log.
 *
 * The front-end form POSTs JSON to /wp-json/mrclone/v1/apply. Each valid
 * application is saved as a private "Application" post (so nothing is lost if
 * the server can't send mail) and emailed to the address set under
 * Appearance → Customize → MrClone.AI.
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field map: key => label. Order is the order used in emails and the admin.
 *
 * @return array
 */
function mrclone_application_fields() {
	return array(
		'name'     => 'Name',
		'email'    => 'Email',
		'whatsapp' => 'WhatsApp',
		'link'     => 'Instagram / site',
		'plan'     => 'Plan',
		'audience' => 'Audience',
		'budget'   => 'Budget',
		'start'    => 'Start',
		'goal'     => 'Goal',
	);
}

/**
 * Private post type that keeps a copy of every application.
 */
function mrclone_register_application_cpt() {
	register_post_type(
		'mrclone_application',
		array(
			'labels'          => array(
				'name'          => __( 'Applications', 'mrclone-ai' ),
				'singular_name' => __( 'Application', 'mrclone-ai' ),
				'all_items'     => __( 'All applications', 'mrclone-ai' ),
				'edit_item'     => __( 'Application', 'mrclone-ai' ),
				'search_items'  => __( 'Search applications', 'mrclone-ai' ),
				'not_found'     => __( 'No applications yet.', 'mrclone-ai' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_rest'    => false,
			'menu_icon'       => 'dashicons-id-alt',
			'menu_position'   => 25,
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'mrclone_register_application_cpt' );

/**
 * REST route.
 */
function mrclone_register_apply_route() {
	register_rest_route(
		'mrclone/v1',
		'/apply',
		array(
			'methods'             => 'POST',
			'callback'            => 'mrclone_handle_application',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'mrclone_register_apply_route' );

/**
 * Validate, store and email an application.
 *
 * @param WP_REST_Request $request Request.
 * @return WP_REST_Response|WP_Error
 */
function mrclone_handle_application( WP_REST_Request $request ) {
	$params = $request->get_json_params();
	if ( ! is_array( $params ) ) {
		$params = $request->get_body_params();
	}

	// Honeypot: real visitors never see or fill this field. Pretend success.
	if ( ! empty( $params['company_website'] ) ) {
		return new WP_REST_Response( array( 'ok' => true ), 200 );
	}

	// Basic rate limit: 5 applications per IP per 10 minutes.
	$ip    = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$rkey  = 'mrclone_apply_' . md5( $ip );
	$count = (int) get_transient( $rkey );
	if ( $count >= 5 ) {
		return new WP_Error( 'mrclone_rate_limited', 'Too many applications. Please try again later.', array( 'status' => 429 ) );
	}

	$data = array();
	foreach ( array_keys( mrclone_application_fields() ) as $key ) {
		$raw          = isset( $params[ $key ] ) ? (string) $params[ $key ] : '';
		$data[ $key ] = 'goal' === $key ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
		$data[ $key ] = mb_substr( $data[ $key ], 0, 'goal' === $key ? 3000 : 200 );
	}
	$data['email'] = sanitize_email( $data['email'] );
	if ( '' === $data['plan'] ) {
		$data['plan'] = 'Not sure yet';
	}

	$required = array( 'name', 'email', 'whatsapp', 'link', 'audience', 'budget', 'start' );
	foreach ( $required as $key ) {
		if ( '' === $data[ $key ] ) {
			return new WP_Error( 'mrclone_missing_field', 'Missing field: ' . $key, array( 'status' => 400 ) );
		}
	}
	if ( ! is_email( $data['email'] ) ) {
		return new WP_Error( 'mrclone_bad_email', 'Invalid email address.', array( 'status' => 400 ) );
	}

	set_transient( $rkey, $count + 1, 10 * MINUTE_IN_SECONDS );

	// 1) Keep a copy in the admin.
	$post_id = wp_insert_post(
		array(
			'post_type'   => 'mrclone_application',
			'post_status' => 'private',
			'post_title'  => $data['name'] . ' — ' . $data['plan'],
		),
		true
	);
	if ( ! is_wp_error( $post_id ) ) {
		foreach ( $data as $key => $value ) {
			update_post_meta( $post_id, '_mrclone_' . $key, $value );
		}
	}

	// 2) Email it.
	$lines = array();
	foreach ( mrclone_application_fields() as $key => $label ) {
		if ( '' !== $data[ $key ] ) {
			$lines[] = $label . ': ' . $data[ $key ];
		}
	}
	$body  = "New MrClone.AI application\n\n" . implode( "\n", $lines );
	$body .= "\n\nReply to this email to answer " . $data['name'] . ' directly.';
	if ( ! is_wp_error( $post_id ) ) {
		$body .= "\nIn WordPress: " . admin_url( 'post.php?post=' . $post_id . '&action=edit' );
	}

	$to      = mrclone_opt( 'apply_email' );
	$to      = is_email( $to ) ? $to : get_option( 'admin_email' );
	$subject = sprintf( 'New application: %s (%s)', $data['name'], $data['plan'] );
	$headers = array( 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>' ), '', $data['name'] ) . ' <' . $data['email'] . '>' );
	$sent    = wp_mail( $to, $subject, $body, $headers );

	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_mrclone_mail_sent', $sent ? 'yes' : 'no' );
	}

	// Saved or emailed counts as received; only fail if both failed.
	if ( ! $sent && is_wp_error( $post_id ) ) {
		return new WP_Error( 'mrclone_not_sent', 'The application could not be sent.', array( 'status' => 500 ) );
	}

	return new WP_REST_Response( array( 'ok' => true ), 200 );
}

/**
 * Admin: show the application details on the edit screen.
 */
function mrclone_application_metabox() {
	add_meta_box(
		'mrclone_application_details',
		__( 'Application details', 'mrclone-ai' ),
		'mrclone_render_application_metabox',
		'mrclone_application',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mrclone_application_metabox' );

/**
 * Render the details table.
 *
 * @param WP_Post $post Application post.
 */
function mrclone_render_application_metabox( $post ) {
	echo '<table class="widefat striped"><tbody>';
	foreach ( mrclone_application_fields() as $key => $label ) {
		$value = (string) get_post_meta( $post->ID, '_mrclone_' . $key, true );
		if ( 'email' === $key && $value ) {
			$value_html = '<a href="mailto:' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a>';
		} elseif ( 'whatsapp' === $key && $value ) {
			$value_html = '<a href="' . esc_url( 'https://wa.me/' . preg_replace( '/\D+/', '', $value ) ) . '" target="_blank" rel="noopener">' . esc_html( $value ) . '</a>';
		} else {
			$value_html = nl2br( esc_html( $value ) );
		}
		printf( '<tr><th style="width:180px">%s</th><td>%s</td></tr>', esc_html( $label ), $value_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	$sent = get_post_meta( $post->ID, '_mrclone_mail_sent', true );
	printf( '<tr><th>Email notification</th><td>%s</td></tr>', 'yes' === $sent ? 'Sent' : '<strong style="color:#b32d2e">Not sent (check your site\'s mail setup)</strong>' );
	echo '</tbody></table>';
}

/**
 * Admin list columns.
 *
 * @param array $cols Columns.
 * @return array
 */
function mrclone_application_columns( $cols ) {
	return array(
		'cb'       => $cols['cb'],
		'title'    => __( 'Applicant', 'mrclone-ai' ),
		'email'    => __( 'Email', 'mrclone-ai' ),
		'whatsapp' => __( 'WhatsApp', 'mrclone-ai' ),
		'budget'   => __( 'Budget', 'mrclone-ai' ),
		'date'     => $cols['date'],
	);
}
add_filter( 'manage_mrclone_application_posts_columns', 'mrclone_application_columns' );

/**
 * Admin list column values.
 *
 * @param string $col     Column key.
 * @param int    $post_id Post ID.
 */
function mrclone_application_column_values( $col, $post_id ) {
	if ( in_array( $col, array( 'email', 'whatsapp', 'budget' ), true ) ) {
		echo esc_html( (string) get_post_meta( $post_id, '_mrclone_' . $col, true ) );
	}
}
add_action( 'manage_mrclone_application_posts_custom_column', 'mrclone_application_column_values', 10, 2 );
