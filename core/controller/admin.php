<?php

/**
 * Admin controller
 **/
class WPMagic_Theme_Admin extends WPMagic_Theme_Controller {

	public $theme_options;
	
	
	/**
	 * Constructor
	**/
	function __construct() {
		parent::__construct();
		
		// Admin init
		add_action( 'admin_init', array( $this, 'admin_init') );
		
		// load admin assets
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets') );
		
		// Allow additional mime types
		add_filter( 'upload_mimes', array( $this, 'add_upload_types' ) );
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'ignore_upload_ext' ), 10, 4);
		
		// Register Demo data
		//add_filter( 'fw:ext:backups-demo:demos', array( $this, 'register_demo_data' ) );
	}
	
	
	function init() {
		// Load options
		$this->theme_options = new WPMagic_Theme_Options();
		
	}


	/**
	 * Admin init
	 **/
	public function admin_init() {
		if ( ! current_user_can( 'manage_options' ) && !defined('DOING_AJAX')  ) {
			wp_die( _('You are not allowed to access this part of the site') );
		}
	}


	/**
	 * Load admin assets
	**/
	public function load_assets() {
		wp_enqueue_style( 'eh-backend', get_template_directory_uri() . '/assets/css/admin.css' );
	}

	/**
	 * Allow additional mime types to upload
	 **/
	public function add_upload_types( $existing_mimes ) {
		$existing_mimes['ico'] = 'image/vnd.microsoft.icon';
		$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
		$existing_mimes['woff2'] = 'application/x-woff';
		$existing_mimes['woff'] = 'application/x-woff';
		$existing_mimes['ttf'] = 'application/octet-stream';
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['mp4'] = 'video/mp4';
		$existing_mimes['ogv'] = 'video/ogg';
		$existing_mimes['webm'] = 'video/webm';
		return $existing_mimes;
	}

	public function ignore_upload_ext( $checked, $file, $filename, $mimes ) {

		//we only need to worry if WP failed the first pass
		if(!$checked['type']){
			//rebuild the type info
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			$ext = $wp_filetype['ext'];
			$type = $wp_filetype['type'];
			$proper_filename = $filename;

			//preserve failure for non-svg images
			if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
				$ext = $type = false;
			}

			//everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.

			$checked = compact('ext','type','proper_filename');
		}

		return $checked;

	}

	/**
	 * Register demo data
	 **/
	public function register_demo_data() {

		//https://engine-hosting.fruitfulcode.com/wp-content/themes/engine-hosting/assets/images/demo-blue.png


		// list of available demos
		$demos = array(
			'blue' => array(
				'title'	=> esc_html__('Blue Demo', 'engine-hosting'),
				'screenshot'	=> 'https://engine-hosting.fruitfulcode.com/wp-content/themes/engine-hosting/screenshot.png',
				'preview_link' 	=> 'https://engine-hosting.fruitfulcode.com/',
				'url' => 'https://themes.fruitfulcode.com/dummy_data/engine-hosting/',
			),
			'light' => array(
				'title'	=> esc_html__('Light Demo', 'engine-hosting'),
				'screenshot'	=> 'https://engine-hosting-light.fruitfulcode.com/wp-content/themes/engine-hosting-light/screenshot.png',
				'preview_link' 	=> 'https://engine-hosting-light.fruitfulcode.com/',
				'url' => 'https://themes.fruitfulcode.com/dummy_data/engine-hosting/',
			)
		);

		$curr_url = get_template_directory_uri();

		foreach ($demos as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $data['url'],
				'file_id' => $id,
			));

			$demo->set_title( $data['title']);
			$demo->set_screenshot( $data['screenshot']);
			$demo->set_preview_link( $data['preview_link']);

			$demos_array[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos_array;
	}


}