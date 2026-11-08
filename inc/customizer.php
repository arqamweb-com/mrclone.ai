<?php
/**
 * Customizer settings for Mr.Clone.AI.
 *
 * Keeps the design fully static except for the one thing the client will
 * realistically change often: the booking / consultation link.
 *
 * @package MrCloneAI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the booking URL control.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function mrclone_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'mrclone_options',
		array(
			'title'    => __( 'Mr.Clone.AI', 'mrclone-ai' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'mrclone_booking_url',
		array(
			'default'           => 'https://calendly.com/mrclone',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'mrclone_booking_url',
		array(
			'label'       => __( 'Booking / consultation link', 'mrclone-ai' ),
			'description' => __( 'Every "Free Consultation" and package button opens this URL (Calendly by default).', 'mrclone-ai' ),
			'section'     => 'mrclone_options',
			'type'        => 'url',
		)
	);
}
add_action( 'customize_register', 'mrclone_customize_register' );
