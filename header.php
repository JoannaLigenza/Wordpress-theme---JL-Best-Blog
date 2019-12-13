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
        <header class="header">
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
                        <div class="title">
                            <h2><a href="<?php echo home_url() ?>"><?php bloginfo('name') ?></a></h2>
                            <h5><?php bloginfo('description') ?></h5>
                        </div>                           
                    <?php } else{
                        //do something
                    }
                ?>
            </div>
            <div class="header-image container">
                <?php if ( get_header_image() ) : ?>
                    <div id="site-header">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        </a>
                    </div>
                <?php endif; ?>
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
        </header>