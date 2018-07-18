<?php

function eh_allow_programmatic_login( $user, $username, $password ) {
	return get_user_by( 'login', $username );
}

/**
 * Get posts using AJAX
 **/
add_action('wp_ajax_load_more_posts', 'eh_ajax_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'eh_ajax_load_more_posts');

function eh_ajax_load_more_posts() {

	$data = $_POST;

	if ($data['nonce'] == wp_create_nonce( 'eh-ajax-posts' )) die;

	$current_page = absint( $data['nextPage'] );
	$next_page = $current_page + 1;

	$response = array(
	  'current_page' => $current_page,
	  'next_page' => $next_page,
	  'html' => ''
	);

	$q_array = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		//'posts_per_page' => absint( get_option('posts_per_page') ),
		'posts_per_page' => absint( get_option('posts_per_page') ),
		'paged' => $current_page
	);
	$items = new WP_Query( $q_array );

	if( $items->max_num_pages < $next_page ) {
	  $response['hide_link'] = true;
	}

	if( $items->have_posts() ) {
		
		$i = absint( $data['lastNumber'] ); 
		$response['html'] = '';
		while( $items->have_posts() ) { 
			$items->the_post(); 
			$second_style = $i%2 == 0; 
			$response['html'] .= apply_filters('theme_get_template', 'content', $data, get_template_directory().'/template-parts/post/');
			//$response['html'] .= apply_filters('theme_get_template', get_post_format, $data, get_template_directory().'/template-parts/post/');

			$i++;
			$response['last_num'] = $i;

			if (!empty($noop)) wp_link_pages( $args );
		}
	}

	wp_send_json($response);

	// You can use wp_send_json_error() or wp_send_json_success() - to send status
}
