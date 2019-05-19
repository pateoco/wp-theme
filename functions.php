<?php

  function remove_bloat() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action( 'wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
  }

  function remove_scripts(){
    wp_deregister_script('wp-embed');
    wp_deregister_script('jquery');
  }

  function add_theme_supports() {
    add_theme_support( 'menus' );
  }

  // Function to remove version numbers
  function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
      $src = remove_query_arg( 'ver', $src );
    return $src;
  }

  function remove_versioning() {
    add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );
  }

  function add_theme_styles() {
    // wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
    wp_enqueue_style('lato', 'https://fonts.googleapis.com/css?family=Lato:400,700,900');
    wp_enqueue_style('ionicons', 'https://unpkg.com/ionicons@4.4.8/dist/css/ionicons.min.css');
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_style('style', get_stylesheet_uri());
  }
  
  function add_theme_scripts() {
    // Remove included jquery with wordpress
    wp_deregister_script('jquery');
    // Add our own jquery from cdn
    wp_enqueue_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"), false);
    wp_enqueue_script('nav-js', get_stylesheet_directory_uri() . '/js/nav.js');
    wp_enqueue_script('parallax-js', get_stylesheet_directory_uri() . '/js/parallax.min.js');
    wp_enqueue_script('waypoints-js', get_stylesheet_directory_uri() . '/js/jquery.waypoints.min.js');
    wp_enqueue_script('navtrigger-js', get_stylesheet_directory_uri() . '/js/navtrigger.js');
    wp_enqueue_script('scrollto-js', get_stylesheet_directory_uri() . '/js/scrollto.js');
    wp_enqueue_script('svg-fallback-js', get_stylesheet_directory_uri() . '/js/svg-fallback.js');
    wp_enqueue_script('parallax-funcs-js', get_stylesheet_directory_uri() . '/js/parallax-funcs.js');
  }
  
  function register_menus() {
    register_nav_menus(
      array(
        'header-menu' => ('Header Menu')
      )
    );
  }

  // INITIALIZE FUNCTIONS

  remove_bloat();
  remove_versioning();
  add_theme_supports();

  // CUSTOM SCRIPTS
  add_action('wp_enqueue_scripts', 'add_theme_styles');
  add_action('wp_footer', 'add_theme_scripts');
  add_action('init', 'register_menus');