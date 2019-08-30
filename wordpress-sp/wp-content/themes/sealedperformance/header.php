
            <header>

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

                <!-- Logo -->
                <div class="logo">
                    <img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="Sealed Performance Logo">
                </div>

                <!-- Static Nav - DESKTOP ONLY -->

                <?php

                wp_nav_menu(

                        array(

                            'theme_location' => 'top-menu',
                            'menu' => 'main_menu',
                            'container' => 'nav',
                            'menu_class' => 'desktop-nav'
                        )

                );

                ?>

            </header>