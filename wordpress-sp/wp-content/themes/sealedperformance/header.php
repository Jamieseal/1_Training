<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Sealed Performance</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <?php wp_head(); ?>

</head>

<body>

    <!-- Side Nav - MOBILE ONLY -->
    <nav id="mobileNav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-window-close"></i></a>
        <a href="#"><i class="fas fa-shopping-cart"></i>Shop</a>
        <a href="#"><i class="fas fa-blog"></i>Blog</a>
        <a href="#"><i class="fas fa-pencil-alt"></i>Testimonials</a>
        <a href="#"><i class="fas fa-envelope"></i>Contact</a>

    </nav>

    <!-- Toggle Button - Open Nav -->
    <nav class="nav__open" id="nav-toggle-open">
        <span onclick="openNav();"><i class="fa fa-bars"></i></span>
    </nav>

    <div id="main">

        <div class="container">

            <header>

                <!-- Logo -->
                <div class="logo">
                    <img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="Sealed Performance Logo">
                </div>

                <!-- Static Nav - DESKTOP ONLY -->
                <nav class="desktop-nav">

                    <a href="#">Shop</a>
                    <a href="#">Blog</a>
                    <a href="#">Testimonials</a>
                    <a href="#">Contact</a>

                </nav>

            </header>