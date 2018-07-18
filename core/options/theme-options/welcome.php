<?php

if ( !$this->is_options_page() ) return;

$this->sections['Welcome'] = array(
	'title' => __( 'Welcome', 'wpm-theme' ),
	'desc' => __( 'Intense is now installed and ready for you to use.', 'wpm-theme' ),
	'icon' => 'el-icon-home',
	'icon_class' => 'icon-large',
	// Leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
		    'id'       => 'opt-raw',
		    'type'     => 'raw',
		    'title'    => '<div style="font-size:30px; line-height:35px; font-weight:600; margin-bottom:20px;">' . __( 'Welcome to WP Magic Theme', 'wpm-theme' ) . '</div>',
		    'content'  => 'Just content'
		),			
	)
);


