<?php

if ( !class_exists( 'AVA_Theme_Options' ) ) {

	class AVA_Theme_Options extends AVA_Options {

		public $option_name = 'ava_theme_options';

		public $page_slug = 'ava-theme-options';

		public $multisite_page_slug = 'ava-theme-multisite-options';


		public function __construct( ) {

			parent::__construct();



			// Set the default arguments
			//$this->getArguments();

			// Create the sections and fields
			//$this->setSections( 'theme-options' );

			// Output options
			//$this->show();

		}

		public function getArguments() {
			$this->settings = array(
				'dev_mode'              => false,
				'dev_mode_icon_class'   => 'icon-large',
				'opt_name'              => $this->option_name,
				'output_tag'            => true,
				//'display_name'          => "<img src='" .  AVA_THEME_URL . "/assets/logo.png' style='height:50px;' alt='AVA Theme'/>",
				'display_name'        => __('WP Magic Theme', 'ava-theme'),
				'display_version'       => 'v' . AVA_THEME_VERSION,
				'google_api_key'        => 'AIzaSyBZYcKMU9hkCC9iBnDj3kdcX6c9E571vWw',
				'import_icon_class'     => 'icon-large',
				'default_icon_class'    => 'icon-large',
				'menu_type'             => 'submenu',
				'page_parent'           => 'options-general.php',
				'menu_title'            => __( 'WP Magic Options', 'ava-theme' ),
				'page_title'            => __( 'WP Magic Options', 'ava-theme' ),
				'page_slug'             => $this->page_slug,
				'default_show'          => false,
				'default_mark'          => '*',
				'allow_sub_menu'        => true,
				'menu_icon'             =>'dashicons-intense-intense-logo',
				'show_import_export'    => false,
				'admin_bar'             => false,
				'share_icons' => array(
					'twitter' => array(
						'link' => 'https://twitter.com/IntenseVisions',
						'title' => 'Follow Intense Visions on Twitter',
						'icon'  => 'el el-icon-twitter'
					),
					'facebook' => array(
						'link' => 'https://www.facebook.com/intensevision',
						'title' => 'Like Intense Visions on Facebook',
						'icon'  => 'el el-icon-facebook'
					),
					'google' => array(
						'link' => 'https://plus.google.com/b/100661863245884531948/100661863245884531948/',
						'title' => '+1 Intense Visions on Google+',
						'icon'  => 'el el-icon-googleplus'
					)
				),
				
				// HINTS
				/*
				'hints' => array(
					'icon'              => 'el icon-question-sign',
					'icon_position'     => 'right',
					'icon_color'        => 'lightgray',
					'icon_size'         => 'normal',
					
					'tip_style'         => array(
						'color'     => 'light',
						'shadow'    => true,
						'rounded'   => false,
						'style'     => '',
					),
					'tip_position'      => array(
						'my' => 'top left',
						'at' => 'bottom left',
					),
					'tip_effect' => array(
						'show' => array(
							'effect'    => 'slide',
							'duration'  => '500',
							'event'     => 'mouseover',
						),
						'hide' => array(
							'effect'    => 'slide',
							'duration'  => '500',
							'event'     => 'click mouseleave',
						),
					),
					
				),
				*/
			
				
			);
		}
		
		
	}
}
