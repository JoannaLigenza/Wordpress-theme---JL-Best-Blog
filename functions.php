<?php
    // Include styles
    function enqueue_style_myTheme() {
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_style_myTheme' );

    // Include menus
    function myfirsttheme_register_my_menus() {
        register_nav_menus(
            array(
            'top-menu'    => __( 'Top Menu' ),
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
            )
        );
    }
    add_action( 'init', 'myfirsttheme_register_my_menus' );

    // Include logo
    function myfirsttheme_set_custom_logo() {
        $defaults = array(
        'height'      => 100,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
        // 'header-text' => array( 'site-title', 'site-description' ),
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'myfirsttheme_set_custom_logo' );

    // Include custom header
    function myfirsttheme_set_custom_header() {
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
    add_action( 'after_setup_theme', 'myfirsttheme_set_custom_header' );


    // Include custom sections in customizer - all the sections, settings, and controls will be added here
    function myfirsttheme_customize_register( $wp_customize ) {
        // Adding settings
        $wp_customize->add_setting( 'header_textcolor' , array(
            'default'   => '#FF00FF',
            'transport' => 'refresh',   // this will refresh customizer's preview window when changes are made
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'menu_background_color' , array(
            'default'   => '#A8C5FF',
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'header_searchbox' , array(
            'default'   => true,
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'left-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'right-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        // Adding sections
        $wp_customize->add_section( 'header' , array(
            'title'      => __( 'Header', 'myfirsttheme' ),
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'layout' , array(
            'title'      => __( 'Layout', 'myfirsttheme' ),
            'priority'   => 60,
        ) );

        // Adding control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background_color', array(
            'label'      => __( 'Menu background color', 'myfirsttheme' ),
            // 'description' => __( 'Searchbox' ),
            'section'    => 'colors',
            'settings'   => 'menu_background_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_searchbox', array(
            'label'      => __( 'Display header searchbox', 'myfirsttheme' ),
            // 'description' => __( 'Searchbox' ),
            'section'    => 'header',
            'settings'   => 'header_searchbox',
            'type'       => 'checkbox'
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'left_column', array(
            'label'      => __( 'Display left column', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'left-column',
            'type'       => 'checkbox'
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'right_column', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'right-column',
            'type'       => 'checkbox'
        ) ) );
    }
    add_action( 'customize_register', 'myfirsttheme_customize_register' );


    // Register sidebars
    function myfirsttheme_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Left Sidebar', 'myfirsttheme' ),
            'id'            => 'sidebar-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    
        register_sidebar( array(
            'name'          => __( 'Right Sidebar', 'myfirsttheme' ),
            'id'            => 'sidebar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'myfirsttheme_widgets_init' );

?>