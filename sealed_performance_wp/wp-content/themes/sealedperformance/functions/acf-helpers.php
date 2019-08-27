<?php

if ( class_exists( 'acf' ) ) {

  /**
   * Change the order of custom fields (created by plugins) on edit pages
   */
  add_filter( 'acf/input/meta_box_priority', 'acf_priority_change' );
  function acf_priority_change () {
    return 'high';
  }

  add_filter( 'wck_add_meta_box_priority', 'wck_priority_change' );
  function wck_priority_change () {
    return 'core';
  }

  /**
   * If the options post type is defined and we are on it's admin edit page, go to the first post instead of the listing
   */
  add_action('current_screen', 'acf_redirect_options_post_type', 999);
  function acf_redirect_options_post_type() {
    if ( is_admin() ) {
      $admin_page = get_current_screen();

      if ( ( 'edit' == $admin_page->base || 'add' == $admin_page->action ) && 'options' == $admin_page->post_type ) {
        $options_posts = get_posts( 'post_type=options&posts_per_page=1&post_status=any' );

        if ( count($options_posts) > 0 ) {
          
          $options_posts = array_shift($options_posts);

          wp_redirect( get_edit_post_link( $options_posts->ID, '' ) );
          exit();

        } else {

          $post_array = array(
            'post_status' => 'publish',
            'post_title' => 'Options',
            'post_name' => 'option',
            'post_type' => 'options',
          );
          $post_id = wp_insert_post( $post_array, true );

          if ( !is_wp_error($post_id) ) {
            wp_redirect( get_edit_post_link( $post_id, '' ) );
            exit();
          }

        }
      }
    }
  }

  /**
   * Get a site option field.
   *
   * @param string $field The field key to get.
   * @param string $type The type of field, contact or social.
   *
   * @return string The field value.
   */
  function acf_get_option( $field ) {
    $options_posts = get_posts( 'post_type=options&posts_per_page=1' );

    if ( count($options_posts) > 0 ) {
      $options_posts = array_shift($options_posts);
      return get_field( $field, $options_posts->ID );
    }

    return '';
  }
  function acf_the_option( $field, $type = 'contact' ) {
    echo acf_get_option( $field, $type );
  }


  /**
     * Find part of an image object from the ACF Plugin
     *  @return
     *  To return the part found (as a variable) use get_image_field()
     *  To echo it straight to the page use the_image_field()
     *
     * $post_id and $properties parameters are interchangeable
     * and can be specified in any order
     *
     * @param  $field @type string 
     *    The field name you want to get values from
     *
     * @param  $post_id @type integer @optional 
     *    The post ID to find values for. If omitted, the current post ID is used
     *
     * @param  $properties @type string @optional 
     *    A list of the properties you want to return, separated by a forward slash, e.g. 'sizes/thumbnail' or 'url'
     *    If omitted, the image URL will be returned
     */
  function get_image_field($field, $post_id = 0, $properties = '') {
    // Reset variables if the order is muddled
    if (is_string($post_id) && $properties === '') {
      // $post_id has not been passed and only properties has
      $properties = $post_id;
      $post_id = 0;
    } else if (is_string($post_id) ) {
      // $post_id has been passed as the properties field and vice versa, swap their order
      list($post_id, $properties) = array($properties, $post_id);
    }

    global $post; // Get current post ID, if not passed
    $post_id = ($post_id === 0 ? $post->ID : $post_id);

    // If $field is a key, retrieve it. If it is already an ACF Image object assign it.
    if ( is_string( $field ) ) {
      $imageObj = get_field( $field, $post_id );
    } else {
      $imageObj = $field;
    }

    if ($properties === '') {
      return $imageObj['url'];
    }
    $tempObj = $imageObj;
    $properties = explode('/', $properties);
    foreach ($properties as $property) {
      if ( !isset( $tempObj[ $property ] ) ) {
        $tempObj = "$property doesn't exist on the image object";
        break;
      }
      $tempObj = $tempObj[$property];
    }
    return $tempObj;
  }

  function the_image_field($field, $post_id = 0, $properties = '') {
    echo get_image_field($field, $post_id, $properties);
  }


  /**
     * Find part of an image object from the ACF Plugin
     *  @return
     *  To return the part found (as a variable) use get_sub_image_field()
     *  To echo it straight to the page use the_sub_image_field()
     *
     * @param  $field @type string 
     *    The field name you want to get values from.
     *
     * @param  $properties @type string @optional 
     *    A list of the properties you want to return, separated by a forward slash, e.g. 'sizes/thumbnail' or 'url'
     *    If omitted, the image URL will be returned
     */
  function get_sub_image_field( $field, $properties = '' ) {
    
    // If $field is a key, retrieve it. If it is already an ACF Image object assign it.
    if ( is_string( $field ) ) {
      $imageObj = get_sub_field( $field );
    } else {
      $imageObj = $field;
    }

    if ($properties === '') {
      return $imageObj['url'];
    }
    $tempObj = $imageObj;
    $properties = explode('/', $properties);
    foreach ($properties as $property) {
      if ( !isset( $tempObj[ $property ] ) ) {
        $tempObj = "$property doesn't exist on the image object";
        break;
      }
      $tempObj = $tempObj[$property];
    }
    return $tempObj;
  }

  function the_sub_image_field( $field, $properties = '' ) {
    echo get_sub_image_field( $field, $properties );
  }

}
