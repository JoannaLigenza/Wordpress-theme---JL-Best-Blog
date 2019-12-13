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
    <div class="main-container">
        <?php if ( get_header_image() ) : ?>
        <header class="header" style="background-image: url(<?php echo get_template_directory_uri().'/images/winter.jpg' ?>)">
        <?php else : ?>
        <header class="header">
        <?php endif; ?>
            <div class="top-menu container">
                <?php 
                    if ( has_nav_menu( 'top-menu' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'top-menu' ) );
                    }
                ?>
            </div>
            <div class="header-title container">
                <!-- Displaying logo -->
                <?php if ( has_custom_logo() ) { ?>
                    <div class="logo">
                        <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            }
                        ?>
                    </div>
                <?php } ?>
                <!-- Displaying site title and description -->
                <?php
                    if ( display_header_text() ){ ?>
                        <a href="<?php echo home_url() ?>" class="header-text">
                            <div class="title">
                                <h2><?php bloginfo('name') ?></h2>
                                <h5><?php bloginfo('description') ?></h5>
                            </div>   
                        </a>                        
                    <?php } else{
                        //do something
                    }
                ?>
                <!-- Displaying search form -->
                <?php get_search_form(); ?>
            </div>
            <nav>
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu',
                            'container_class' => 'header-menu-class'
                        )
                    );
                ?>
            </nav>
            <?php if ( get_header_image() ) : ?>
                <div id="site-header" class="container"></div>
            <?php endif; ?>
        </header>