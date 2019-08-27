<?php

/**
 * Functions related to modifying the WordPress Admin view
 */

// Add favicon.ico to admin view as well
add_action( 'admin_head', 'add_favicon' );
function add_favicon() {
   $favicon_path = get_template_directory_uri() . '/images/favicons/favicon.ico';
   echo '<link rel="shortcut icon" href="' . $favicon_path . '" />';

   ?>

   <style type="text/css">
 		.acf_postbox.no_box h2 {
	    display: none;
		}
   </style>

   <?php
}


// Change edit post/page admin_title to include post/page title
add_filter('admin_title', 'admin_edit_post_title');
function admin_edit_post_title( $admin_title ) {
  global $pagenow;
  global $post;

  // Make sure we are in the admin view
  // And check we are on edit post/page
  if ( is_admin() && in_array( $pagenow, array( 'post.php' ) ) ) {

  	if ( 'options' == get_post_type() ) {
  		
  		$admin_title = 'Edit Options &lsaquo; '.get_bloginfo( 'name' );

  	} else {

	    $admin_title = 'Edit '.$post->post_title.' &lsaquo; '.get_bloginfo( 'name' );

  	}

  }

  return $admin_title;
}


// Add page_template column to edit view
add_filter( 'manage_edit-page_columns', 'admin_page_header_columns', 10, 1);
add_action( 'manage_pages_custom_column', 'admin_page_data_row', 10, 2);

function admin_page_header_columns($columns) {
  $new_columns = array();

  foreach ($columns as $key => $value) {
    $new_columns[ $key ] = $value;
    if ( $key == 'title' ) {
      $new_columns['page_template'] = "Page Template";
      $new_columns['menu_order'] = "Order";
    }
  }

  return $new_columns;
}

function admin_page_data_row($column_name, $post_id) {
	global $post;

	if ( 'page' == $post->post_type ) {

		switch($column_name) {
			case 'page_template':
				$template_name = get_page_template_slug( $post->ID );

				if( 0 == strlen( trim( $template_name ) ) || !file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {

					$template_name = 'Default';

				} else {

					$template_contents = file_get_contents( get_stylesheet_directory() . '/' . $template_name );

					$pattern = '/Template ';
					$pattern .= 'Name:(.*)\n/';
					preg_match($pattern, $template_contents, $template_name);

					if ( count($template_name) > 0 ) {
				    $template_name = trim($template_name[1]);
					} else {
						$template_name = false;
					}

			    if ( !$template_name ) {
						$template_name = 'Default';
			    }

				}

				$template_name = str_replace('Page Template', '', $template_name);
				echo $template_name;

				break;

			case 'menu_order':
				$menu_order = $post->menu_order;

				$post_ancestors = get_post_ancestors( $post );
				foreach ($post_ancestors as $key => $value) {
					$ancestor = get_post( $value );

					$menu_order = $ancestor->menu_order . '.' . $menu_order;
				}

				echo $menu_order;
				break;

			default:
				break;
		}
		
	}

}
