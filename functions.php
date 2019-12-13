<?php
    // Include styles
    function enqueue_style_myTheme() {
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_style_myTheme' );

    // Include menus
    function register_my_menus() {
        register_nav_menus(
            array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
            )
        );
    }
    add_action( 'init', 'register_my_menus' );

    // Include logo
    function set_custom_logo() {
        $defaults = array(
        'height'      => 100,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
        // 'header-text' => array( 'site-title', 'site-description' ),
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'set_custom_logo' );

    // Include custom header
    function set_custom_header() {
        $header_info = array(
            'flex-width'    => true,
            'width'         => 1200,
            'flex-height'   => true,
            'height'        => 200,
            'default-image' => get_template_directory_uri() . '/images/logo3.png',
            // Display the header text along with the image
            'header-text'   => true,
        );
        add_theme_support( 'custom-header', $header_info );

        // register header(s)
        $header_images = array(
            'sunset' => array(
                    'url'           => get_template_directory_uri() . '/images/logo3.png',
                    'thumbnail_url' => get_template_directory_uri() . '/images/logo3.png',
                    'description'   => 'Sunset',
            ),
        );
        register_default_headers( $header_images );
    }
    add_action( 'after_setup_theme', 'set_custom_header' );
    



?>