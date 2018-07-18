<?php

/**
 * Front controller
 **/
class AVA_Theme_Front extends AVA_Theme_Controller {

	public $messages;
	public $errors;

	/**
	 * Constructor
	**/
	function __construct() {
		parent::__construct();
		
		// wp
		add_action( 'wp', array( $this, 'routes' ) );

		// init
		add_action( 'init', array( $this, 'init' ) );

		// add site icon
		add_action( 'wp_head', array( $this, 'add_site_icon' ) );

		// load assets
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );

		// Change excerpt dots
		add_filter( 'excerpt_more', array( $this, 'change_excerpt_more' ) );

		// Form body class
		add_filter( 'body_class', function ($classes = array()) {
			global $post;
			
			return $classes;
		}, 99);

		// Search only in blog posts
		add_filter( 'pre_get_posts', function($query) {
			if ( $query->is_search ) {
				$query->set( 'post_type', 'post' );
			}
			return $query;
		});
	}


	/**
	 * Init
	 **/
	function init() {
	
	}

	/**
	 * Routes
	 **/
	function routes() {
		global $post;
	}

	/**
	 * Add site icon from customizer
	**/
	function add_site_icon() {

		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			wp_site_icon();
		}

	}

	/**
	 * Load JavaScript and CSS files in a front-end
	**/
	function load_assets() {
		
		// CSS styles
		wp_enqueue_style( 'ava-theme-bootstrap-grid', AVA_THEME_URL . '/assets/libs/bootstrap/bootstrap-grid'.AVA_THEME_MINIFY.'.css', false, AVA_THEME_CACHE_TIME );
		wp_enqueue_style( 'ava-theme-animate', AVA_THEME_URL . '/assets/css/animate'.AVA_THEME_MINIFY.'.css', false, AVA_THEME_CACHE_TIME );
		wp_enqueue_style( 'ava-theme-style', AVA_THEME_URL . '/assets/css/style'.AVA_THEME_MINIFY.'.css', false, AVA_THEME_CACHE_TIME );
		
		// JS scripts
		wp_register_script( 'ava-theme-html5', AVA_THEME_URL. '/assets/libs/html5'.AVA_THEME_MINIFY.'.js', array( 'jquery' ), AVA_THEME_CACHE_TIME, true );
		wp_register_script( 'ava-theme-waypoints', AVA_THEME_URL. '/assets/libs/waypoints/jquery.waypoints'.AVA_THEME_MINIFY.'.js', array( 'jquery' ), AVA_THEME_CACHE_TIME, true );
		wp_register_script( 'ava-theme-main', AVA_THEME_URL . '/assets/js/main'.AVA_THEME_MINIFY.'.js', array( 'jquery' ), AVA_THEME_CACHE_TIME, true );

		$js_vars = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'assetsPath' => AVA_THEME_URL . '/assets',
		);

		wp_enqueue_script( 'ava-theme-html5' );
		wp_enqueue_script( 'ava-theme-waypoints' );
		wp_enqueue_script( 'ava-theme-main' );
		wp_localize_script( 'ava-theme-main', 'avaTheme', $js_vars );

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		//wp_link_pages( array() );
	}

	/**
	 * Change excerpt More text
	 **/
	function change_excerpt_more( $more ) {
		return '...';
	}
}
