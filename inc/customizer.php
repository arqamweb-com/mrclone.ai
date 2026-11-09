<?php
/**
 * Customizer settings for MrClone.AI.
 *
 * The design is static; only contact details, social links and the
 * application-form endpoint are editable here.
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the MrClone.AI section and its controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function mrclone_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'mrclone_options',
		array(
			'title'    => __( 'MrClone.AI', 'mrclone-ai' ),
			'priority' => 30,
		)
	);

	$defaults = mrclone_defaults();

	$fields = array(
		'whatsapp'         => array(
			'label'       => __( 'WhatsApp number (digits only)', 'mrclone-ai' ),
			'description' => __( 'With country code, no + or spaces, e.g. 971528160620. Used for every WhatsApp link and for sending applications.', 'mrclone-ai' ),
			'type'        => 'text',
			'sanitize'    => 'mrclone_sanitize_digits',
		),
		'whatsapp_display' => array(
			'label'    => __( 'WhatsApp number (as shown)', 'mrclone-ai' ),
			'type'     => 'text',
			'sanitize' => 'sanitize_text_field',
		),
		'email'            => array(
			'label'    => __( 'Contact email', 'mrclone-ai' ),
			'type'     => 'email',
			'sanitize' => 'sanitize_email',
		),
		'apply_email'      => array(
			'label'       => __( 'Send applications to', 'mrclone-ai' ),
			'description' => __( 'Every application is emailed here and also saved under Applications in the admin menu.', 'mrclone-ai' ),
			'type'        => 'email',
			'sanitize'    => 'sanitize_email',
		),
		'form_endpoint'    => array(
			'label'       => __( 'External webhook (optional, advanced)', 'mrclone-ai' ),
			'description' => __( 'Only if you want applications sent to Make / Zapier / Formspree instead of WordPress email. Leave empty to use WordPress.', 'mrclone-ai' ),
			'type'        => 'url',
			'sanitize'    => 'esc_url_raw',
		),
		'instagram_url'    => array(
			'label'    => __( 'Instagram URL', 'mrclone-ai' ),
			'type'     => 'url',
			'sanitize' => 'esc_url_raw',
		),
		'linkedin_url'     => array(
			'label'    => __( 'LinkedIn URL', 'mrclone-ai' ),
			'type'     => 'url',
			'sanitize' => 'esc_url_raw',
		),
	);

	foreach ( $fields as $key => $f ) {
		$wp_customize->add_setting(
			'mrclone_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => $f['sanitize'],
			)
		);
		$wp_customize->add_control(
			'mrclone_' . $key,
			array(
				'label'       => $f['label'],
				'description' => isset( $f['description'] ) ? $f['description'] : '',
				'section'     => 'mrclone_options',
				'type'        => $f['type'],
			)
		);
	}
}
add_action( 'customize_register', 'mrclone_customize_register' );

/**
 * Keep digits only.
 *
 * @param string $value Raw input.
 * @return string
 */
function mrclone_sanitize_digits( $value ) {
	return preg_replace( '/\D+/', '', (string) $value );
}
