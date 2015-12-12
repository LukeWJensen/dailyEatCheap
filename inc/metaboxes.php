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

// Days Valid Metabox
$meta_boxes[] = array(
	'id'         => 'deal_days',
	'title'      => 'Day(s) Valid',
	'post_types' => array( 'eat' ),
	'context'    => 'normal',
	'priority'   => 'high',
	'fields'     => array(
		array(
			'type'  => 'checkbox',
			'name'  => 'Every Day',
			'id'    => $prefix . 'deal_day_every'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Monday',
			'id'    => $prefix . 'deal_day_mon'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Tuesday',
			'id'    => $prefix . 'deal_day_tue'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Wednesday',
			'id'    => $prefix . 'deal_day_wed'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Thursday',
			'id'    => $prefix . 'deal_day_thu'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Friday',
			'id'    => $prefix . 'deal_day_fri'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Saturday',
			'id'    => $prefix . 'deal_day_sat'
		),
		array(
			'type'  => 'checkbox',
			'name'  => 'Sunday',
			'id'    => $prefix . 'deal_day_sun'
		),
	)
);

// Deal Info Metabox
	$meta_boxes[] = array(
		'id'         => 'deal_info',
		'title'      => 'Deal Info',
		'post_types' => array( 'eat' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
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

	/**
	 * Add the terms from the "days_valid" taxonomy to REST API responses for posts read and write
	 */
	add_action( 'rest_api_init', 'dec_register_days_valid_terms' );
	function dec_register_days_valid_terms() {
		register_api_field( 'eat',
			'days_valid',
			array(
				'get_callback'    => 'dec_get_days_valid_terms',
				'update_callback' => 'dec_update_days_valid_terms',
				'schema'          => null,
			)
		);
	}
	function dec_get_days_valid_terms( $object, $taxonomies, $request ) {
		return wp_get_object_terms( $object[ 'id' ], $taxonomies );
	}

	function dec_update_days_valid_terms( $value, $object) {

		$termIDs = json_decode('[' . $value . ']', true);

		return wp_set_object_terms( $object->ID, $termIDs, 'days_valid', true );

	}

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