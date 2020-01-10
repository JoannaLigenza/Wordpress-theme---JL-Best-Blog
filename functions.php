<?php

    // Adding styles and scripts
    function myfirsttheme_add_theme_scripts() {
        // Include styles
        wp_enqueue_style( 'style', get_stylesheet_uri() );

        // Include scripts
        wp_enqueue_script( 'script', get_theme_file_uri() . '/assets/js/script.js', true);
    }
    add_action( 'wp_enqueue_scripts', 'myfirsttheme_add_theme_scripts' );


    // Adding scripts for customizer preview
    function myfirsttheme_add_theme_scripts_preview() {
        // wp_enqueue_script( 'customizer', get_theme_file_uri() . '/js/customizer.js', array('jquery'), true);
        wp_enqueue_script( 'customizer', get_theme_file_uri() . '/assets/js/customizer.js', true);
    }
    add_action( 'customize_preview_init', 'myfirsttheme_add_theme_scripts_preview' );


    // Include menus
    function myfirsttheme_register_my_menus() {
        register_nav_menus(
            array(
            'top-menu'    => __( 'Top Menu' ),
            'header-menu' => __( 'Header Menu' ),
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
            'default-image' => get_theme_file_uri() . '/inc/images/winter.jpg',
            // Display the header text along with the image
            'header-text'   => true,
            // Header text color default
            'default-text-color' => '#1e73be',
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
    add_action( 'after_setup_theme', 'myfirsttheme_set_custom_header' );


    // setup
    function myfirsttheme_setup() {
        // Include post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Add default posts and comments RSS feed links to <head>
        add_theme_support( 'automatic-feed-links' );

        // Add translations for theme
        load_theme_textdomain( 'myfirsttheme', get_template_directory() . '/languages' );

        // Allow partial refreshes of widgets in a theme’s sidebars
        add_theme_support( 'customize-selective-refresh-widgets' );

    }
    add_action( 'after_setup_theme', 'myfirsttheme_setup' );


    // Include custom sections in customizer - all the sections, settings, and controls will be added here
    function myfirsttheme_customize_register( $wp_customize ) {
        // Adding settings - front page
        $wp_customize->add_setting( 'menu_background_color' , array(
            'default'   => '#A8C5FF',
            'transport' => 'refresh',                       // this will refresh customizer's preview window when changes are made
            'type'      => 'theme_mod',                     // this is setted for themes and 'theme_mod' is default setting, so it's optional in themes
            'sanitize_callback' => 'sanitize_hex_color',    // this is wordpress sanitization function, to ensure that no unsafe data is stored in the database
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
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'left-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-meta' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'front-page-and-archive-image' , array(
            'default'   => 'left',
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_radio',
        ) );

        $wp_customize->add_setting( 'excerpt-length' , array(
            'default'   => '55',
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',    // echo absint( 'some non-numeric string' );  -> returns 0
        ) );

        $wp_customize->add_setting( 'footer-column-1' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-column-2' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-column-3' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'footer-social-icon' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
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

        // Settings - single post
        $wp_customize->add_setting( 'left-column-single' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-single' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-meta-single' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'post-image-single' , array(
            'default'   => 'above',
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_radio',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-post' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        // Settings - single page
        $wp_customize->add_setting( 'left-column-single-page' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-single-page' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'page-meta' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'page-image' , array(
            'default'   => 'above',
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_radio',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-page' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        // Settings - archive page
        $wp_customize->add_setting( 'left-column-archive' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'right-column-archive' , array(
            'default'   => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'display-header-image-on-archive' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_checkbox',
        ) );

        $wp_customize->add_setting( 'taxonomy-description' , array(
            'default'   => 'top',
            'transport' => 'refresh',
            'sanitize_callback' => 'myfirsttheme_sanitize_radio',
        ) );

        // sanitize callback functions for settings
        function myfirsttheme_sanitize_checkbox( $checked ) {
            return ( ( isset( $checked ) && true == $checked ) ? true : false );
        }

        function myfirsttheme_sanitize_radio( $input, $setting ) {
            // Ensure input is a slug.
            $input = sanitize_key( $input );
            
            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;
            
            // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }

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

        $wp_customize->add_section( 'front-page-layout' , array(
            'title'      => __( 'Front Page Layout', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 20,
        ) );

        $wp_customize->add_section( 'single-post-layout' , array(
            'title'      => __( 'Single Post Layout', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 30,
        ) );

        $wp_customize->add_section( 'single-page-layout' , array(
            'title'      => __( 'Single Page Layout', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 40,
        ) );

        $wp_customize->add_section( 'archive-layout' , array(
            'title'      => __( 'Archive Layout', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 50,
        ) );

        $wp_customize->add_section( 'footer' , array(
            'title'      => __( 'Footer', 'myfirsttheme' ),
            'panel' => 'appearance',
            'priority'   => 60,
        ) );

        // Adding controls - main site
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background_color', array(
            'label'      => __( 'Primary color', 'myfirsttheme' ),
            'section'    => 'colors',
            'settings'   => 'menu_background_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_font_color', array(
            'label'      => __( 'Menu font color', 'myfirsttheme' ),
            'section'    => 'colors',
            'settings'   => 'menu_font_color',
            // 'type'       => ''                       // do not set type for color picker
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
            'label'      => __( 'Secondary color', 'myfirsttheme' ),
            'section'    => 'colors',
            'settings'   => 'link_hover_color',
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
            'section'    => 'front-page-layout',
            'settings'   => 'left-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right_column', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'front-page-layout',
            'settings'   => 'right-column',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta', array(
            'label'      => __( 'Enable post meta on front page and archives', 'myfirsttheme' ),
            'section'    => 'front-page-layout',
            'settings'   => 'post-meta',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'front-page-and-archive-image', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'myfirsttheme' ),
            'section'    => 'front-page-layout',
            'settings'   => 'front-page-and-archive-image',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );

        $wp_customize->add_control( 'excerpt-length', array(
            'label'      => __( 'Choose Excerpt Length', 'myfirsttheme' ),
            'section'    => 'front-page-layout',
            'settings'   => 'excerpt-length',
            'type'       => 'number',
        ) );

        $wp_customize->add_control( 'footer-column-1', array(
            'label'      => __( ' Display footer sidebar 1', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-1',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-column-2', array(
            'label'      => __( ' Display footer sidebar 2', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-2',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-column-3', array(
            'label'      => __( ' Display footer sidebar 3', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'footer-column-3',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'footer-social-icon', array(
            'label'      => __( 'Enable social icons section', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'footer-social-icon',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'social-icon-facebook', array(
            'label'      => __( 'Link to your Facebook', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-facebook',
        ) );

        $wp_customize->add_control( 'social-icon-instagram', array(
            'label'      => __( 'Link to your Instagram', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-instagram',
        ) );

        $wp_customize->add_control( 'social-icon-twitter', array(
            'label'      => __( 'Link to your Twitter', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-twitter',
        ) );

        $wp_customize->add_control( 'social-icon-pinterest', array(
            'label'      => __( 'Link to your Pinterest', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-pinterest',
        ) );

        $wp_customize->add_control( 'social-icon-youtube', array(
            'label'      => __( 'Link to your Youtube', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-youtube',
        ) );

        $wp_customize->add_control( 'social-icon-whatsapp', array(
            'label'      => __( 'Link to your Whatsapp', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-whatsapp',
        ) );

        $wp_customize->add_control( 'social-icon-messenger', array(
            'label'      => __( 'Link to your Messenger', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-messenger',
        ) );

        $wp_customize->add_control( 'social-icon-linkedin', array(
            'label'      => __( 'Link to your Linkedin', 'myfirsttheme' ),
            'section'    => 'footer',
            'settings'   => 'social-icon-linkedin',
        ) );
        
        // Adding controls - single post
        $wp_customize->add_control( 'left-column-single', array(
            'label'      => __( 'Display left column', 'myfirsttheme' ),
            'section'    => 'single-post-layout',
            'settings'   => 'left-column-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-single', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'single-post-layout',
            'settings'   => 'right-column-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-meta-single', array(
            'label'      => __( 'Enable post meta', 'myfirsttheme' ),
            'section'    => 'single-post-layout',
            'settings'   => 'post-meta-single',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-post', array(
            'label'      => __( 'Display header image', 'myfirsttheme' ),
            'section'    => 'single-post-layout',
            'settings'   => 'display-header-image-on-post',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'post-image-single', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'myfirsttheme' ),
            'section'    => 'single-post-layout',
            'settings'   => 'post-image-single',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );

        // Adding controls - single page
        $wp_customize->add_control( 'left-column-single-page', array(
            'label'      => __( 'Display left column', 'myfirsttheme' ),
            'section'    => 'single-page-layout',
            'settings'   => 'left-column-single-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-single-page', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'single-page-layout',
            'settings'   => 'right-column-single-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'page-meta', array(
            'label'      => __( 'Enable post meta', 'myfirsttheme' ),
            'section'    => 'single-page-layout',
            'settings'   => 'page-meta',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-page', array(
            'label'      => __( 'Display header image', 'myfirsttheme' ),
            'section'    => 'single-page-layout',
            'settings'   => 'display-header-image-on-page',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'page-image', array(
            'label'      => __( 'Post Image Position on Front Page and Archives Pages', 'myfirsttheme' ),
            'section'    => 'single-page-layout',
            'settings'   => 'page-image',
            'type'       => 'radio',
            'choices'    => array(
                'left' => 'Left side',
                'above' => 'Above text',
            ),
        ) );

        // Adding controls - archive page
        $wp_customize->add_control( 'left-column-archive', array(
            'label'      => __( 'Display left column', 'myfirsttheme' ),
            'section'    => 'archive-layout',
            'settings'   => 'left-column-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'right-column-archive', array(
            'label'      => __( 'Display right column', 'myfirsttheme' ),
            'section'    => 'archive-layout',
            'settings'   => 'right-column-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'display-header-image-on-archive', array(
            'label'      => __( 'Display header image', 'myfirsttheme' ),
            'section'    => 'archive-layout',
            'settings'   => 'display-header-image-on-archive',
            'type'       => 'checkbox'
        ) );

        $wp_customize->add_control( 'taxonomy-description', array(
            'label'      => __( 'Taxonomy description position', 'myfirsttheme' ),
            'section'    => 'archive-layout',
            'settings'   => 'taxonomy-description',
            'type'       => 'radio',
            'choices'    => array(
                'top' => 'Above content',
                'bottom' => 'Below content',
                'none'  => 'None'
            ),
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

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 1', 'myfirsttheme' ),
            'id'            => 'sidebar-footer-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 2', 'myfirsttheme' ),
            'id'            => 'sidebar-footer-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar 3', 'myfirsttheme' ),
            'id'            => 'sidebar-footer-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'myfirsttheme_widgets_init' );


    // Add custom style to wordpress elements
    function myfisttheme_set_custom_styles() {
        $color = get_theme_mod( 'menu_background_color', '#a8c5ff' );
        $fontColor = get_theme_mod( 'menu_font_color', '#1e73be' );
        $linkHoverColor = get_theme_mod( 'link_hover_color', '#515151' );
        ?>
            <style>
                .page-numbers {
                    border: 1px solid <?php echo sanitize_hex_color( $color ) ?>;
                }
                .page-numbers:hover {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                    text-decoration: none;
                }
                .current {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                .dots:hover {
                    background-color: unset;
                }
                .menu-item, .page-item, .page_item {
                    color: <?php echo sanitize_hex_color( $fontColor ) ?>;
                }
                .menu-item:hover > ul li a:hover, .page-item:hover > ul li a:hover, .page_item:hover > ul li a:hover {
                    background-color: rgba( 255, 255, 255, 0.2 );
                }
                a {
                    color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                a:hover {
                    color: <?php echo sanitize_hex_color( $linkHoverColor ) ?>;
                }
                .article > h2 a:hover {
                    color: <?php echo sanitize_hex_color( $linkHoverColor ) ?>;
                }
                .current-menu-item > a {
                    color: <?php echo sanitize_hex_color( $linkHoverColor ) ?>;
                }
                .menu-navigation .sub-menu, .menu-navigation .children {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                .widget-title {
                    border-bottom: 2px solid <?php echo sanitize_hex_color( $color ) ?>;
                }
                .submit {
                    border: 2px solid <?php echo sanitize_hex_color( $color ) ?>;
                    color: <?php echo sanitize_hex_color( $color ) ?>;
                    /* color: <?php echo sanitize_hex_color( $fontColor ) ?>; */
                }
                .submit:hover {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                    border: 2px solid <?php echo sanitize_hex_color( $color ) ?>;
                    color: <?php echo sanitize_hex_color( $fontColor ) ?>;
                }
                .submit:focus:hover {
                    color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                .read-more-button:hover {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                .post-categories a {
                    border: 1px solid <?php echo sanitize_hex_color( $color ) ?>;
                }
                .post-categories a:hover {
                    background-color: <?php echo sanitize_hex_color( $color ) ?>;
                }
                .wp-block-embed-twitter, .wp-block-embed-facebook {
                    border-bottom: 2px solid <?php echo sanitize_hex_color( $color ) ?>;
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
    add_action('wp_head', 'myfisttheme_set_custom_styles');


    // Set post excerpt length
    function myfisttheme_custom_excerpt_length( $length ) {
        $excerptLength = absint( get_theme_mod( 'excerpt-length' ) );
        return $excerptLength;
    }
    add_filter( 'excerpt_length', 'myfisttheme_custom_excerpt_length');

    function myfisttheme_excerpt_more( $more ) {
        $excerptLength = absint( get_theme_mod( 'excerpt-length' ) );
        if ($excerptLength === 0) {
            return '';
        } else {
            return "<a class='read-more-link' href='".get_permalink()."'><div class='read-more-button' style='border: 1px solid ".sanitize_hex_color( get_theme_mod( 'menu_background_color', '#696969' ) )."'>".__( 'Read more...', 'myfirsttheme')."</div></a>";
        }
    }
    add_filter( 'excerpt_more', 'myfisttheme_excerpt_more' );


    // delete cookies checkbox from comment form
    remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );



    // Adding selective settings refresh for header title and document title
    function myfirsttheme_register_partials( WP_Customize_Manager $wp_customize ) {
        // Abort if selective refresh is not available.
        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_setting( 'menu_font_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

        $wp_customize->selective_refresh->add_partial( 'header_site_title', array(
            'selector' => '.header-text div',
            'settings' => array( 'blogname', 'blogdescription', 'header_textcolor' ),
            'render_callback' => function() {
                echo "<h2 style='color: #".esc_attr(get_header_textcolor())."'>".get_bloginfo( 'name' )."</h2>";
                echo "<h5 style='color: #".esc_attr(get_header_textcolor())."'>".get_bloginfo( 'description' )."</h5>";
            },
        ) );
    
        // $wp_customize->selective_refresh->add_partial( 'document_title', array(
        //     'selector' => 'head title',
        //     'settings' => array( 'blogname' ),
        //     'render_callback' => 'wp_get_document_title',
        // ) );

        $wp_customize->selective_refresh->add_partial( 'header_menu_text', array(
            'selector' => '#navigation',
            'settings' => array( 'menu_font_color' ),
            'render_callback' => function() {
                $fontColor = get_theme_mod( 'menu_font_color' , '#fff' );
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu-class',
                        'before' => '<span style="color: '.sanitize_hex_color( $fontColor ).'">',
                        'after'  => '</span>',
                    )
                );
            },
        ) );
    }
    add_action( 'customize_register', 'myfirsttheme_register_partials' );

?>

