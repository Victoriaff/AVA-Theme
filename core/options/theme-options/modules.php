<?php

$this->sections['modules'] = array(
	'title' => __( 'Modules', 'wmp-theme' ),
	'icon' => 'el-icon-wrench',
	'icon_class' => 'icon-large',
	'fields' => array(
		array(
			'id' => 'modules',
			'type' => 'checkbox',
			'title' => __( 'Active Modules', 'wpm-theme' ),
			"subtitle" => wp_kses( __( "Turn <strong>On</strong> or <strong>Off</strong> individual shortcodes. ", "wpm-theme" ), array( 'a' => array( 'href' => array(), 'target' => array() ), 'br' => array(), 'strong' => array() ) ),
			'options' => wpm_theme()->config('modules'),
			'default' => array(				
			)
		),
	)
);
