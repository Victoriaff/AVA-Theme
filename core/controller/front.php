<?php

/**
 * Front controller
 **/
class WPMagic_Theme_Front extends WPMagic_Theme_Controller {

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
		wp_enqueue_style( 'wpm-theme-bootstrap-grid', WPM_THEME_URL . '/assets/libs/bootstrap/bootstrap-grid'.WPM_THEME_MINIFY.'.css', false, WPM_THEME_CACHE_TIME );
		wp_enqueue_style( 'wpm-theme-animate', WPM_THEME_URL . '/assets/css/animate'.WPM_THEME_MINIFY.'.css', false, WPM_THEME_CACHE_TIME );
		wp_enqueue_style( 'wpm-theme-style', WPM_THEME_URL . '/assets/css/style'.WPM_THEME_MINIFY.'.css', false, WPM_THEME_CACHE_TIME );
		
		// JS scripts
		wp_register_script( 'wpm-theme-html5', WPM_THEME_URL. '/assets/libs/html5'.WPM_THEME_MINIFY.'.js', array( 'jquery' ), WPM_THEME_CACHE_TIME, true );
		wp_register_script( 'wpm-theme-waypoints', WPM_THEME_URL. '/assets/libs/waypoints/jquery.waypoints'.WPM_THEME_MINIFY.'.js', array( 'jquery' ), WPM_THEME_CACHE_TIME, true );
		wp_register_script( 'wpm-theme-main', WPM_THEME_URL . '/assets/js/main'.WPM_THEME_MINIFY.'.js', array( 'jquery' ), WPM_THEME_CACHE_TIME, true );

		$js_vars = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'assetsPath' => WPM_THEME_URL . '/assets',
		);

		wp_enqueue_script( 'wpm-theme-html5' );
		wp_enqueue_script( 'wpm-theme-waypoints' );
		wp_enqueue_script( 'wpm-theme-main' );
		wp_localize_script( 'wpm-theme-main', 'wpmTheme', $js_vars );

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
