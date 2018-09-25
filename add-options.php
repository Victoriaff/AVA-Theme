<?php



/*****************************************************
 *              Settings
 *****************************************************/
add_action( 'admin_init', 'register_my_setting' );

function register_my_setting() {
	
	register_setting( 'general', '_my_general'
		/*,
		array(
			'type'              => 'string',
			'group'             => 'my_option_group',
			'description'       => '',
			'sanitize_callback' => null,
			'show_in_rest'      => false,
		)*/
	);
	/*
	register_setting( 'general', '_my_text2', array(
		'group' => '_my_option_group'
	));
	*/
	/*,
	array(
		'type'              => 'string',
		'group'             => 'my_option_group',
		'description'       => '',
		'sanitize_callback' => null,
		'show_in_rest'      => false,
	)*/
	
	
	add_settings_section( '_my_section', 'Settings section', '_my_section_callback', 'general' );
	
	
	add_settings_field( '_my_text1', 'Title 1', '_text1_callback', 'general', '_my_section' );
	
	add_settings_field( '_my_text2', 'Title 2', '_text2_callback', 'general', '_my_section' );
	
	
	//settings_fields( 'my_option_group' );
	
	
	/*
	add_settings_section(
		'eg_setting_section',
		__( 'Example settings section in reading', 'textdomain' ),
		'wpdocs_setting_section_callback_function',
		'reading'
	);
	
	function wpdocs_setting_section_callback_function( $args ) {
		// echo section intro text here
		echo '<p>id: ' . esc_html( $args['id'] ) . '</p>';                         // id: eg_setting_section
		echo '<p>title: ' . apply_filters( 'the_title', $args['title'] ) . '</p>'; // title: Example settings section in reading
		echo '<p>callback: ' . esc_html( $args['callback'] ) . '</p>';             // callback: eg_setting_section_callback_function
	}
	*/
	
	
	
	

	


}

function _my_section_callback() {
	echo 'My section My section My section My section My section My section My section My section My section ';
}


function _text1_callback() {
	$val = get_option('_my_general');
	$val = $val ? $val['_my_text1'] : null;
	
	echo '<input type="text" name="_my_general[_my_text1]" value="'.esc_attr( $val ).'">';
}

function _text2_callback() {
	$val = get_option('_my_general');
	$val = $val ? $val['_my_text2'] : null;
	
	echo '<input type="text" name="_my_general[_my_text2]" value="'.esc_attr( $val ).'">';
}




/*
	 * Plugin name: Primer
	 * Description: Демонстрация создания страницы настроек для плагина
	*/

/**
 * Создаем страницу настроек плагина
 */
add_action('admin_menu', 'add_plugin_page');

function add_plugin_page(){
	add_options_page( 'Настройки Primer', 'Primer', 'manage_options', 'primer_slug', 'primer_options_page_output' );
}

function primer_options_page_output(){
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>
		
		<form action="options.php" method="POST">
			<?php
			settings_fields( 'option_group' );     // скрытые защитные поля
			do_settings_sections( 'primer_page' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Регистрируем настройки.
 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
 */
add_action('admin_init', 'plugin_settings');

function plugin_settings(){
	// параметры: $option_group, $option_name, $sanitize_callback
	register_setting( 'option_group', '_my_option_name', 'sanitize_callback' );
	
	// параметры: $id, $title, $callback, $page
	add_settings_section( 'section_id', 'Основные настройки', '', 'primer_page' );
	
	// параметры: $id, $title, $callback, $page, $section, $args
	add_settings_field('primer_field1', 'Название опции', 'fill_primer_field1', 'primer_page', 'section_id' );
	add_settings_field('primer_field2', 'Другая опция', 'fill_primer_field2', 'primer_page', 'section_id' );
}

## Заполняем опцию 1
function fill_primer_field1(){
	$val = get_option('_my_option_name');
	$val = $val ? $val['input'] : null;
	?>
	<input type="text" name="_my_option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
	<?php
}

## Заполняем опцию 2
function fill_primer_field2(){
	$val = get_option('_my_option_name');
	$val = $val ? $val['checkbox'] : null;
	?>
	<label><input type="checkbox" name="_my_option_name[checkbox]" value="1" <?php checked( 1, $val ) ?> /> отметить</label>
	<?php
}

## Очистка данных
function sanitize_callback( $options ){
	// очищаем
	foreach( $options as $name => & $val ){
		if( $name == 'input' )
			$val = strip_tags( $val );
		
		if( $name == 'checkbox' )
			$val = intval( $val );
	}
	
	//die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )
	
	return $options;
}