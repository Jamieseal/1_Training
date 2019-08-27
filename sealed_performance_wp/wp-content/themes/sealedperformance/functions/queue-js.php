<?php

/**
 * Registers and queues the scripts that the theme requires.
 *
 */

define("JS_DIRECTORY", get_template_directory_uri()."/js/");


add_action("wp_enqueue_scripts", "enqueue_theme_scripts");

function enqueue_theme_scripts() {
	global $post, $is_IE;

	if ( !is_admin() ) {
		// Load specific jQuery library
		wp_deregister_script("jquery");
		wp_register_script("jquery", "//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", false, false, true);
		wp_enqueue_script("jquery");


		// Load Custom JS
		wp_register_script ("featherlight", JS_DIRECTORY."featherlight.js", array( 'jquery' ), false, true);
		wp_enqueue_script ("featherlight");
		
		wp_register_script ("featherlight-gallery", JS_DIRECTORY."featherlight-gallery.js", array( 'jquery' ), false, true);
		wp_enqueue_script ("featherlight-gallery");

		// Load IE specific HTML 5 Javascript library
		if ($is_IE) {
    		wp_register_script ("html5shiv", "http://html5shiv.googlecode.com/svn/trunk/html5.js", false);
    		wp_enqueue_script ("html5shiv");
    	} 
	}	
}
