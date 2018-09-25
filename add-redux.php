<?php

if ( ! function_exists( "redux_add_metaboxes" ) ):
	function redux_add_metaboxes( $metaboxes ) {
		// Declare your sections
		$boxSections   = array();
		$boxSections[] = array(
			//'title'         => __('General Settings', 'redux-framework-demo'),
			//'icon'          => 'el-icon-home', // Only used with metabox position normal or advanced
			'fields' => array(
				array(
					'id'   => 'sidebar',
					//'title' => __( 'Sidebar', 'redux-framework-demo' ),
					'desc' => 'Please select the sidebar you would like to display on this page. Note: You must first create the sidebar under Appearance > Widgets.',
					'type' => 'select',
					'data' => 'sidebars',
				),
			),
		);
		
		// Declare your metaboxes
		$metaboxes   = array();
		$metaboxes[] = array(
			'id'         => 'sidebar',
			'title'      => __( 'Sidebar', 'fusion-framework' ),
			'post_types' => array( 'page', 'post' ),
			//'page_template' => array('page-test.php'), // Visibility of box based on page template selector
			//'post_format' => array('image'), // Visibility of box based on post format
			'position'   => 'side', // normal, advanced, side
			'priority'   => 'high', // high, core, default, low - Priorities of placement
			'sections'   => $boxSections,
		);
		
		return $metaboxes;
	}
	
	// Change {$redux_opt_name} to your opt_name
	add_action( "redux/metaboxes/pages/boxes", "redux_add_metaboxes" );
endif;