<?php

if ( !class_exists( 'WPMagic_Options' ) ) {

	abstract class WPMagic_Options {

		// Options block settings
		public $settings;

		// Options name
		public $option_name;

		// Options values
		public $options = array();

		// Options secctions
		public $sections = array();

		// Options page slug
		public $page_slug;

		// Options multisite page slug
		public $multisite_page_slug;
		
		
		public $ReduxFramework;



		public function __construct( ) {

			// Set the notices so we don't see the nagware
			$GLOBALS['redux_notice_check'] = 1;
			
			if ( !class_exists( 'ReduxFramework' ) && file_exists( WPM_THEME_VENDOR_DIR . '/redux-framework//ReduxCore/framework.php' ) ) {
				require_once WPM_THEME_VENDOR_DIR . '/redux-framework/ReduxCore/framework.php';
			}
			
			if ( !class_exists( "ReduxFramework" ) ) {
				return;
			}

			// Get options
			$this->getOptions();


			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
			

			// Dynamically add a section. Can be also used to modify sections/fields
			//add_filter( 'redux/options/'.$this->settings['opt_name'].'/sections', array( $this, 'dynamic_section' ) );

			// Add custom CSS for the options
			//add_action( 'redux/page/'.$this->settings['opt_name'].'/enqueue', array( $this, 'addPanelCSS' ) );

			// Add custom CSS for the options
			//add_action( 'redux/options/'.$this->settings['opt_name'].'/settings/change', array( $this, 'options_settings_change' ) );

			// run code after save
			//add_action( 'redux/options/'.$this->settings['opt_name'].'/saved', array( $this, 'options_saved' ) );

			//add_action( 'redux/extension/customizer/control/includes', array( $this, 'customizer_fields') );



		}

		public function show() {
			
			add_filter( "redux/wpm_theme_options/field/class/edd_license", "overload_edd_license_field_path" );
			
			//dump($this->options);
			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->settings );
		}

		/*
		public function customizer_fields() {
			require_once INTENSE_PLUGIN_FOLDER . '/inc/options/redux/customizer_fields.php';
		}

		public function options_saved( $directory = null ) {
			Intense()->options = get_option( 'wpm_options' );

			if (!empty( Intense()->options['intense_cache_clear'] ) ) {
				Intense()->clear_cache( $directory );
			}

			//remove transients
			delete_transient( INTENSE_PLUGIN_VERSION . '::Intense_Shortcodes::dialog' );
		}


		public function addPanelCSS() {
			$minified = ( INTENSE_DEBUG ? "" : "min." );

			wp_register_style(
				'intense-redux-custom-css',
				INTENSE_PLUGIN_URL . '/assets/css/intense/options.' . $minified . 'css',
				array(), //array( 'redux-css' ), // Be sure to include redux-css so it's appended after the core css is applied
				time(),
				'all'
			);
			wp_enqueue_style( 'intense-redux-custom-css' );
		}
		*/

		public function options_settings_change() {
			flush_rewrite_rules(); //Resets the permalinks
		}

		public function getOptions() {
			$this->options = get_option( $this->option_name );
		}

		public function setSections( $dirname ) {
			foreach ( glob(WPM_THEME_CORE_DIR . '/options/' . $dirname . '/*.php') as $file ) {
				require $file;
			}
		}



		/*
		function dynamic_section( $sections ) {

			$this->setOAuth();	
			
			require INTENSE_PLUGIN_FOLDER . '/inc/options/photosource.php';

			if ( intense_is_settings_page() ) {
				require INTENSE_PLUGIN_FOLDER . '/inc/options/import_export.php';
			}

			foreach ( Intense()->shortcode_list as $shortcode_class => $shortcode_info) {				
				$title = ucwords( str_replace( '-', ' ', $shortcode_info['directory'] ) );
				$key = $shortcode_info['directory'];

				$sections['Shortcodes']['fields']['intense_active_shortcodes']['options'][ strtolower( $shortcode_class ) ] = $title;
				$sections['Shortcodes']['fields']['intense_active_shortcodes']['default'][ strtolower( $shortcode_class ) ] = 1;

				if ( isset( $shortcode_info[ 'css' ] ) ) {
					$sections['Shortcodes']['fields']['intense_shortcode_css']['options'][ $key ] = $title;
					$sections['Shortcodes']['fields']['intense_shortcode_css']['default'][ $key ] = 1;
				}
			}

			natcasesort( $sections['Shortcodes']['fields']['intense_active_shortcodes']['options'] );
			natcasesort( $sections['Shortcodes']['fields']['intense_shortcode_css']['options'] );

			return $sections;
		}
		*/

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		public function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link' ), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );

		}

		public function is_options_page() {
			return is_admin() && isset( $_GET['page'] ) && ( $_GET['page'] == $this->page_slug || $_GET['page'] == $this->multisite_page_slug );
		}

		public static function get_roles_option_names() {
			global $wp_roles;

			if ( ! isset( $wp_roles ) )
			    $wp_roles = new WP_Roles();

			$roles = $wp_roles->get_names();

			return $roles;
		}
		
		
		// Get options parameters
		abstract public function getArguments();
		
		
	}
	
	
	
}
