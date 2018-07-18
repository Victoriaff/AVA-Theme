<?php

$this->sections['social'] = array(
	'title'     => __( 'Social Links', 'wmp-theme' ),
	'desc'      => esc_html__('Add link to your social media profiles. Icons with link will be display in header or footer.', 'wpm-theme'),
	'icon'      => 'el-icon-share-alt',
	'icon_class'=> 'icon-large',
	'fields' => array(
		array(
			'id'        => 'social-enabled',
			'type'      => 'checkbox',
			'title'     => esc_html__('Social icons', 'wpm-theme'),
			'desc'      => esc_html__('Enable social icons.', 'wpm-theme'),
			'default'   => '1',
			'class'		=> 'icheck',
		),
		
		array(
			'id'        => 'social-facebook',
			'type'      => 'text',
			'title'     => esc_html__('Facebook', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => '',
			'hint'=> array('title', 'content')
		),
		array(
			'id'        => 'social-twitter',
			'type'      => 'text',
			'title'     => esc_html__('Twitter', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-instagram',
			'type'      => 'text',
			'title'     => esc_html__('Instagram', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-pinterest',
			'type'      => 'text',
			'title'     => esc_html__('Pinterest', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-linkedin',
			'type'      => 'text',
			'title'     => esc_html__('LinkedIn', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-gplus',
			'type'      => 'text',
			'title'     => esc_html__('Google Plus+', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-dribbble',
			'type'      => 'text',
			'title'     => esc_html__('Dribbble', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-flickr',
			'type'      => 'text',
			'title'     => esc_html__('Flickr', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-youtube',
			'type'      => 'text',
			'title'     => esc_html__('You Tube', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-delicious',
			'type'      => 'text',
			'title'     => esc_html__('Delicious', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-deviantart',
			'type'      => 'text',
			'title'     => esc_html__('Deviantart', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-rss',
			'type'      => 'text',
			'title'     => esc_html__('RSS', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		
		array(
			'id'        => 'social-vimeo',
			'type'      => 'text',
			'title'     => esc_html__('Vimeo', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		array(
			'id'        => 'social-tumblr',
			'type'      => 'text',
			'title'     => esc_html__('Tumblr', 'wpm-theme'),
			'validate'  => 'url',
			'default'   => ''
		),
		/*
		array(
			'id'        => 'email',
			'type'      => 'text',
			'title'     => esc_html__('E-mail', 'wpm-theme'),
			'validate'  => 'email',
			'msg'       => 'custom error message',
			'default'   => ''
		),
		*/
		array(
			'id'        => 'social-skype',
			'type'      => 'text',
			'title'     => esc_html__('Skype', 'wpm-theme'),
			'default'   => ''
		)
	)
);
