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
            'height'        => 700,
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

        $wp_customize->add_setting( 'post-meta' , array(
            'default'   => true,
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'front-page-and-archive-image' , array(
            'default'   => 'left',
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        $wp_customize->add_setting( 'excerpt-length' , array(
            'default'   => '55',
            'transport' => 'refresh',
            'type'      => 'theme_mod'
        ) );

        // Adding panel
        $wp_customize->add_panel( 'header', array(
            'title' => __( 'Header' ),
            'priority' => 40, // Mixed with top-level-section hierarchy.
        ) );

        $wp_customize->add_panel( 'appearance', array(
            'title' => __( 'Appearance Settings' ),
            // 'description' => $description, // Include html tags such as <p>.
            'priority' => 50, // Mixed with top-level-section hierarchy.
        ) );

        // Adding sections
        $wp_customize->add_section( 'header' , array(
            'title'      => __( 'Header Search Box', 'myfirsttheme' ),
            'panel' => 'header',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'header_image' , array(
            'title'      => __( 'Header Image', 'myfirsttheme' ),
            'panel' => 'header',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'colors' , array(
            'title'      => __( 'Colors', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 10,
        ) );

        $wp_customize->add_section( 'layout' , array(
            'title'      => __( 'Layout', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 20,
        ) );

        $wp_customize->add_section( 'front-page-and-archive-settings' , array(
            'title'      => __( 'Front Page and Archive Pages', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 30,
        ) );

        // Adding controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background_color', array(
            'label'      => __( 'Menu background color', 'myfirsttheme' ),
            'section'    => 'colors',
            'settings'   => 'menu_background_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( 'header_searchbox', array(
            'label'      => __( 'Display header searchbox', 'myfirsttheme' ),
            'section'    => 'header',
            'settings'   => 'header_searchbox',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'left_column', array(
            'label'      => __( 'Display left column', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'left-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right_column', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'right-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta', array(
            'label'      => __( 'Enable post meta', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'post-meta',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'front-page-and-archive-image', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'front-page-and-archive-image',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );

        $wp_customize->add_control( 'excerpt-length', array(
            'label'      => __( 'Choose Excerpt Length', 'myfirsttheme' ),
            'section'    => 'layout',
            'settings'   => 'excerpt-length',
        ) );
        
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


    // Add custom style
    function myfisttheme_set_pagination_style() {
        wp_enqueue_style(
            'pagination-style',
            get_template_directory_uri() . '/css/custom_script.css'
        );
            $color = get_theme_mod( 'menu_background_color' );
            $custom_css = "
                    .page-numbers {
                        border: 1px solid {$color};
                    }
                    .page-numbers:hover {
                        background-color: {$color};
                        text-decoration: none;
                    }
                    .current {
                        background-color: {$color};
                    }
                    .dots:hover {
                        background-color: unset;
                    }
                    ";
            wp_add_inline_style( 'pagination-style', $custom_css );
    }
    add_action( 'wp_enqueue_scripts', 'myfisttheme_set_pagination_style' );


    // Include post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Set post excerpt length
    function wpdocs_custom_excerpt_length( $length ) {
        $excerptLength = get_theme_mod( 'excerpt-length' );
        return $excerptLength;
    }
    add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length');

    function wpdocs_excerpt_more( $more ) {
        $excerptLength = get_theme_mod( 'excerpt-length' );
        if ($excerptLength === '0') {
            return '';
        } else {
            return "<a href='".get_permalink()."'><div class='read-more-button' style='border: 1px solid ".get_theme_mod( 'menu_background_color', '#696969' )."'> Read more...</div></a>";
        }
    }
    add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


?>