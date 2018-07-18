<?php

define( 'AVA_THEME_NAME', 'Magic' );
define( 'AVA_THEME_VERSION', '1.0' );

define( 'AVA_THEME_DIR', get_template_directory() );
define( 'AVA_THEME_URL', get_template_directory_uri() );
define( 'AVA_THEME_CORE_DIR', get_template_directory() . '/core' );
define( 'AVA_THEME_VENDOR_DIR', get_template_directory() . '/vendor' );
define( 'AVA_THEME_CACHE_TIME', '100720181000' );
define( 'AVA_THEME_MINIFY', '' );

/*
define('CPOTHEME_LOGO_WIDTH', '170');
define('CPOTHEME_USE_SLIDES', true);
define('CPOTHEME_USE_FEATURES', true);
define('CPOTHEME_USE_PORTFOLIO', true);
define('CPOTHEME_USE_SERVICES', true);
define('CPOTHEME_USE_CLIENTS', true);
define('CPOTHEME_USE_TESTIMONIALS', true);
define('CPOTHEME_THUMBNAIL_WIDTH', '400');
define('CPOTHEME_THUMBNAIL_HEIGHT', '400');
define('CPOTHEME_PREMIUM_NAME', 'Brilliance Pro');
define('CPOTHEME_PREMIUM_URL', 'http://www.cpothemes.com/theme/brilliance');
*/

require_once AVA_THEME_CORE_DIR . '/ava-theme.php';

add_action( 'shutdown', function () {
	//dump(get_intermediate_image_sizes());
	//dump(wp_get_additional_image_sizes());
	//dd(get_image_sizes());
	
	//dump(get_option('ava_theme_options'));
} );

function overload_edd_license_field_path( $field ) {
	return dirname( __FILE__ ) . '/edd_license/field_edd_license.php';
}


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


############## AVA Fields #########################

if (class_exists('AVA_Fields')) {
//add_action( 'ava_fields/init', function () {

    $params = array(

        'container' => array(
            'type' => 'custom',
            'id' => 'my_options',
            'title' => __('Container title', ''),
            'subtitle' => __('Container subtitle', ''),
        ),

        'appearance' => array(//'nav_style' => 'horizontal', // horizontal | vertical
        ),

        'db' => array(
            'option_name' => '_my_options',
            'save_as' => 'array' // array | row, default - array
        ),

        'access' => array(
            'user_capability' => 'manage_options',

            'user_id' => array(
                'value' => 1,
                'except' => true
            ),

            'user_role' => 'administrator',

            // post_meta
            'post_format' => '',
            'post_id' => '',
            'post_level' => '',
            'post_ancestor_id' => '',
            'post_template' => '',
            'post_term' => '',
            'post_type' => '',

            // term_meta
            'term' => '',
            'term_parent' => '',
            'term_level' => '',
            'term_ancestor' => '',
            'term_taxonomy' => '',

            // theme_options
            'blog_id' => '',
        ),


    );

//    return;


    $container = AVA_Fields::make($params);

    $container->add_section('general', array(
        'title' => __('General', ''),
        'icon' => AVA_FIELDS_ICONS_URI . 'gray/general.png',
        'icon_type' => 'image',

        'fields' => array(

            // Text
            'text1' => array(
                'type' => 'text',
                'texts' => array(
                    'title' => __('Title', '{domain}'),
                    'subtitle' => __('Subtitle', '{domain}'),
                    'desc' => __('Description', '{domain}'),
                    'tip' => __('Help tip', '{domain}'),
                    'before' => __('Text left', '{domain}'),
                    'after' => __('Text right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'data-foo' => 'bar'
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => 'default value',
            ),

            // Textarea
            'textarea1' => array(
                'type' => 'textarea',
                'texts' => array(
                    'title' => __('Textarea', '{domain}'),
                    'subtitle' => __('Textarea subtitle', '{domain}'),
                    'desc' => __('Textarea description', '{domain}'),
                    'tip' => __('Textarea tip', '{domain}'),
                    'before' => __('TA left', '{domain}'),
                    'after' => __('TA right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'cols' => '60',
                    'rows' => 5
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => '',
            ),


        )
    ));

    $container->add_section('styling', array(
        'title' => __('Styling', ''),
        'icon' => AVA_FIELDS_ICONS_URI . 'gray/styling.png',
        'icon_type' => 'image',

        'fields' => array(

            /*
            'set1' => array(
                'id' => 'set1',
                'fields' => array(
                    // Text
                    '_text_set1' => array(
                        'type'      => 'text',
                        'set'       => 'inputs',
                        'texts'  => array(
                            'title'     => __('TextSet 1', '{domain}'),
                            'subtitle'  => __('Subtitle', '{domain}'),
                            'desc'      => __('Description', '{domain}'),
                            'tip'       => __('Help tip', '{domain}'),
                            'before'    => __('Text left', '{domain}'),
                            'after'     => __('Text right', '{domain}'),
                        ),
                        'attrs'  => array(
                            'class' => 'custom-class',
                            'data-foo' => 'bar'
                        ),
                        'validate'    => array(
                            'cond' => '', // not_empty
                            'regexp' => '', // regular expression
                            'message' => __('Field is mandatory', '')
                        ),
                        'value'   => 'default value',
                    ),
                    // Text
                    '_text_set2' => array(
                        'type'      => 'text',
                        'set'       => 'inputs',
                        'texts'  => array(
                            'title'     => __('TextSet 2', '{domain}'),
                            'subtitle'  => __('Subtitle', '{domain}'),
                            'desc'      => __('Description', '{domain}'),
                            'tip'       => __('Help tip', '{domain}'),
                            'before'    => __('Text left', '{domain}'),
                            'after'     => __('Text right', '{domain}'),
                        ),
                        'attrs'  => array(
                            'class' => 'custom-class',
                            'data-foo' => 'bar'
                        ),
                        'validate'    => array(
                            'cond' => '', // not_empty
                            'regexp' => '', // regular expression
                            'message' => __('Field is mandatory', '')
                        ),
                        'value'   => 'default value',
                    ),
                )
            ),
            */

            // Text
            'text2' => array(
                'type' => 'text',
                'texts' => array(
                    'title' => __('Title 2', '{domain}'),
                    'subtitle' => __('Subtitle', '{domain}'),
                    'desc' => __('Description', '{domain}'),
                    'tip' => __('Help tip', '{domain}'),
                    'before' => __('Text left', '{domain}'),
                    'after' => __('Text right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'data-foo' => 'bar'
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => 'default value2',
            ),

        )
    ));

    /********************************************************************
     *                          №2
     ********************************************************************/
/*
    $params = array(

        'container' => array(
            'type' => 'custom',
            'id' => 'my_options2',
            'title' => __('Container title', ''),
            'subtitle' => __('Container subtitle', ''),
        ),

        'appearance' => array(//'nav_style' => 'horizontal', // horizontal | vertical
        ),

        'db' => array(
            'option_name' => 'my_options',
            'save_as' => 'array' // array | row, default - array
        ),

        'access' => array(
            'user_capability' => 'manage_options',

            'user_id' => array(
                'value' => 1,
                'except' => true
            ),

            'user_role' => 'administrator',

            // post_meta
            'post_format' => '',
            'post_id' => '',
            'post_level' => '',
            'post_ancestor_id' => '',
            'post_template' => '',
            'post_term' => '',
            'post_type' => '',

            // term_meta
            'term' => '',
            'term_parent' => '',
            'term_level' => '',
            'term_ancestor' => '',
            'term_taxonomy' => '',

            // theme_options
            'blog_id' => '',
        ),


    );

//    return;


    $container = AVA_Fields::make($params);

    $container->add_section('general', array(
        'title' => __('General', ''),
        'icon' => AVA_FIELDS_ICONS_URI . 'gray/general.png',
        'icon_type' => 'image',

        'fields' => array(

            // Text
            'text1' => array(
                'type' => 'text',
                'texts' => array(
                    'title' => __('Title', '{domain}'),
                    'subtitle' => __('Subtitle', '{domain}'),
                    'desc' => __('Description', '{domain}'),
                    'tip' => __('Help tip', '{domain}'),
                    'before' => __('Text left', '{domain}'),
                    'after' => __('Text right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'data-foo' => 'bar'
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => 'default value',
            ),

            // Textarea
            'textarea' => array(
                'type' => 'textarea',
                'texts' => array(
                    'title' => __('Textarea', '{domain}'),
                    'subtitle' => __('Textarea subtitle', '{domain}'),
                    'desc' => __('Textarea description', '{domain}'),
                    'tip' => __('Textarea tip', '{domain}'),
                    'before' => __('TA left', '{domain}'),
                    'after' => __('TA right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'cols' => '60',
                    'rows' => 5
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => '',
            ),


        )
    ));

    $container->add_section('styling', array(
        'title' => __('Styling', ''),
        'icon' => AVA_FIELDS_ICONS_URI . 'gray/styling.png',
        'icon_type' => 'image',

        'fields' => array(



            // Text
            'text2' => array(
                'type' => 'text',
                'texts' => array(
                    'title' => __('Title 2', '{domain}'),
                    'subtitle' => __('Subtitle', '{domain}'),
                    'desc' => __('Description', '{domain}'),
                    'tip' => __('Help tip', '{domain}'),
                    'before' => __('Text left', '{domain}'),
                    'after' => __('Text right', '{domain}'),
                ),
                'attrs' => array(
                    'class' => 'custom-class',
                    'data-foo' => 'bar'
                ),
                'validate' => array(
                    'cond' => '', // not_empty
                    'regexp' => '', // regular expression
                    'message' => __('Field is mandatory', '')
                ),
                'value' => 'default value2',
            ),

        )
    ));

*/


}
//} );

/*
wp_send_json(array(
		'ssdsd'=> ava_fields()
));
exit;
*/


/*
$avaf= array(
		'general' => array(
				'text1' => 'text1 val',
				'textarea' => 'textare val',
		)
);

update_option('avaf', $avaf);
*/


//dump($avaf);
//dump(AVA_Fields::$containers);

//});

add_action( '1shutdown', function () {
	global $wp_actions;
	
	dump( $wp_actions );
} );