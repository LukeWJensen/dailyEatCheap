<?php
function dec_register_meta_boxes( $meta_boxes ) {
	$prefix = 'rw_';

// Yelp Data Metabox
	$meta_boxes[] = array(
		'title'      => 'Yelp Data',
		'post_types' => 'eat',
		'fields'     => array(
			array(
				'name' => 'Restaurant ID',
				'id'   => $prefix . 'yelp_id',
				'type' => 'text',
				'size' => 50
			),
		)
	);

// Deals Info Metabox
	$meta_boxes[] = array(
		'id'         => 'deal_info',
		'title'      => 'Deal Info',
		'post_types' => array( 'eat' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'type'  => 'checkbox_list',
				'name'  => 'Day(s) Valid',
				'desc'  => 'The day or days during which the deal applies',
				'id'    => $prefix . 'deal_days',
				'options' => array(
					'everyday' => 'Every Day',
					'mon' => 'Monday',
					'tue' => 'Tuesday',
					'wed' => 'Wednesday',
					'thu' => 'Thursday',
					'fri' => 'Friday',
					'sat' => 'Saturday',
					'sun' => 'Sunday'
				)
			),
			array(
				'name'  => 'Deal Description',
				'desc'  => 'What\'s the deal with this deal??',
				'id'    => $prefix . 'deal_desc',
				'type'  => 'textarea',
				'clone' => false,
			),
			array(
				'name'  => 'Terms & Conditions',
				'desc'  => 'There\'s no such thing as a free lunch.',
				'id'    => $prefix . 'deal_terms',
				'type'  => 'textarea',
				'clone' => false
			)
		)
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'dec_register_meta_boxes' );


//EXPOSE META FIELDS IN THE WP REST API

	///// Yelp restaurant ID /////
	/**
	 * Add the field "rw_deal_days" to REST API responses for posts read and write
	 */
	add_action( 'rest_api_init', 'dec_register_yelp_id' );
	function dec_register_yelp_id() {
		register_api_field( 'eat',
			'rw_yelp_id',
			array(
				'get_callback'    => 'dec_get_yelp_id',
				'update_callback' => 'dec_update_yelp_id',
				'schema'          => null,
			)
		);
	}
	/**
	 * Handler for getting custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param array $object The object from the response
	 * @param string $field_name Name of field
	 * @param WP_REST_Request $request Current request
	 *
	 * @return mixed
	 */
	function dec_get_yelp_id( $object, $field_name, $request ) {
		return get_post_meta( $object[ 'id' ], $field_name );
	}
	/**
	 * Handler for updating custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $value The value of the field
	 * @param object $object The object from the response
	 * @param string $field_name Name of field
	 *
	 * @return bool|int
	 */
	function dec_update_yelp_id( $value, $object, $field_name ) {
		if ( ! $value || ! is_string( $value ) ) {
			return;
		}

		return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	}

	///// deal days /////
	add_action( 'rest_api_init', 'dec_register_deal_days' );
	function dec_register_deal_days() {
		register_api_field( 'eat',
			'rw_deal_days',
			array(
				'get_callback'    => 'dec_get_deal_days',
				'update_callback' => 'dec_update_deal_days',
				'schema'          => null,
			)
		);
	}
	function dec_get_deal_days( $object, $field_name, $request ) {
		return get_post_meta( $object[ 'id' ], $field_name );
	}
	function dec_update_deal_days( $value, $object, $field_name ) {
		if ( ! $value || ! is_string( $value ) ) {
			return;
		}
	
		return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	
	}

	///// deal description /////
	add_action( 'rest_api_init', 'dec_register_deal_desc' );
	function dec_register_deal_desc() {
		register_api_field( 'eat',
			'rw_deal_desc',
			array(
				'get_callback'    => 'dec_get_deal_desc',
				'update_callback' => 'dec_update_deal_desc',
				'schema'          => null,
			)
		);
	}
	function dec_get_deal_desc( $object, $field_name, $request ) {
		return get_post_meta( $object[ 'id' ], $field_name );
	}
	function dec_update_deal_desc( $value, $object, $field_name ) {
		if ( ! $value || ! is_string( $value ) ) {
			return;
		}
	
		return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	}

	///// deal conditions & instructions /////
	add_action( 'rest_api_init', 'dec_register_deal_terms' );
	function dec_register_deal_terms() {
		register_api_field( 'eat',
			'rw_deal_terms',
			array(
				'get_callback'    => 'dec_get_deal_terms',
				'update_callback' => 'dec_update_deal_terms',
				'schema'          => null,
			)
		);
	}
	function dec_get_deal_terms( $object, $field_name, $request ) {
		return get_post_meta( $object[ 'id' ], $field_name );
	}
	function dec_update_deal_terms( $value, $object, $field_name ) {
		if ( ! $value || ! is_string( $value ) ) {
			return;
		}
	
		return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	}