<?php
/**
 * Mr.Clone.AI theme functions.
 *
 * Single-page cinematic theme. Content is intentionally static in the
 * templates (per client decision); the booking link is editable via the
 * Customizer. Packages are static HTML today and left WooCommerce-ready
 * for the future (see front-page.php → #packages).
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MRCLONE_VERSION', '1.0.0' );

require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/setup.php';

/**
 * Theme supports.
 */
function mrclone_after_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'menus' );

	// The design has a minimal header (brand + one CTA) and a text-only
	// footer — there is no multi-item link list. We still register a
	// "primary" location so a menu can be added later from Appearance → Menus.
	register_nav_menus(
		array(
			'primary' => __( 'Header (optional links)', 'mrclone-ai' ),
		)
	);
}
add_action( 'after_setup_theme', 'mrclone_after_setup_theme' );

/**
 * Enqueue styles and scripts.
 */
function mrclone_enqueue_assets() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	// Design CSS (fonts are embedded inside it as woff2 data URIs).
	wp_enqueue_style(
		'mrclone-styles',
		$uri . '/assets/css/styles.css',
		array(),
		file_exists( "$dir/assets/css/styles.css" ) ? filemtime( "$dir/assets/css/styles.css" ) : MRCLONE_VERSION
	);

	$v = function ( $rel ) use ( $dir ) {
		return file_exists( "$dir/$rel" ) ? filemtime( "$dir/$rel" ) : MRCLONE_VERSION;
	};

	// Failsafe loader guard — load early, in the head.
	wp_enqueue_script( 'mrclone-failsafe', $uri . '/assets/js/failsafe.js', array(), $v( 'assets/js/failsafe.js' ), false );

	// Vendor libraries (order matters): GSAP → ScrollTrigger → Lenis.
	wp_enqueue_script( 'mrclone-gsap', $uri . '/assets/js/vendor-gsap.js', array(), $v( 'assets/js/vendor-gsap.js' ), true );
	wp_enqueue_script( 'mrclone-scrolltrigger', $uri . '/assets/js/vendor-scrolltrigger.js', array( 'mrclone-gsap' ), $v( 'assets/js/vendor-scrolltrigger.js' ), true );
	wp_enqueue_script( 'mrclone-lenis', $uri . '/assets/js/vendor-lenis.js', array(), $v( 'assets/js/vendor-lenis.js' ), true );

	// App / cinematic scroll engine.
	wp_enqueue_script(
		'mrclone-app',
		$uri . '/assets/js/app.js',
		array( 'mrclone-gsap', 'mrclone-scrolltrigger', 'mrclone-lenis' ),
		$v( 'assets/js/app.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mrclone_enqueue_assets' );

/**
 * Booking / consultation URL used by every CTA.
 * Editable under Appearance → Customize → Mr.Clone.AI.
 *
 * @return string
 */
function mrclone_booking_url() {
	$url = get_theme_mod( 'mrclone_booking_url', 'https://calendly.com/mrclone' );
	return esc_url( $url );
}

/**
 * Keep <body> classes clean so WordPress-generated classes never fight the
 * design CSS. Only whitelist the handful WP genuinely needs.
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
