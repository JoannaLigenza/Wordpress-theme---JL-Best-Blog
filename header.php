<!DOCTYPE html>
<html <?php echo language_attributes(); ?> >
<head>
    <meta charset="<?php echo bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name') ?></title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <!-- Adds scripts in heads -->
    <?php wp_head(); ?> 
</head>
<body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
    <div class="main-container">
        <!-- displaying header image depends of page type -->
        <?php
        if ( is_single() ) {
            if ( get_header_image() && get_theme_mod( 'display-header-image-on-post' ) ) : ?>
            <header class="header" style="background-image: url(<?php echo esc_url(get_custom_header()->url) ?>)">
            <?php else : ?>
            <header class="header">
            <?php endif;
        } elseif ( is_page() ) {
            if ( get_header_image() && get_theme_mod( 'display-header-image-on-page' ) ) : ?>
            <header class="header" style="background-image: url(<?php echo esc_url(get_custom_header()->url) ?>)">
            <?php else : ?>
            <header class="header">
            <?php endif;
        } elseif ( is_archive() ) {
            if ( get_header_image() && get_theme_mod( 'display-header-image-on-archive' ) ) : ?>
            <header class="header" style="background-image: url(<?php echo esc_url(get_custom_header()->url) ?>)">
            <?php else : ?>
            <header class="header">
            <?php endif;
        } else {
            if ( get_header_image() ) :   // display header image url ?>
            <header class="header" style="background-image: url(<?php echo esc_url(get_custom_header()->url) ?>)">
            <?php else : ?>
            <header class="header">
            <?php endif;
        }
        ?>
            <div class="mobile-menu-container" style="background-color: <?php echo esc_attr( get_theme_mod( 'menu_background_color', '#A8C5FF' ) ) ?>">
                <div class="mobile-menu-icon" id="mobile-menu-icon">
                    <span class="mobile-menu-icon-strip"></span>
                    <span class="mobile-menu-icon-strip"></span>
                    <span class="mobile-menu-icon-strip"></span>
                </div>
            </div>
            <div class="top-menu container">
                <?php
                    if ( has_nav_menu( 'top-menu' ) ) : ?>
                    <div class="mobile-top-menu-container" id="mobile-top-menu-container">
                        <p><span> TOP MENU </span></p>
                    </div>
                        <?php
                        wp_nav_menu( array( 
                            'theme_location' => 'top-menu',
                            'container_class' => 'top-menu-class',
                            'depth' => 4
                        ) );
                    endif;
                ?>
            </div>
            <div class="header-title container">
                <!-- displaying logo -->
                <?php if ( has_custom_logo() ) {    // returns true or false ?>
                    <div class="logo">
                        <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            }
                        ?>
                    </div>
                <?php } ?>
                <!-- displaying site title and description -->
                <div class="title">
                <?php
                    if ( display_header_text() ){    // returns true or false ?>
                        <a href="<?php echo esc_url(home_url()) ?>" class="header-text">
                            <div>
                                <h1 style="color: #<?php echo esc_attr(get_header_textcolor()); ?>"><?php bloginfo('name') ?></h1>
                                <h5 style="color: #<?php echo esc_attr(get_header_textcolor()); ?>"><?php bloginfo('description') ?></h5>
                            </div>   
                        </a>                        
                    <?php }
                ?>
                <!-- displaying search form -->
                <?php 
                    if (get_theme_mod( 'header_searchbox' )) {
                        get_search_form(); 
                    }
                ?>
                </div>
            </div>
            <nav id="navigation" class="menu-navigation" style="background-color: <?php echo esc_attr( get_theme_mod( 'menu_background_color', '#A8C5FF' ) ) ?>">
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu',
                            'container_class' => 'main-menu-class',
                            'depth' => 4
                        )
                    );
                ?>
            </nav>
            <!-- display header image container depends on page type -->
            <?php 
            if ( is_single() ) {
                if ( get_header_image() && get_theme_mod( 'display-header-image-on-post' ) ) : ?>
                    <div id="site-header" class="container"></div>
                <?php endif;
            }
            elseif ( is_page() ) {
                if ( get_header_image() && get_theme_mod( 'display-header-image-on-page' ) ) : ?>
                    <div id="site-header" class="container"></div>
                <?php endif;
            }
            elseif ( is_archive() ) {
                if ( get_header_image() && get_theme_mod( 'display-header-image-on-archive' ) ) : ?>
                    <div id="site-header" class="container"></div>
                <?php endif;
            } else {
                if ( get_header_image() ) : ?>
                    <div id="site-header" class="container"></div>
                <?php endif; 
            }
            ?>
        </header>