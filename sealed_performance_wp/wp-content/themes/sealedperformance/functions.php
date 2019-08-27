<?php
/**
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 */

/*
 * Non-trivial extra functionality to be included from separate .php file stored in theme/functions folder
 * See below for commented example
 */ 
// require_once("functions/queue_css.php");

// Classes
require_once("functions/WP_Custom_Menu.php");

// Assets
require_once("functions/queue-css.php");
require_once("functions/queue-js.php");

// Functionality
require_once("functions/media-settings.php");
require_once("functions/login-form.php");
require_once("functions/admin-functions.php");
require_once("functions/acf-helpers.php");


function the_content_for_id( $post, $word_count = null ) {
  if ( !is_a($post_id, 'WP_Post') ) {
    $post = get_post( $post );
  }

  setup_postdata($post);

  if ( isset( $word_count ) ) {
    echo wp_trim_words( get_the_content(), $word_count, $more = '...' );
  } else {
    the_content();
  } 
  
  wp_reset_postdata();
}

function the_permalink_by_slug($slug) {
  $args = array(
    'name' => $slug,
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
  );
  echo get_permalink( current( get_posts($args) ) );
}


// Return appropriate page title for a static front page site
add_filter( 'wp_title', 'static_front_page_title' );
function static_front_page_title( $title ) {
  if ( function_exists('get_field') && get_field('seo_page_title') ) { 
    
    $title = get_field('seo_page_title');

  } else if( empty( $title ) && ( is_home() || is_front_page() ) ) {

    $title = __( 'Home', 'theme_domain' ) . ' | ' . get_bloginfo( 'name' );

  } else {

    $title = $title . ' | ' . get_bloginfo( 'name' );

  }

  return $title;
}


// Make a particular field into a URL, e.g. if only www. was entered
function make_url($string) {
    if ( strpos($string, 'http://') === false && strpos($string, 'https://') === false ) {
        $string = 'http://'.$string;
    }
    return $string;
}


// Alias for echoing get_template_directory_uri() quickly
function theme_dir( $path = '', $return = false ) {
  if ( is_string( $return ) || is_bool( $path ) ) {
    // Variables are wrong way round swap variables
    list( $return, $path ) = array( $path, $return );
  }

  if ( !is_bool( $return ) ) {
    $return = false;
  }

  if ( !is_string( $path ) ) {
    $path = '';
  }

  $dir = get_template_directory_uri();
  if (substr($dir, -1) !== '/') {
    $dir .= '/';
  }

  if ( strlen( $path ) > 0 && substr( $path, 0, 1 ) === '/' ) {
    $path = substr( $path, 1 );
  }

  $dir .= $path;
  if ( $return ) {
    return $dir;
  } else {
    echo $dir;
  }
}


// Remove version query variable from enqueued styles and scripts
add_filter( 'script_loader_src', 'pu_remove_script_version' );
add_filter( 'style_loader_src', 'pu_remove_script_version' );
function pu_remove_script_version( $src ) {
    return remove_query_arg( 'ver', $src );
}

?>
