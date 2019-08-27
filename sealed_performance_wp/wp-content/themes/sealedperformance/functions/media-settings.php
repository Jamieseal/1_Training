<?php

/**
 * Handle WordPress media settings
 */

add_filter( 'init', 'media_add_image_sizes' );
function media_add_image_sizes () {
  // Set medium & large to non-proportional crop
  update_option("medium_crop", "1");
  update_option("large_crop", "1");

  // Add other images
  $image_sizes = array(
    array (
      'name' => 'gallery',
      'width' => 300,
      'height' => 200,
      'crop' => true
    )
  );

  foreach ($image_sizes as $size) {
    add_image_size( 
      $size['name'],
      $size['width'],
      $size['height'],
      $size['crop']
    );
  }
}

/**
 * Get an image attachment from the media library.
 *
 * @param integer $image_id The image attachment to get.
 * @param string $size Optional, The size of the image attachment to get, e.g. 'full', 'thumbnail'. 'full' is used by default.
 *
 * @return array An array containing the image src, width & height and the alt text.
 */
function media_get_image( $image_id, $size = 'full' ) {
  if ( $image = wp_get_attachment_image_src( $image_id, $size ) ) {
    return array(
      'src' => $image[0],
      'width' => $image[1],
      'height' => $image[2],
      'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
    );
  }
} 

/**
 * Get the attributes for an image attachment from the media library.
 *
 * @param integer $image_id The image attachment to get.
 * @param string $size Optional, The size of the image attachment to get, e.g. 'full', 'thumbnail'. 'full' is used by default.
 *
 * @return string The attributes needed to output the image.
 */
function media_get_image_attributes( $image_id, $size = 'full' ) {
  $image = ama6_get_image( $image_id, $size );

  if ( !$image ) {
    return false;
  }

  return sprintf(
    'src="%s" alt="%s" width="%s" height="%s"',
    $image['src'],
    $image['alt'],
    $image['width'],
    $image['height']
  );
}

/**
  * Show custom avatar (if added)
  * Requires a custom field called user_avatar to be added to the User profile page
  */ 
add_filter( 'get_avatar' , 'media_admin_custom_avatar' , 1 , 4 );
function media_admin_custom_avatar( $avatar, $id_or_email, $size, $default = '', $alt = '' ) {
  if ( is_admin() ) {
    return $avatar;
  }

  $user = false;

  if ( is_numeric( $id_or_email ) ) {
    $user_id = (integer)$id_or_email;
    $user = get_user_by( 'id', $user_id ); 

  } else if ( is_object( $id_or_email ) ) {

    if ( !empty( $id_or_email->user_id ) ) {
      $user_id = (integer)$id_or_email->user_id;
      $user = get_user_by( 'id', $user_id ); 
    }

  } else {
    $user = get_user_by( 'email', $id_or_email ); 
  }

  if ( $user && is_object( $user ) ) {

    $avatar_src = get_user_meta( $user->ID, 'user_avatar', true );
    if ( '' === $avatar_src ) {
      $avatar_src = false;
    }

    if ( $avatar_src ) {
      
      $result = preg_match( '/class\b=[\"\']([^\"\']*)[\"\']/', $avatar, $matches );
      $original_class = $matches[1]; 
      
      $avatar = sprintf(
        '<img src="%s" alt="%s" class="post__author--image %s" width="%s" />',
        $avatar_src['url'],
        $alt,
        $original_class,
        $size
      );

    } else {

      $avatar = str_replace( "class='", "class='post__author--image ", $avatar);

    }

  }

  return $avatar;
}
