<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <title><?php trim(wp_title('')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
        $meta_description = '';

        // Try and get the meta description from the post/page
        if ( function_exists('get_field') ) {
            $meta_description = get_field('seo_meta_description');
        }

        if ( false === $meta_description || '' === $meta_description ) {
            while ( have_posts() ) {
                the_post();
                $meta_description = ( function_exists('get_field') && get_field('extract') ? get_field('extract') : strip_tags( get_the_excerpt() ) );
            }
        }

        // If still have nothing get the blog's description
        if ( false === $meta_description || '' === $meta_description ) {
            $meta_description = get_bloginfo('description');
        }
    ?>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- FAVICONS -->
    <!-- Add theme here -->

    <!-- OPEN GRAPH ATTRIBUTES -->
    <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
    <meta property="og:title" content="<?php trim( wp_title('') ) ?>" />
    <?php while ( have_posts() ): the_post(); ?>
        <meta property="og:description" content="<?php echo ( function_exists('get_field') && get_field('extract') ? get_field('extract') : strip_tags( get_the_excerpt() ) ) ?>" />
    <?php endwhile; ?>

    <?php if ( is_singular('post') ): ?>

        <?php if ( get_field('image') ): ?>
            <meta property="og:image" content="<?php the_image_field( 'image' ) ?>" />
        <?php endif; ?>
        
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
    
    <header class="header clearfix">

        <div class="container">

            <div class="column column--1-4">

                <img class="u-image-block" src="<?php theme_dir(); ?>/images/logo.png" />

            </div>

            <div class="column column--3-4">

                <div class="row">

                    <div class="header__social social">

                        <a href="https://www.facebook.com/sealedperformance" target="_blank">
                            <span class="fa-stack">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-stack-1x fa-facebook"></i>
                            </span>
                        </a>

                        <a href="" target="_blank">
                            <span class="fa-stack">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-stack-1x fa-twitter"></i>
                            </span>
                        </a>

                        <a href="https://www.instagram.com/sealedperformance/" target="_blank">
                            <span class="fa-stack">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-stack-1x fa-instagram"></i>
                            </span>
                        </a>

                    </div>

                    <div class="header__contact">

                        <a href="tel:07988017557">07988 017557</a> | 
                        <a href="mailto:sealed-performance@outlook.com">sealed-performance@outlook.com</a>

                    </div>

                </div>

                <div class="row">

                    <nav>

                        <ul class="menu">

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(14); ?>">Home</a>
                            </li>

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(30); ?>">About</a>
                            </li>

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(44); ?>">Shop</a>
                            </li>

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(27); ?>">What our customers say</a>
                            </li>

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(21); ?>">Gallery</a>
                            </li>

                            <li class="menu__item">
                                <a href="<?php echo get_the_permalink(18); ?>">Contact Us</a>
                            </li>

                        </ul>

                    </nav>

                </div>

            </div>

        </div>

    </header>


    <div class="banner" style="background-image: url(<?php the_image_field( 'banner_image' ); ?>);">

    </div>

    <div class="banner__content">

        <h2 class="title title--banner"><?php the_field('banner_content'); ?></h2>

        <?php if ( get_field('show_banner_buttons') ): ?>

            <div class="banner__buttons">

                <a class="button" href="<?php echo get_the_permalink(44); ?>">Visit shop</a>

                <a class="button" href="#!">Gallery</a>

            </div>

        <?php endif ?>
    </div>
        
    









