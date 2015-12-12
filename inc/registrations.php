<?php
//REGISTER CUSTOM POST TYPES
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
		'rest_controller_class' => 'WP_REST_Posts_Controller',
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

//REGISTER CUSTOM TAXONOMIES
function dec_taxonomies() {
	
	//days valid
	$labels = array(
		'name'              => _x( 'Days Valid', 'taxonomy general name' ),
		'singular_name'     => _x( 'Days Valid', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Days Valid' ),
		'all_items'         => __( 'All Days Valid' ),
		'parent_item'       => __( 'Parent Days Valid' ),
		'parent_item_colon' => __( 'Parent Days Valid:' ),
		'edit_item'         => __( 'Edit Days Valid' ),
		'update_item'       => __( 'Update Days Valid' ),
		'add_new_item'      => __( 'Add New Days Valid' ),
		'new_item_name'     => __( 'New Days Valid Name' ),
		'menu_name'         => __( 'Days Valid' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'       => true,
		'rest_base'          => 'days-valid',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'days_valid' )
	);
	register_taxonomy( 'days_valid', array( 'eat' ), $args );
}
add_action( 'init', 'dec_taxonomies', 25 );