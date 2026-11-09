<?php
/**
 * MrClone.AI theme functions.
 *
 * Single-page theme. Content is static in front-page.php; contact details,
 * social links and the application-form endpoint are editable under
 * Appearance → Customize → MrClone.AI.
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MRCLONE_VERSION', '2.0.0' );

require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/applications.php';

/**
 * Theme supports.
 */
function mrclone_after_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'mrclone_after_setup_theme' );

/**
 * Default values for every Customizer option.
 *
 * @return array
 */
function mrclone_defaults() {
	return array(
		'whatsapp'         => '971528160620',
		'whatsapp_display' => '+971 52 816 0620',
		'email'            => 'hello@mrclone.ai',
		'apply_email'      => 'hello@mrclone.ai',
		'form_endpoint'    => '',
		'instagram_url'    => 'https://www.instagram.com/mr.clone.ai',
		'linkedin_url'     => 'https://www.linkedin.com/in/mabroukothman/',
	);
}

/**
 * Read a theme option, falling back to its default.
 *
 * @param string $key Option key without the "mrclone_" prefix.
 * @return string
 */
function mrclone_opt( $key ) {
	$defaults = mrclone_defaults();
	$value    = get_theme_mod( 'mrclone_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
	return is_string( $value ) ? $value : '';
}

/**
 * WhatsApp chat link for the configured number.
 *
 * @return string
 */
function mrclone_whatsapp_url() {
	return 'https://wa.me/' . preg_replace( '/\D+/', '', mrclone_opt( 'whatsapp' ) );
}

/**
 * Echo the URL of a file inside assets/.
 *
 * @param string $path Path relative to assets/, e.g. "images/ramses.jpg".
 */
function mrclone_asset( $path ) {
	echo esc_url( get_template_directory_uri() . '/assets/' . ltrim( $path, '/' ) );
}

/**
 * Link to an on-page section. Bare "#id" on the front page, "home/#id" elsewhere
 * (e.g. the 404 page) so the nav still works.
 *
 * @param string $id Section id without "#".
 * @return string
 */
function mrclone_anchor( $id ) {
	return ( is_front_page() ? '' : home_url( '/' ) ) . '#' . $id;
}

/**
 * Enqueue styles and scripts.
 */
function mrclone_enqueue_assets() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	$ver = function ( $rel ) use ( $dir ) {
		return file_exists( "$dir/$rel" ) ? (string) filemtime( "$dir/$rel" ) : MRCLONE_VERSION;
	};

	wp_enqueue_style(
		'mrclone-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Instrument+Sans:wght@400;500;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'mrclone-main', $uri . '/assets/css/main.css', array( 'mrclone-fonts' ), $ver( 'assets/css/main.css' ) );

	// The script drives the hero film, players, form etc. — none of which exist on the 404 page.
	if ( is_404() ) {
		return;
	}

	wp_enqueue_script( 'mrclone-main', $uri . '/assets/js/main.js', array(), $ver( 'assets/js/main.js' ), true );
	wp_localize_script(
		'mrclone-main',
		'MRCLONE',
		array(
			'formEndpoint' => esc_url_raw( mrclone_opt( 'form_endpoint' ) ),
			'whatsapp'     => preg_replace( '/\D+/', '', mrclone_opt( 'whatsapp' ) ),
			'applyUrl'     => esc_url_raw( rest_url( 'mrclone/v1/apply' ) ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mrclone_enqueue_assets' );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function mrclone_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'mrclone_resource_hints', 10, 2 );

/**
 * Meta description + Open Graph tags. Skipped when an SEO plugin is active
 * so the tags are never printed twice.
 */
function mrclone_meta_tags() {
	echo '<meta name="theme-color" content="#06080A">' . "\n";

	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) ) {
		return;
	}
	$desc = 'MrClone.AI builds your AI Twin from one filming day, then writes, produces and publishes short-form video for you every month. Dubai, serving clients worldwide.';
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( 'MrClone.AI — Meet your Twin' ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( 'Film once. Show up everywhere. An approved AI Twin of you, producing content every week without you going back to camera.' ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( home_url( '/' ) ) );
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:image" content="';
	mrclone_asset( 'images/og-mrclone.jpg' );
	echo '">' . "\n";
}
add_action( 'wp_head', 'mrclone_meta_tags', 1 );

/**
 * Keep <body> classes clean so WordPress-generated classes never fight the
 * design CSS. Only whitelist the handful WP genuinely needs.
 *
 * @param array $classes Body classes.
 * @return array
 */
function mrclone_body_class( $classes ) {
	$keep = array( 'logged-in', 'admin-bar', 'rtl' );
	return array_values( array_intersect( $classes, $keep ) );
}
add_filter( 'body_class', 'mrclone_body_class' );

/**
 * Strip <head> cruft that clashes with a bespoke design.
 */
function mrclone_clean_head() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'mrclone_clean_head' );

/**
 * Dequeue the block-editor front-end CSS — this theme ships its own system.
 */
function mrclone_remove_block_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'mrclone_remove_block_css', 100 );
