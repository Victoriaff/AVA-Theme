<?php

if ( ! class_exists( 'AVA_Theme' ) ) {
	class AVA_Theme {
		
		private static $instance;
		
		public $options;
		
		public $config;
		
		public $admin;
		
		public $front;
		
		public $avafw;
		
		
		/**
		 * Constructor
		 */
		private function __construct() {
			
			// Theme setup
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			
			// Widgets area
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
			
			/**
			 * Enqueue scripts and styles.
			 */
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			
			
			// Autoload classes
			/*
			$this->autoload();
			
			// Register activation hook
			register_activation_hook( __FILE__, array( $this, 'activationPlugin' ) );
			
			// Register deactivation hook
			register_deactivation_hook( __FILE__, array( $this, 'deactivationPlugin' ) );
			
			// Add item to admin bar menu
			add_action( 'admin_bar_menu', array( $this, 'adminBarMenu' ), 100 );
			
			// Final point
			add_action( 'shutdown', array( $this, 'finalPoint' ), 10 );
			
			// User Interface
			add_action( 'wp_footer', array( $this, 'ui' ), 1000 );
			add_action( 'admin_footer', array( $this, 'ui' ), 1000 );
			
			// Enqueue scripts & styles
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );
			*/
			
			
		}
		
		public function init() {
			
			// Load config
			$this->load_config();
			
			// Load core files
			$this->load_core();
			
			// Load controllers
			require_once AVA_THEME_CORE_DIR . '/controller/controller.php';
			
			// Controllers for back-end part only
			if ( is_admin() ) {
				require_once AVA_THEME_CORE_DIR . '/controller/admin.php';
				$this->admin = new AVA_Theme_Admin();
				$this->admin->init();
			}
			
			// Controllers for front-end part only
			if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
				require_once AVA_THEME_CORE_DIR . '/controller/front.php';
				$this->front = new AVA_Theme_Front();
				$this->front->init();
			}
		}
		
		/**
		 * Get the instance
		 *
		 * @return self
		 */
		public static function instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		/**
		 * Get config file
		 *
		 * @return self
		 */
		public function load_config() {
			$cfile = AVA_THEME_DIR . '/core/config.php';
			if ( file_exists( $cfile ) ) {
				$this->config = require $cfile;
			}
		}
		
		/**
		 * Get config value
		 *
		 */
		public function config( $key = null ) {
			if ( ! $key ) {
				return $this->config;
			}
			if ( ! empty( $this->config[ $key ] ) )
				return $this->config[ $key ];
			else
				return '';
		}
		
		/**
		 * Load core files
		 */
		public function load_core() {
			
			// Load helpers
			foreach (glob( AVA_THEME_CORE_DIR . '/helpers/*.php' ) as $file ) {
				require_once $file;
			}
			
			// Load classes
			foreach (glob( AVA_THEME_CORE_DIR . '/classes/*.php' ) as $file ) {
				require_once $file;
			}
			
			// Load only for admin part
			if ( is_admin() ) {
				// Redux
				require_once AVA_THEME_VENDOR_DIR . '/redux-framework/ReduxCore/framework.php';
			}
		}
		
		/**
		 * Options
		 */
		public function options( $key = null ) {
			if ( empty( $this->options ) ) {
				$this->options = get_option( 'ava_theme_options' );
			}
			if ( empty( $this->options ) ) {
				return;
			}
			
			if ( ! $key ) {
				return $this->options;
			} else if ( isset( $this->options[ $key ] ) ) {
				return $this->options[ $key ];
			}
		}
		
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 */
		public function theme_setup() {
			/*
             * Make theme available for translation.
             * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
             * If you're building a theme based on Twenty Seventeen, use a find and replace
             * to change 'twentyseventeen' to the name of your theme in all the template files.
             */
			load_theme_textdomain( 'ava-theme' );
			
			/**
			 * Add default posts and comments RSS feed links to head
			 */
			add_theme_support( 'automatic-feed-links' );
			
			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );
			
			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
			
			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			) );
			
			/**
			 * This theme uses wp_nav_menu() in two locations.
			 */
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', 'ava-theme' )
			) );
			
			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 */
			add_theme_support( 'post-thumbnails' );
			
			set_post_thumbnail_size( 500, 260, true );
			
			add_image_size( 'full-post-thumbnails', 900, 400, true );
			//add_image_size( 'slider-thumb', 608, 300, true );
			//add_image_size( 'main-slider', 1920, 900, true );
			
			//add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );
			//add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );
			
			
			/*
			 * This theme styles the visual editor to resemble the theme style,
			 * specifically font, colors, and column width.
			  */
			//add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );
			//add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', fruitful_fonts_url() ) );
			
			
			// Set the default content width.
			if ( ! isset( $GLOBALS['content_width'] ) ) {
				$GLOBALS['content_width'] = 900;
			}
			
			
			// Add theme support for Custom Logo.
			/*
			add_theme_support( 'custom-logo', array(
				'width'       => 250,
				'height'      => 250,
				'flex-width'  => true,
			) );
			*/
			
			// Add theme support for selective refresh for widgets.
			//add_theme_support( 'customize-selective-refresh-widgets' );
			
			
			// Define and register starter content to showcase the theme on new sites.
			$starter_content = array(
				'widgets'     => array(
					// Place three core-defined widgets in the sidebar area.
					'sidebar-1' => array(
						'search',
					),
					
					// Add the core-defined business info widget to the footer 1 area.
					'sidebar-2' => array(),
					
					// Put two core-defined widgets in the footer 2 area.
					'sidebar-3' => array(),
				),
				
				// Specify the core-defined pages to create and add custom thumbnails to some of them.
				'posts'       => array(
					'home',
					'about'            => array(
						'thumbnail' => '{{image-sandwich}}',
					),
					'contact'          => array(
						'thumbnail' => '{{image-espresso}}',
					),
					'blog'             => array(
						'thumbnail' => '{{image-coffee}}',
					),
					'homepage-section' => array(
						'thumbnail' => '{{image-espresso}}',
					),
				),
				
				// Create the custom image attachments used as post thumbnails for pages.
				'attachments' => array(
					'image-espresso' => array(
						'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
						'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
					),
					'image-sandwich' => array(
						'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
						'file'       => 'assets/images/sandwich.jpg',
					),
					'image-coffee'   => array(
						'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
						'file'       => 'assets/images/coffee.jpg',
					),
				),
				
				// Default to a static front page and assign the front and posts pages.
				'options'     => array(
					'show_on_front'  => 'page',
					'page_on_front'  => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),
				
				// Set the front page section theme mods to the IDs of the core-registered pages.
				'theme_mods'  => array(
					'panel_1' => '{{homepage-section}}',
					'panel_2' => '{{about}}',
					'panel_3' => '{{blog}}',
					'panel_4' => '{{contact}}',
				),
				
				/*
				// Set up nav menus for each of the two areas registered in the theme.
				'nav_menus' => array(
					// Assign a menu to the "top" location.
					'primary' => array(
						'name' => __( 'Primary Menu', 'ava-theme' ),
						'items' => array(
							'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
							'page_about',
							'page_blog',
							'page_contact',
						),
					),
				
				),
				*/
			);
			
			/**
			 * Filter array of starter content.
			 *
			 * @since AVA Theme 1.0
			 *
			 * @param array $starter_content Array of starter content.
			 */
			$starter_content = apply_filters( 'ava_theme_starter_content', $starter_content );
			
			add_theme_support( 'starter-content', $starter_content );
		}
		
		
		/**
		 * Register custom fonts.
		 */
		function custom_fonts_url() {
			$fonts_url = '';
			
			/*
			 * Translators: If there are characters in your language that are not
			 * supported by Libre Franklin, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );
			
			if ( 'off' !== $libre_franklin ) {
				$font_families = array();
				
				$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';
				
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin,latin-ext' ),
				);
				
				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			}
			
			return esc_url_raw( $fonts_url );
		}
		
		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		function widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Right Sidebar', 'ava-theme' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ava-theme' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			
			register_sidebar( array(
				'name'          => __( 'Left Sidebar', 'ava-theme' ),
				'id'            => 'sidebar-2',
				'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ava-theme' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			
			register_sidebar( array(
				'name'          => __( 'Footer', 'ava-theme' ),
				'id'            => 'sidebar-3',
				'description'   => __( 'Add widgets here to appear in your footer.', 'ava-theme' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			
			register_sidebar( array(
				'name'          => __( 'Pre Footer', 'ava-theme' ),
				'id'            => 'sidebar-4',
				'description'   => __( 'Add widgets here to appear in your footer.', 'ava-theme' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			
			if ( class_exists( 'woocommerce' ) ) {
				register_sidebar( array(
					'name'          => __( 'Shop Page Sidebar', 'ava-theme' ),
					'id'            => 'sidebar-5',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
				
				register_sidebar( array(
					'name'          => __( 'Product Page Sidebar', 'ava-theme' ),
					'id'            => 'sidebar-6',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
			}
		}
		
		
		/**
		 * Enqueue scripts and styles.
		 */
		function enqueue_scripts() {
			
			if ( is_admin() ) {
			} else {
				// Theme stylesheet.
				wp_enqueue_style( 'ava-bootstrap-grid', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap-grid.css' ) );
				
				wp_enqueue_style( 'ava-core-style', get_stylesheet_uri() );
				wp_enqueue_style( 'ava-theme-style', get_theme_file_uri( '/assets/css/style.css' ) );
				
				// Animation
				wp_enqueue_style( 'ava-animate', get_theme_file_uri( '/assets/css/animate.css' ) );
				
				// JS
				wp_enqueue_script( 'ava-waypoints', get_theme_file_uri( '/assets/libs/waypoints/jquery.waypoints.js' ), array( 'jquery' ) );
				wp_enqueue_script( 'ava-main', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ) );
				
				
				// Load the html5 shiv.
				wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
				wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
				
				
			}
			// Add custom fonts, used in the main stylesheet.
			//wp_enqueue_style( 'ava-theme-fonts', $this->custom_fonts_url(), array(), null );
			
			
			// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
			//if ( is_customize_preview() ) {
			//wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
			//wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
			//}
			
			// Load the Internet Explorer 8 specific stylesheet.
			//wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
			//wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );
			
			
			//wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
			
			/*
			$twentyseventeen_l10n = array(
				'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
			);
			
			if ( has_nav_menu( 'top' ) ) {
				wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
				$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
				$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
				$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
			}
			*/
			
			//wp_enqueue_script( 'ava-theme-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
			
			//wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );
			
			//wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );
			
			/*
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			*/
		}
		
		
		
		
		
		
		/** Autoload classes */
		/*
		public function autoload() {
			
			require_once( WPDH_PLUGIN_DIR . '/core/data.php' );
			
			foreach ( glob( WPDH_PLUGIN_DIR . '/core/data/*.php' ) as $file ) {
				require_once( $file );
			}
		}
		*/
		
	}
}

if ( ! function_exists( 'ava_theme' ) ) {
	function ava_theme() {
		return AVA_Theme::instance();
	}
}
ava_theme()->init();




