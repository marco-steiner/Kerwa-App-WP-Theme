<?php
/**
 * Check and setup theme's default settings
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kerwaapp_setup_theme_default_settings' ) ) {
	function kerwaapp_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$kerwaapp_posts_index_style = get_theme_mod( 'kerwaapp_posts_index_style' );
		if ( '' == $kerwaapp_posts_index_style ) {
			set_theme_mod( 'kerwaapp_posts_index_style', 'default' );
		}

		// Sidebar position.
		$kerwaapp_sidebar_position = get_theme_mod( 'kerwaapp_sidebar_position' );
		if ( '' == $kerwaapp_sidebar_position ) {
			set_theme_mod( 'kerwaapp_sidebar_position', 'right' );
		}

		// Container width.
		$kerwaapp_container_type = get_theme_mod( 'kerwaapp_container_type' );
		if ( '' == $kerwaapp_container_type ) {
			set_theme_mod( 'kerwaapp_container_type', 'container' );
		}
	}
}
