<?php
/**
 * Registers and queues the stylesheets that the theme requires.
 *
 */

define("CSS_DIRECTORY", get_template_directory_uri()."/css/");


add_action("wp_enqueue_scripts", "enqueue_theme_stylesheets");

function enqueue_theme_stylesheets() {
	global $post;
	
	if( !is_admin() ) {
		// Load Font Awesome CSS
		wp_register_style("font-awesome", "//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", false);
		wp_enqueue_style("font-awesome");
		
		// Load default theme stylesheet
		wp_register_style("theme_css", CSS_DIRECTORY."style.css", false);
		wp_enqueue_style("theme_css");

		wp_register_style("featherlight", CSS_DIRECTORY."featherlight.css", false);
		wp_enqueue_style("featherlight");
	}
}
