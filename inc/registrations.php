<?php
function dec_post_types() {

	//eats
	$labels = array(
		'name'               => 'Eats',
		'singular_name'      => 'Eat',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Eat',
		'edit_item'          => 'Edit Eat',
		'new_item'           => 'New Eat',
		'all_items'          => 'All Eats',
		'view_item'          => 'View Eat',
		'search_items'       => 'Search Eats',
		'not_found'          => 'No Eats found',
		'not_found_in_trash' => 'No Eats found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Eats'
	);
	$args = array(
		'labels'             => $labels,
		'menu_icon'          => 'dashicons-smiley',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'rest_base'          => 'Eats',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'eats' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'author', 'thumbnail', 'comments', 'custom-fields' )
	);
	register_post_type( 'eat', $args );
}
add_action( 'init', 'dec_post_types' );

//ADD CUSTOM POST TYPES TO JSON API
function dec_add_cpt_to_json_api(){

	global $wp_post_types;
	$wp_post_types['deal']->rest_controller_class = 'WP_REST_Posts_Controller';
}
add_action( 'init', 'dec_add_cpt_to_json_api' );