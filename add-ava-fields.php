<?php
############## AVA Fields #########################

add_action( 'ava-fields/init', function () {

	$params = array(

		'container' => array(
			'type'     => 'custom',
			'id'       => 'avaf_options',
			'title'    => __( 'Container title', '' ),
			'subtitle' => __( 'Container subtitle', '' ),
		),

		'menu' => array(
			'parent'     => 'post-type', // options, theme, plugins, users, dashboard, posts, media
			'post_type'  => 'faq',
			'menu_title' => __('AVA CPT', '{domain}'),
			'menu_slug'  => 'avaf_custom_posttype',
		),

		'options' => array(
			'option_name' => 'avaf_options'
		),

		'access' => array(
			array(
				// User
				/*
				array(
					'type' => 'user_capability',
					'rule' => '', // equal, except, match, not_match, contains,
					'value' => 'manage_options'
				),
				*/
				array(
					'type' => 'current_user_id',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'current_user_role',
					'rule' => '', // equal, except
					'value' => 'administrator'
				),

				// Posts
				array(
					'type' => 'post_id',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_type',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_template',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_status',
					'rule' => '', // equal, except
					'value' => '{post_status}'
				),
				array(
					'type' => 'post_format',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_category',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_term',
					'rule' => '', // equal, except
					'value' => ''
				),

				// Pages
				array(
					'type' => 'page_id',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'page_parent_id',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'page_type',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'page_template',
					'rule' => '', // equal, except
					'value' => '{post_status}'
				),


				array(
					'type' => 'post_format',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_category',
					'rule' => '', // equal, except
					'value' => ''
				),
				array(
					'type' => 'post_term',
					'rule' => '', // equal, except
					'value' => ''
				),


			),
			//'post_level'       => '',
			//'post_ancestor_id' => '',

			// term_meta
			'term'             => '',
			'term_parent'      => '',
			'term_level'       => '',
			'term_ancestor'    => '',
			'term_taxonomy'    => '',

			// theme_options
			'blog_id'          => '',

			// Taxonomy
			// Attachment
			// Comment
			// Widget
			// Menu
			// Menu Item
		),

		'settinigs' => array(
			//'nav_style' => 'horizontal', // horizontal | vertical
			'style' => '',
			'position' => '',
		),


	);

	$container = AVA_Fields()->make( $params );

	$container->add_section( 'general', array(
		'title'     => __( 'General', '' ),
		'icon'      => AVA_Fields()->url('icons') . '/gray/general.png',
		'icon_type' => 'image',

		'fields' => array(

			// Text
			'text1'     => array(
				'type'     => 'text',
				'texts'    => array(
					'title'    => __( 'Title', '{domain}' ),
					'subtitle' => __( 'Subtitle', '{domain}' ),
					'desc'     => __( 'Description', '{domain}' ),
					'tip'      => __( 'Help tip', '{domain}' ),
					'before'   => __( 'Text left', '{domain}' ),
					'after'    => __( 'Text right', '{domain}' ),

				),
				'location' => array(
				),


				'attrs'    => array(
					'class'    => 'custom-class',
					'data-foo' => 'bar',
					'placeholder' => __( 'Placeholder', '{domain}' ),
					'maxlength' => 10
				),

				'validation' => array(
					'required' => true,
					'condition'    => '', // not_empty
					'regexp'  => '', // regular expression
					'message' => __( 'Field is mandatory', '' )
				),
				'conditions' => array(
					array(
						array(
							'field' => '',
							'rule' => '', // not_empty, empty, equal, not_equal, match, not_match, contains,
							'value' => ''
						),
						array(
							'field' => '',
							'rule' => '', // not_empty, empty, equal, not_equal, match, not_match, contains,
							'value' => ''
						),
					),
					// OR
					array(
						array(
							'field' => '',
							'rule' => '', // not_empty, empty, equal, not_equal, match, not_match, contains,
							'value' => ''
						),
						array(
							'field' => '',
							'rule' => '', // not_empty, empty, equal, not_equal, match, not_match, contains,
							'value' => ''
						),
					),

				),
				'value'    => 'default value',
			),

			// Textarea
			'textarea1' => array(
				'type'     => 'textarea',
				'texts'    => array(
					'title'    => __( 'Textarea', '{domain}' ),
					'subtitle' => __( 'Textarea subtitle', '{domain}' ),
					'desc'     => __( 'Textarea description', '{domain}' ),
					'tip'      => __( 'Textarea tip', '{domain}' ),
					'before'   => __( 'TA left', '{domain}' ),
					'after'    => __( 'TA right', '{domain}' ),
				),
				'attrs'    => array(
					'class' => 'custom-class',
					'cols'  => '60',
					'rows'  => 5
				),
				'validate' => array(
					'cond'    => '', // not_empty
					'regexp'  => '', // regular expression
					'message' => __( 'Field is mandatory', '' )
				),
				'value'    => '',
			),

			// Checkbox
			'checkbox1' => array(
				'type'     => 'checkbox',
				'texts'    => array(
					'title'    => __( 'Checkbox', '{domain}' ),
					'subtitle' => __( 'Checkbox subtitle', '{domain}' ),
					'label'    => __( 'Label text', '{domain}' ),
					/*
					'desc'     => __( 'Checkbox description', '{domain}' ),
					'tip'      => __( 'Checkbox tip', '{domain}' ),
					'before'   => __( 'CB left', '{domain}' ),
					'after'    => __( 'CB right', '{domain}' ),
					*/
				),
				'attrs'    => array(
				),
				'validate' => array(
					'cond'    => '', // not_empty
					'message' => __( 'Field is mandatory', '' )
				),
				'value'    => 'yes',
				'default'  => 'yes'
			),

			// Radio
			'radio1' => array(
				'type'     => 'radio',
				'texts'    => array(
					'title'    => __( 'Radio', '{domain}' ),
					'subtitle' => __( 'Radio subtitle', '{domain}' ),
					/*
					'desc'     => __( 'Checkbox description', '{domain}' ),
					'tip'      => __( 'Checkbox tip', '{domain}' ),
					'before'   => __( 'CB left', '{domain}' ),
					'after'    => __( 'CB right', '{domain}' ),
					*/
				),
				'options'    => array(
					'mike'  => 'Mike',
					'nik'  => 'Nik',
					'##viktor'  => 'Viktor',
				),
				'attrs'    => array(
				),
				'validate' => array(
					'cond'    => '', // not_empty
					'message' => __( 'Field is mandatory', '' )
				),
				'value'    => '',
				'default'  => ''
			),

			// Select
			'select1' => array(
				'type'     => 'select',
				'texts'    => array(
					'title'    => __( 'Select', '{domain}' ),
					'subtitle' => __( 'Select subtitle', '{domain}' ),
					/*
					'desc'     => __( 'Select description', '{domain}' ),
					'tip'      => __( 'Select tip', '{domain}' ),
					'before'   => __( 'Select left', '{domain}' ),
					'after'    => __( 'Select right', '{domain}' ),
					*/
				),
				'options'    => array(
					'mike'  => 'Mike',
					'nik'  => 'Nik',
					'viktor'  => 'Viktor',
				),
				'attrs'    => array(
				),
				'validate' => array(
					'required' => false,
					'cond'    => '', // not_empty
					'message' => __( 'Field is mandatory', '' )
				),
				'value'    => '',
				'default'  => ''
			),


		)
	) );

	$container->add_section( 'styling', array(
		'title'     => __( 'Styling', '' ),
		'icon'      => AVA_Fields()->url('icons') . '/gray/styling.png',
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
				'type'     => 'text',
				'texts'    => array(
					'title'    => __( 'Title 2', '{domain}' ),
					'subtitle' => __( 'Subtitle', '{domain}' ),
					'desc'     => __( 'Description', '{domain}' ),
					'tip'      => __( 'Help tip', '{domain}' ),
					'before'   => __( 'Text left', '{domain}' ),
					'after'    => __( 'Text right', '{domain}' ),
				),
				'attrs'    => array(
					'class'    => 'custom-class',
					'data-foo' => 'bar'
				),
				'validate' => array(
					'cond'    => '', // not_empty
					'regexp'  => '', // regular expression
					'message' => __( 'Field is mandatory', '' )
				),
				'value'    => 'default value2',
			),

		)
	) );
} );



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
        'icon' => AVA_Fields()->url('icons') . '/gray/general.png',
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
        'icon' => AVA_Fields()->url('icons') . '/gray/styling.png',
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
