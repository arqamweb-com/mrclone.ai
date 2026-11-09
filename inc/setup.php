<?php
/**
 * One-time setup for MrClone.AI.
 *
 * This is a single-page theme: WordPress serves front-page.php on the site
 * root automatically, so the theme works with zero configuration. Setup here
 * just makes the admin coherent — it creates a "Home" page, marks it as the
 * static front page, and ensures pretty permalinks. It registers NO post
 * types (there are no separate detail pages in this design).
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Run idempotent setup when the theme is activated.
 */
function mrclone_run_setup() {
	// 1) Ensure a "Home" page exists.
	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		$home_id = wp_insert_post(
			array(
				'post_title'   => 'Home',
				'post_name'    => 'home',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
	} else {
		$home_id = $home->ID;
	}

	// 2) Make it the static front page.
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	// 3) Pretty permalinks (needed for clean URLs / future CPTs).
	if ( '' === get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		update_option( 'permalink_structure', '/%postname%/' );
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$wp_rewrite->flush_rules();
	}

	update_option( 'mrclone_setup_done', MRCLONE_VERSION );
}
add_action( 'after_switch_theme', 'mrclone_run_setup' );

/**
 * Admin notice if setup has not been recorded yet.
 */
function mrclone_setup_notice() {
	if ( get_option( 'mrclone_setup_done' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$url = admin_url( 'themes.php?page=mrclone-setup' );
	echo '<div class="notice notice-info"><p><strong>MrClone.AI</strong> — ';
	echo 'finish setup: <a href="' . esc_url( $url ) . '">open the setup screen</a>.</p></div>';
}
add_action( 'admin_notices', 'mrclone_setup_notice' );

/**
 * Register the setup screen under Appearance.
 */
function mrclone_setup_menu() {
	add_theme_page(
		__( 'MrClone.AI Setup', 'mrclone-ai' ),
		__( 'MrClone.AI Setup', 'mrclone-ai' ),
		'manage_options',
		'mrclone-setup',
		'mrclone_setup_page'
	);
}
add_action( 'admin_menu', 'mrclone_setup_menu' );

/**
 * Render the setup screen: status + a Run Setup button.
 */
function mrclone_setup_page() {
	if ( isset( $_POST['mrclone_run'] ) && check_admin_referer( 'mrclone_setup' ) ) {
		mrclone_run_setup();
		echo '<div class="notice notice-success"><p>Setup complete.</p></div>';
	}

	$home        = get_page_by_path( 'home' );
	$front_ok    = ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) === ( $home ? $home->ID : 0 ) );
	$permalink   = get_option( 'permalink_structure' );
	$endpoint    = mrclone_opt( 'form_endpoint' );

	$row = function ( $label, $ok, $detail = '' ) {
		printf(
			'<tr><td>%s</td><td>%s</td><td style="color:#666">%s</td></tr>',
			esc_html( $label ),
			$ok ? '<span style="color:#0a0">&#10003; OK</span>' : '<span style="color:#c00">&#10007; Missing</span>',
			esc_html( $detail )
		);
	};
	?>
	<div class="wrap">
		<h1>MrClone.AI Setup</h1>
		<p>This is a single-page theme. WordPress serves the design on the home
		URL automatically. Use the checklist below to keep the admin tidy.</p>

		<table class="widefat" style="max-width:720px">
			<thead><tr><th>Item</th><th>Status</th><th>Detail</th></tr></thead>
			<tbody>
				<?php
				$row( 'Home page exists', (bool) $home, $home ? 'ID ' . $home->ID : 'not created yet' );
				$row( 'Static front page', $front_ok, $front_ok ? 'Home is the front page' : 'Reading settings not pointed at Home' );
				$row( 'Pretty permalinks', '' !== $permalink, $permalink ? $permalink : 'still using plain ?p= URLs' );
				$row( 'WhatsApp number set', '' !== mrclone_opt( 'whatsapp' ), mrclone_opt( 'whatsapp_display' ) );
				$row( 'Applications email', is_email( mrclone_opt( 'apply_email' ) ), $endpoint ? 'External webhook: ' . $endpoint : mrclone_opt( 'apply_email' ) );
				?>
			</tbody>
		</table>

		<form method="post" style="margin-top:18px">
			<?php wp_nonce_field( 'mrclone_setup' ); ?>
			<button type="submit" name="mrclone_run" class="button button-primary">Run / re-run setup</button>
		</form>

		<h2>Notes</h2>
		<ul style="list-style:disc;margin-left:20px;max-width:720px">
			<li>Contact details, social links and the application-form endpoint live under <em>Appearance &rarr; Customize &rarr; MrClone.AI</em>.</li>
			<li>To swap a film, replace the file in <code>assets/videos</code> with one of the same name (.mp4, H.264).</li>
			<li>After activating, visit <em>Settings &rarr; Permalinks &rarr; Save</em> once to flush rewrite rules.</li>
		</ul>
	</div>
	<?php
}
