<?php

$this->sections['social'] = array(
	'title'     => __( 'Social Links', 'wmp-theme' ),
	'desc'      => esc_html__('Add link to your social media profiles. Icons with link will be display in header or footer.', 'ava-theme'),
	'icon'      => 'el-icon-share-alt',
	'icon_class'=> 'icon-large',
	'fields' => array(
		array(
			'id'        => 'social-enabled',
			'type'      => 'checkbox',
			'title'     => esc_html__('Social icons', 'ava-theme'),
			'desc'      => esc_html__('Enable social icons.', 'ava-theme'),
			'default'   => '1',
			'class'		=> 'icheck',
		),
		
		array(
			'id'        => 'social-facebook',
			'type'      => 'text',
			'title'     => esc_html__('Facebook', 'ava-theme'),
			'validate'  => 'url',
			'default'   => '',
			'hint'=> array('title', 'content')
		),
		array(
			'id'        => 'social-twitter',
			'type'      => 'text',
			'title'     => esc_html__('Twitter', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-instagram',
			'type'      => 'text',
			'title'     => esc_html__('Instagram', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-pinterest',
			'type'      => 'text',
			'title'     => esc_html__('Pinterest', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-linkedin',
			'type'      => 'text',
			'title'     => esc_html__('LinkedIn', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-gplus',
			'type'      => 'text',
			'title'     => esc_html__('Google Plus+', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-dribbble',
			'type'      => 'text',
			'title'     => esc_html__('Dribbble', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-flickr',
			'type'      => 'text',
			'title'     => esc_html__('Flickr', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-youtube',
			'type'      => 'text',
			'title'     => esc_html__('You Tube', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-delicious',
			'type'      => 'text',
			'title'     => esc_html__('Delicious', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-deviantart',
			'type'      => 'text',
			'title'     => esc_html__('Deviantart', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-rss',
			'type'      => 'text',
			'title'     => esc_html__('RSS', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		
		array(
			'id'        => 'social-vimeo',
			'type'      => 'text',
			'title'     => esc_html__('Vimeo', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-tumblr',
			'type'      => 'text',
			'title'     => esc_html__('Tumblr', 'ava-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		/*
		array(
			'id'        => 'email',
			'type'      => 'text',
			'title'     => esc_html__('E-mail', 'ava-theme'),
			'validate'  => 'email',
			'msg'       => 'custom error message',
			'default'   => ''
		),
		*/
		array(
			'id'        => 'social-skype',
			'type'      => 'text',
			'title'     => esc_html__('Skype', 'ava-theme'),
			'default'   => ''
		)
	)
);
