<?php
    // Add styles
    function enqueue_style_myTheme() {
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_style_myTheme' );

    // Register menus
    function register_my_menus() {
        register_nav_menus(
            array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
            )
        );
    }
    add_action( 'init', 'register_my_menus' );



?>