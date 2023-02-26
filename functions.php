<?php

    // Adding styles and scripts
    function jlbestblog_add_theme_scripts() {
        // Include styles
        wp_enqueue_style( 'jlbestblog_style', get_stylesheet_uri() );

        // Include scripts
        wp_enqueue_script( 'jlbestblog_script', get_theme_file_uri() . '/assets/js/script.js', array(), 1.0, true);

        // Include comments
        if ( is_singular() && comments_open() ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'jlbestblog_add_theme_scripts' );


    // Adding scripts for customizer preview
    function jlbestblog_add_theme_scripts_preview() {
        wp_enqueue_script( 'jlbestblog_customizer', get_theme_file_uri() . '/assets/js/customizer.js', array(), 1.0, true);
    }
    add_action( 'customize_preview_init', 'jlbestblog_add_theme_scripts_preview' );


    // Include menus
    function jlbestblog_register_my_menus() {
        register_nav_menus(
            array(
            'top-menu'    => __( 'Top Menu', 'jl-best-blog' ),
            'header-menu' => __( 'Header Menu', 'jl-best-blog' ),
            )
        );
    }
    add_action( 'init', 'jlbestblog_register_my_menus' );


    // Include logo
    function jlbestblog_set_custom_logo() {
        $defaults = array(
        'height'      => 100,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
        // 'header-text' => array( 'site-title', 'site-description' ),
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'jlbestblog_set_custom_logo' );

    // Include custom style editor (TinyMCE visual editor)
    function jlbestblog_add_editor_styles() {
        add_editor_style( 'inc/css/editor-style.css' );
    }
    add_action( 'admin_init', 'jlbestblog_add_editor_styles' );


    // Include custom header
    function jlbestblog_set_custom_header() {
        $header_info = array(
            'width'         => 1200,
            'height'        => 700,
            'flex-width'    => true,
            'flex-height'   => true,
            'default-image' => get_theme_file_uri() . '/inc/images/winter.jpg',
            // Display the header text along with the image
            'header-text'   => true,
            // Header text color default
            'default-text-color' => '1e73be',
        );
        add_theme_support( 'custom-header', $header_info );

        // register header(s)
        $header_images = array(
            'winter' => array(
                    'url'           => get_theme_file_uri() . '/inc/images/winter.jpg',
                    'thumbnail_url' => get_theme_file_uri() . '/inc/images/winter.jpg',
                    'description'   => 'Header image',
            ),
        );
        register_default_headers( $header_images );
    }
    add_action( 'after_setup_theme', 'jlbestblog_set_custom_header' );


    // setup
    function jlbestblog_setup() {
        // Add site title support (and remove hard coded <title> tag from header)
        add_theme_support( 'title-tag' );

        // Add custom background color
        add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );

        // Include post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Add default posts and comments RSS feed links to <head>
        add_theme_support( 'automatic-feed-links' );

        // Add translations for theme
        load_theme_textdomain( 'jl-best-blog', get_template_directory() . '/languages' );

        // Allow partial refreshes of widgets in a theme’s sidebars
        add_theme_support( 'customize-selective-refresh-widgets' );

        if ( ! isset( $content_width ) ) $content_width = 1800;

    }
    add_action( 'after_setup_theme', 'jlbestblog_setup' );


    // Include custom sections in customizer - all the sections, settings, and controls will be added here
    function jlbestblog_customize_register( $wp_customize ) {
        // Adding settings - front page
        $wp_customize->add_setting( 'menu_background_color' , array(
            'default'   => '#A8C5FF',
            'transport' => 'refresh',                       // this will refresh customizer's preview window when changes are made
            'type'      => 'theme_mod',                     // this is setted for themes and 'theme_mod' is default setting, so it's optional in themes
            'sanitize_callback' => 'sanitize_hex_color',    // this is WordPress sanitization function, to ensure that no unsafe data is stored in the database
        ) );

        $wp_customize->add_setting( 'menu_font_color' , array(
            'default'   => '#1e73be',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
            'sanitize_js_callback' => 'sanitize_hex_color',     // selective refresh is set for menu_font_color setting (in customizer.js), so it needs to sanitize data used by script
        ) );

        $wp_customize->add_setting( 'link_hover_color' , array(
            'default'   => '#515151',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_setting( 'header_searchbox' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'left-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-meta' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'front-page-image' , array(
            'default'   => 'above',
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_radio',
        ) );

        $wp_customize->add_setting( 'excerpt-length' , array(
            'default'   => '55',
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',    // echo absint( 'some non-numeric string' );  -> returns 0
        ) );

        // Adding settings - footer
        $wp_customize->add_setting( 'footer-column-1' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-column-2' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-column-3' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-social-icon' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'social-icon-facebook' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-twitter' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-instagram' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-youtube' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-pinterest' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-whatsapp' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-messenger' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'social-icon-linkedin' , array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_setting( 'footer-privacy-policy' , array(
            'default'   => false,
            'transport' => 'postMessage',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        // Settings - single post
        $wp_customize->add_setting( 'left-column-single' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-single' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-meta-single' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-image-single' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-post' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'display-tags-in-post' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        // Settings - single page
        $wp_customize->add_setting( 'left-column-single-page' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-single-page' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'page-meta' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'page-image' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-page' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        // Settings - archive page
        $wp_customize->add_setting( 'left-column-archive' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-archive' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-archive' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'taxonomy-description' , array(
            'default'   => 'top',
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_radio',
        ) );

        $wp_customize->add_setting( 'post-meta-archive' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'archive-image' , array(
            'default'   => 'left',
            'transport' => 'refresh',
            'sanitize_callback' => 'jlbestblog_sanitize_radio',
        ) );

        // sanitize callback functions for settings
        function jlbestblog_sanitize_checkbox( $checked ) {
            return ( ( isset( $checked ) && true == $checked ) ? true : false );
        }

        function jlbestblog_sanitize_radio( $input, $setting ) {
            // Ensure input is a slug.
            $input = sanitize_key( $input );
            
            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;
            
            // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }

        // Adding panel
        $wp_customize->add_panel( 'header', array(
            'title' => __( 'Header', 'jl-best-blog' ),
            'priority' => 40, // Mixed with top-level-section hierarchy.
        ) );

        $wp_customize->add_panel( 'appearance', array(
            'title' => __( 'Appearance Settings', 'jl-best-blog' ),
            // 'description' => $description, // Include html tags such as <p>.
            'priority' => 50,
        ) );

        // Adding sections
        $wp_customize->add_section( 'header' , array(
            'title'      => __( 'Header Search Box', 'jl-best-blog' ),
            'panel' => 'header',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'header_image' , array(
            'title'      => __( 'Header Image', 'jl-best-blog' ),
            'panel' => 'header',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'colors' , array(
            'title'      => __( 'Colors', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 10,
        ) );

        $wp_customize->add_section( 'background_image' , array(
            'title'      => __( 'Background image', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 20,
        ) );

        $wp_customize->add_section( 'front-page-layout' , array(
            'title'      => __( 'Front Page Layout', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 30,
        ) );

        $wp_customize->add_section( 'single-post-layout' , array(
            'title'      => __( 'Single Post Layout', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 40,
        ) );

        $wp_customize->add_section( 'single-page-layout' , array(
            'title'      => __( 'Single Page Layout', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'archive-layout' , array(
            'title'      => __( 'Archive Layout', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 60,
        ) );

        $wp_customize->add_section( 'footer' , array(
            'title'      => __( 'Footer', 'jl-best-blog' ),
            'panel' => 'appearance',
            'priority'   => 70,
        ) );

        // Adding controls - main site
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background_color', array(
            'label'      => __( 'Primary color', 'jl-best-blog' ),
            'section'    => 'colors',
            'settings'   => 'menu_background_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_font_color', array(
            'label'      => __( 'Menu font color', 'jl-best-blog' ),
            'section'    => 'colors',
            'settings'   => 'menu_font_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
            'label'      => __( 'Secondary color', 'jl-best-blog' ),
            'section'    => 'colors',
            'settings'   => 'link_hover_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( 'header_searchbox', array(
            'label'      => __( 'Display header searchbox', 'jl-best-blog' ),
            'section'    => 'header',
            'settings'   => 'header_searchbox',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'left_column', array(
            'label'      => __( 'Display left column', 'jl-best-blog' ),
            'section'    => 'front-page-layout',
            'settings'   => 'left-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right_column', array(
            'label'      => __( 'Display right column', 'jl-best-blog' ),
            'section'    => 'front-page-layout',
            'settings'   => 'right-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta', array(
            'label'      => __( 'Enable post meta on front page', 'jl-best-blog' ),
            'section'    => 'front-page-layout',
            'settings'   => 'post-meta',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'front-page-image', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'jl-best-blog' ),
            'section'    => 'front-page-layout',
            'settings'   => 'front-page-image',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );

        $wp_customize->add_control( 'excerpt-length', array(
            'label'      => __( 'Choose Excerpt Length', 'jl-best-blog' ),
            'section'    => 'front-page-layout',
            'settings'   => 'excerpt-length',
            'type'       => 'number',
        ) );

        $wp_customize->add_control( 'footer-column-1', array(
            'label'      => __( ' Display footer sidebar 1', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-1',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-column-2', array(
            'label'      => __( ' Display footer sidebar 2', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-2',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-column-3', array(
            'label'      => __( ' Display footer sidebar 3', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-3',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-privacy-policy', array(
            'label'      => __( ' Display link to privacy policy', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'footer-privacy-policy',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-social-icon', array(
            'label'      => __( 'Enable social icons section', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'footer-social-icon',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'social-icon-facebook', array(
            'label'      => __( 'Link to your Facebook', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-facebook',
        ) );

        $wp_customize->add_control( 'social-icon-instagram', array(
            'label'      => __( 'Link to your Instagram', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-instagram',
        ) );

        $wp_customize->add_control( 'social-icon-twitter', array(
            'label'      => __( 'Link to your Twitter', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-twitter',
        ) );

        $wp_customize->add_control( 'social-icon-pinterest', array(
            'label'      => __( 'Link to your Pinterest', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-pinterest',
        ) );

        $wp_customize->add_control( 'social-icon-youtube', array(
            'label'      => __( 'Link to your Youtube', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-youtube',
        ) );

        $wp_customize->add_control( 'social-icon-whatsapp', array(
            'label'      => __( 'Link to your Whatsapp', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-whatsapp',
        ) );

        $wp_customize->add_control( 'social-icon-messenger', array(
            'label'      => __( 'Link to your Messenger', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-messenger',
        ) );

        $wp_customize->add_control( 'social-icon-linkedin', array(
            'label'      => __( 'Link to your Linkedin', 'jl-best-blog' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-linkedin',
        ) );
        
        
        // Adding controls - single post
        $wp_customize->add_control( 'left-column-single', array(
            'label'      => __( 'Display left column', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'left-column-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-single', array(
            'label'      => __( 'Display right column', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'right-column-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta-single', array(
            'label'      => __( 'Enable post meta', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'post-meta-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-post', array(
            'label'      => __( 'Display header image', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'display-header-image-on-post',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-tags-in-post', array(
            'label'      => __( 'Display tags', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'display-tags-in-post',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-image-single', array(
            'label'      => __( 'Display post image in single post', 'jl-best-blog' ),
            'section'    => 'single-post-layout',
            'settings'   => 'post-image-single',
            'type'       => 'checkbox',
        ) );

        // Adding controls - single page
        $wp_customize->add_control( 'left-column-single-page', array(
            'label'      => __( 'Display left column', 'jl-best-blog' ),
            'section'    => 'single-page-layout',
            'settings'   => 'left-column-single-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-single-page', array(
            'label'      => __( 'Display right column', 'jl-best-blog' ),
            'section'    => 'single-page-layout',
            'settings'   => 'right-column-single-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'page-meta', array(
            'label'      => __( 'Enable post meta', 'jl-best-blog' ),
            'section'    => 'single-page-layout',
            'settings'   => 'page-meta',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-page', array(
            'label'      => __( 'Display header image', 'jl-best-blog' ),
            'section'    => 'single-page-layout',
            'settings'   => 'display-header-image-on-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'page-image', array(
            'label'      => __( 'Display image on single page', 'jl-best-blog' ),
            'section'    => 'single-page-layout',
            'settings'   => 'page-image',
            'type'       => 'checkbox',
        ) );

        // Adding controls - archive page
        $wp_customize->add_control( 'left-column-archive', array(
            'label'      => __( 'Display left column', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'left-column-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-archive', array(
            'label'      => __( 'Display right column', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'right-column-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-archive', array(
            'label'      => __( 'Display header image', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'display-header-image-on-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta-archive', array(
            'label'      => __( 'Enable post meta on archive pages', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'post-meta-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'taxonomy-description', array(
            'label'      => __( 'Taxonomy description position', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'taxonomy-description',
            'type'       => 'radio',
            'choices'    => array(
                'top' => 'Above content',
                'bottom' => 'Below content',
                'none'  => 'None'
            ),
        ) );

        $wp_customize->add_control( 'archive-image', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'jl-best-blog' ),
            'section'    => 'archive-layout',
            'settings'   => 'archive-image',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );
    }
    add_action( 'customize_register', 'jlbestblog_customize_register' );


    // Register sidebars
    function jlbestblog_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Left Sidebar', 'jl-best-blog' ),
            'id'            => 'sidebar-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    
        register_sidebar( array(
            'name'          => __( 'Right Sidebar', 'jl-best-blog' ),
            'id'            => 'sidebar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 1', 'jl-best-blog' ),
            'id'            => 'sidebar-footer-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 2', 'jl-best-blog' ),
            'id'            => 'sidebar-footer-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 3', 'jl-best-blog' ),
            'id'            => 'sidebar-footer-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'jlbestblog_widgets_init' );


    // Add custom style to WordPress elements
    function jlbestblog_set_custom_styles() {
        $color = get_theme_mod( 'menu_background_color', '#a8c5ff' );
        $fontColor = get_theme_mod( 'menu_font_color', '#1e73be' );
        $linkHoverColor = get_theme_mod( 'link_hover_color', '#515151' );
        ?>
            <style>
                .page-numbers {
                    border: 1px solid <?php echo esc_attr( $color ) ?>;
                }
                .page-numbers:hover {
                    background-color: <?php echo esc_attr( $color ) ?>;
                    text-decoration: none;
                }
                .current {
                    background-color: <?php echo esc_attr( $color ) ?>;
                }
                .dots:hover {
                    background-color: unset;
                }
                .menu-item, .page-item, .page_item {
                    color: <?php echo esc_attr( $fontColor ) ?>;
                }
                a {
                    color: <?php echo esc_attr( $color ) ?>;
                }
                a:hover {
                    color: <?php echo esc_attr( $linkHoverColor ) ?>;
                }
                .menu-navigation .menu-item a:hover, .menu-navigation .page-item a:hover, .menu-navigation .page_item a:hover {
                    color: <?php echo esc_attr( $linkHoverColor ) ?>;
                }
                .section > h2 a:hover {
                    color: <?php echo esc_attr( $linkHoverColor ) ?>;
                }
                .current-menu-item > a {
                    color: <?php echo esc_attr( $linkHoverColor ) ?>;
                }
                .menu-navigation .sub-menu, .menu-navigation .children {
                    background-color: <?php echo esc_attr( $color ) ?>;
                }
                .widget-title {
                    border-bottom: 2px solid <?php echo esc_attr( $color ) ?>;
                }
                .submit {
                    border: 2px solid <?php echo esc_attr( $color ) ?>;
                    color: <?php echo esc_attr( $color ) ?>;
                }
                .submit:hover {
                    background-color: <?php echo esc_attr( $color ) ?>;
                    border: 2px solid transparent;
                    color: <?php echo esc_attr( $fontColor ) ?>;
                }
                .submit:focus:hover {
                    color: <?php echo esc_attr( $color ) ?>;
                }
                .read-more-button:hover {
                    background-color: <?php echo esc_attr( $color ) ?>;
                }
                .post-categories a {
                    border: 1px solid <?php echo esc_attr( $color ) ?>;
                }
                .post-categories a:hover {
                    background-color: <?php echo esc_attr( $color ) ?>;
                }
                .wp-block-embed-twitter, .wp-block-embed-facebook {
                    border-bottom: 2px solid <?php echo esc_attr( $color ) ?>;
                }
                <?php if ( get_theme_mod( 'left-column-single' ) && get_theme_mod( 'right-column-single' ) ) : ?>
                .main-content--section {
                    max-width: calc( 100% - 600px);
                }
                <?php elseif ( get_theme_mod( 'left-column-single' ) || get_theme_mod( 'right-column-single' ) ) : ?>
                .main-content--section {
                    max-width: calc( 100% - 300px);
                }
                <?php elseif ( ! get_theme_mod( 'left-column-single' ) && ! get_theme_mod( 'right-column-single' ) ) : ?>
                .main-content--section {
                    max-width: 100%;
                }
                <?php endif; ?>
            </style>
        <?php
    }
    add_action('wp_head', 'jlbestblog_set_custom_styles');


    // Set post excerpt length
    function jlbestblog_custom_excerpt_length( $length ) {
        $excerptLength =  is_admin() ? $length : absint( get_theme_mod( 'excerpt-length', '55' ) );
        return $excerptLength;
    }
    add_filter( 'excerpt_length', 'jlbestblog_custom_excerpt_length');

    function jlbestblog_excerpt_more( $more ) {
        $excerptLength =  is_admin() ? $more : absint( get_theme_mod( 'excerpt-length', '55' ) );
        if ($excerptLength === 0) {
            return '';
        } else {
            return "<div class='read-more-button'><a class='read-more-link' href='".esc_url( get_permalink() )."' style='border: 1px solid ".esc_attr( get_theme_mod( 'menu_background_color', '#696969' ) )."'>".__( 'Read more...', 'jl-best-blog')."</a></div>";
        }
    }
    add_filter( 'excerpt_more', 'jlbestblog_excerpt_more' );


    // Adding selective settings refresh for header title and document title
    function jlbestblog_register_partials( WP_Customize_Manager $wp_customize ) {
        // Abort if selective refresh is not available.
        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_setting( 'menu_font_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

        // header site title
        $wp_customize->selective_refresh->add_partial( 'header_site_title', array(
            'selector' => '.title',
            'settings' => array( 'blogname', 'blogdescription', 'header_textcolor' ),
            'render_callback' => function() {
                    if ( display_header_text() ){ ?>
                        <a href="<?php echo esc_url(home_url()) ?>" class="header-text">
                            <div>
                                <h1 style="color: #<?php echo esc_attr(get_header_textcolor()); ?>"><?php bloginfo('name') ?></h1>
                                <h5 style="color: #<?php echo esc_attr(get_header_textcolor()); ?>"><?php bloginfo('description') ?></h5>
                            </div>   
                        </a>                        
                    <?php }
            },
        ) );

        // header menu text
        $wp_customize->selective_refresh->add_partial( 'header_menu_text', array(
            'selector' => '#navigation',
            'settings' => array( 'menu_font_color' ),
            'render_callback' => function() {
                $fontColor = get_theme_mod( 'menu_font_color' , '#fff' );
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu-class',
                        'before' => '<span style="color: '.esc_attr( $fontColor ).'">',
                        'after'  => '</span>',
                    )
                );
            },
        ) );

        // footer privacy policy link
        $wp_customize->selective_refresh->add_partial( 'privacy-policy-link', array(
            'selector' => '#footer-links-container',
            'settings' => array( 'footer-privacy-policy' ),
            'render_callback' => function() {
                if ( get_theme_mod( 'footer-privacy-policy') ) {
                    $privacy_policy_page = get_option( 'wp_page_for_privacy_policy' );
                    if( $privacy_policy_page ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $privacy_policy_page ) ) ?>" class='privacy-policy-link'> <?php esc_attr_e( 'Privacy Policy', 'jl-best-blog' ) ?> </a>
                    <?php endif;
                }
            },
        ) );
    }
    add_action( 'customize_register', 'jlbestblog_register_partials' );


    // Set custom archive title
    function jlbestblog_set_archive_title() {
        $title = __( 'Title', 'jl-best-blog' );
 
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            /* translators: Author archive title. %s: Author name. */
            $title = sprintf( __( 'Author: %s', 'jl-best-blog' ), esc_html( get_the_author() ) );
        } elseif ( is_year() ) {
            /* translators: Yearly archive title. %s: Year. */
            $title = sprintf( __( 'Year: %s', 'jl-best-blog' ), esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'jl-best-blog' ) ) ) );
        } elseif ( is_month() ) {
            /* translators: Monthly archive title. %s: Month name and year. */
            $title = sprintf( __( 'Month: %s', 'jl-best-blog' ), esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'jl-best-blog' ) ) ) );
        } elseif ( is_day() ) {
            /* translators: Daily archive title. %s: Date. */
            $title = sprintf( __( 'Day: %s', 'jl-best-blog' ), esc_html( get_the_date( _x( 'F j, Y', 'daily archives date format', 'jl-best-blog' ) ) ) );
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            // Taxonomy name (first letter uppercase)
            $queried_object = get_queried_object();
            if ( $queried_object->taxonomy === $queried_object->slug ) {
                $title = ucfirst( $queried_object->taxonomy );
            } else {
                $title = ucfirst( $queried_object->taxonomy ).': '.ucfirst( $queried_object->name );
            }
        }

        return $title;
    }
    add_filter( 'get_the_archive_title', 'jlbestblog_set_archive_title' );



