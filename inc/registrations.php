<?php
function dec_post_types() {

	//deals
	$labels = array(
		'name'               => 'Deals',
		'singular_name'      => 'Deal',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Deal',
		'edit_item'          => 'Edit Deal',
		'new_item'           => 'New Deal',
		'all_items'          => 'All Deals',
		'view_item'          => 'View Deal',
		'search_items'       => 'Search Deals',
		'not_found'          => 'No Deals found',
		'not_found_in_trash' => 'No Deals found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Deals'
	);
	$args = array(
		'labels'             => $labels,
		'menu_icon'          => 'dashicons-smiley',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'rest_base'          => 'deals',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'deals' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'author', 'thumbnail', 'comments', 'custom-fields' )
	);
	register_post_type( 'deal', $args );
}
add_action( 'init', 'dec_post_types' );

//ADD CUSTOM POST TYPES TO JSON API
function dec_add_cpt_to_json_api(){

	global $wp_post_types;
	$wp_post_types['deal']->rest_controller_class = 'WP_REST_Posts_Controller';
}
add_action( 'init', 'dec_add_cpt_to_json_api' );