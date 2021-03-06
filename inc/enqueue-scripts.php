<?php
function dec_scripts() {

//enqueue stylesheet
	wp_enqueue_style( 'dec-styles', get_stylesheet_uri() );

//register angular and additional modules
	wp_register_script( 'lodash', get_stylesheet_directory_uri() . '/bower_components/lodash/lodash.js' );
	wp_register_script( 'classie', get_stylesheet_directory_uri() . '/bower_components/classie/classie.js' );
	wp_register_script( 'angular', get_stylesheet_directory_uri() . '/bower_components/angular/angular.js' );
	wp_register_script( 'angular-simple-logger', get_stylesheet_directory_uri() . '/bower_components/angular-simple-logger/dist/angular-simple-logger.js' );
	wp_register_script( 'angular-ui-router', get_stylesheet_directory_uri() . '/bower_components/angular-ui-router/release/angular-ui-router.js' );
	wp_register_script( 'angular-resource', get_stylesheet_directory_uri() . '/bower_components/angular-resource/angular-resource.js' );
	wp_register_script( 'angular-sanitize', get_stylesheet_directory_uri() . '/bower_components/angular-sanitize/angular-sanitize.js' );
	wp_register_script( 'angular-touch', get_stylesheet_directory_uri() . '/bower_components/angular-touch/angular-touch.js' );
	wp_register_script( 'angular-animate', get_stylesheet_directory_uri() . '/bower_components/angular-animate/angular-animate.js' );
	wp_register_script( 'oauth-signature', get_stylesheet_directory_uri() . '/bower_components/oauth-signature/dist/oauth-signature.js' );
	wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?sensor=false' );
	wp_register_script( 'angular-google-maps', get_stylesheet_directory_uri() . '/bower_components/angular-google-maps/dist/angular-google-maps.js' );

	$depends = array(
		'lodash',
		'classie',
		'angular',
		'angular-simple-logger',
		'angular-ui-router',
		'angular-resource',
		'angular-sanitize',
		'angular-touch',
		'angular-animate',
		'oauth-signature',
		'google-maps-api',
		'angular-google-maps'
	);

//main app file
	wp_enqueue_script( 'dec-scripts', get_stylesheet_directory_uri() . '/app/scripts/app.js', $depends );

//controllers
	wp_enqueue_script( 'dec-ctrl-main', get_stylesheet_directory_uri() . '/app/scripts/controllers/mainCtrl.js', $depends );
	wp_enqueue_script( 'dec-ctrl-eat', get_stylesheet_directory_uri() . '/app/scripts/controllers/eatCtrl.js', $depends );
	wp_enqueue_script( 'dec-ctrl-submit-deal', get_stylesheet_directory_uri() . '/app/scripts/controllers/submitEatCtrl.js', $depends );

//service factories
	wp_enqueue_script( 'dec-wp-service', get_stylesheet_directory_uri() . '/app/scripts/wpService.js', $depends );
	wp_enqueue_script( 'dec-yelp-service', get_stylesheet_directory_uri() . '/app/scripts/yelpService.js', $depends );
	wp_enqueue_script( 'dec-submit-eat-service', get_stylesheet_directory_uri() . '/app/scripts/submitEatService.js', $depends );
	wp_enqueue_script( 'dec-existing-eat-service', get_stylesheet_directory_uri() . '/app/scripts/existingEatsService.js', $depends );
	wp_enqueue_script( 'dec-eat-data-service', get_stylesheet_directory_uri() . '/app/scripts/eatDataService.js', $depends );

//directives
	wp_enqueue_script( 'dec-directives', get_stylesheet_directory_uri() . '/app/scripts/directives.js', $depends );

//localize urls for use in JS files
	wp_localize_script(
		'dec-scripts',
		'decLocalized',
		array(
			'nonce'       => wp_create_nonce( 'wp_rest' ),
			'views'       => get_template_directory_uri() . '/app/views/',
			'scripts'     => get_template_directory_uri() . '/app/scripts/',
			'controllers' => get_template_directory_uri() . '/app/scripts/controllers/',
			'images'      => get_template_directory_uri() . '/app/images/',
			'yelpOauthConsumerKey' => 'uMiv_Cl7_VFlzD7Yvx4Sug',
			'yelpConsumerSecret' => 'DXKaD0lYWDyC3A3eE5pb3sr5w_w',
			'yelpOauthToken' => 'c8c3ANwhWcg8UErIx_wLwn03tnMiykoy',
			'yelpTokenSecret' => 'kTw7R9S7WnKv9IGKreIQNMfcbhs'
		)
	);

}

add_action( 'wp_enqueue_scripts', 'dec_scripts' );