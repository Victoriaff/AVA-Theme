<?php

define( 'AVA_THEME_NAME', 'Magic' );
define( 'AVA_THEME_VERSION', '1.0' );

define( 'AVA_THEME_DIR', get_template_directory() );
define( 'AVA_THEME_URL', get_template_directory_uri() );
define( 'AVA_THEME_CORE_DIR', get_template_directory() . '/core' );
define( 'AVA_THEME_VENDOR_DIR', get_template_directory() . '/vendor' );
define( 'AVA_THEME_MODULES_DIR', get_template_directory() . '/modules' );
define( 'AVA_THEME_CACHE_TIME', '100720181000' );
define( 'AVA_THEME_MINIFY', '' );

//dump('AVA_Theme');

require_once AVA_THEME_DIR . '/add-ava-fields.php';

require_once AVA_THEME_CORE_DIR . '/ava-theme.php';





