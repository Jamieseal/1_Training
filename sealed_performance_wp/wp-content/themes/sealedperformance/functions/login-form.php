<?php

/**
 * Any actions and scripts that modify the WordPress Login form
 */

// Modify WP Login form to show clients logo
add_action( 'login_enqueue_scripts', 'client_login_logo' );
function client_login_logo() { 
    /* Get logo.png image from client theme folder */
    $img_path = get_template_directory_uri().'/images/logo.png';
    
    /* Set size of logo */
    /* Should be no bigger than WordPress Login form, width: 320px; */
    $width = '100px';
    $height = '100px';
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            width: <?php echo $width; ?>;
            height: <?php echo $height; ?>;
            background-size: <?php echo $width; ?> <?php echo $height; ?>;
            background-image: url(<?php echo $img_path; ?>);
        }
    </style>
<?php }

add_filter( 'login_headerurl', 'client_login_url' );
function client_login_url() {
    return home_url();
}

add_filter( 'login_headertitle', 'client_login_title' );
function client_login_title() {
    return get_bloginfo( 'name' );
}
