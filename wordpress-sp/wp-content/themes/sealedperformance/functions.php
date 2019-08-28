<?php

function load_stylesheets() {

wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 1, 'all');
wp_enqueue_style('bootstrap');

wp_register_style('styles', get_template_directory_uri() . '/css/styles.css', array(), 1, 'all');
wp_enqueue_style('styles');

wp_register_script('js', get_template_directory_uri() . '/js/script.js', array(), 1, 1, 1,);
wp_enqueue_script('js');

}

add_action('wp_enqueue_scripts', 'load_stylesheets');


// Menu support
add_theme_support('menus');

// Register menus
register_nav_menus(

	array('top-menu' => __('Top Menu', 'theme'),)

);









?>