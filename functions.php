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
            'top-menu'    => __( 'Top Menu' ),
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
            'width'         => 1200,
            'height'        => 200,
            'flex-width'    => true,
            'flex-height'   => true,
            'default-image' => get_template_directory_uri() . '/images/winter.jpg',
            // Display the header text along with the image
            'header-text'   => true,
            // Header text color default
            'default-text-color' => '000',
        );
        add_theme_support( 'custom-header', $header_info );

        // register header(s)
        $header_images = array(
            'sunset' => array(
                    'url'           => get_template_directory_uri() . '/images/winter.jpg',
                    'thumbnail_url' => get_template_directory_uri() . '/images/winter.jpg',
                    'description'   => 'Sunset',
            ),
        );
        register_default_headers( $header_images );
    }
    add_action( 'after_setup_theme', 'set_custom_header' );


    // Include custom sections in customizer - all our sections, settings, and controls will be added here
    function myfirsttheme_customize_register( $wp_customize ) {
        // Adding settings
        $wp_customize->add_setting( 'header_searchbox' , array(
            'default'   => true,
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        // Adding sections
        $wp_customize->add_section( 'header' , array(
            'title'      => __( 'Header', 'myfirsttheme' ),
            'priority'   => 30,
        ) );

        // Adding control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default', array(
            'label'      => __( 'Header searchbox', 'myfirsttheme' ),
            'section'    => 'header',
            'settings'   => 'header_searchbox',
            'type'       => 'checkbox'
        ) ) );
    }
    add_action( 'customize_register', 'myfirsttheme_customize_register' );

?>