<?php
function dec_scripts() {

//register angular and additional modules
wp_register_script( 'angular', get_stylesheet_directory_uri() . '/bower_components/angular/angular.js');
wp_register_script( 'angular-ui-router', get_stylesheet_directory_uri() . '/bower_components/angular-ui-router/release/angular-ui-router.js' );
wp_register_script( 'angular-resource', get_stylesheet_directory_uri() . '/bower_components/angular-resource/angular-resource.js');
wp_register_script( 'angular-sanitize', get_stylesheet_directory_uri() . '/bower_components/angular-sanitize/angular-sanitize.js');
wp_register_script( 'angular-touch', get_stylesheet_directory_uri() . '/bower_components/angular-touch/angular-touch.js');
wp_register_script( 'angular-animate', get_stylesheet_directory_uri() . '/bower_components/angular-animate/angular-animate.js');

$depends = array( 'angular', 'angular-ui-router', 'angular-resource', 'angular-sanitize', 'angular-touch', 'angular-animate' );

//main app file
wp_enqueue_script( 'dec-scripts', get_stylesheet_directory_uri() . '/app/scripts/app.js', $depends );

//controllers
wp_enqueue_script( 'dec-ctrl-main', get_stylesheet_directory_uri() . '/app/scripts/controllers/main.js', $depends );

//service factories
wp_enqueue_script( 'dec-wp-service', get_stylesheet_directory_uri() . '/app/scripts/wp-service.js', $depends );

//directives
wp_enqueue_script( 'dec-directives', get_stylesheet_directory_uri() . '/app/scripts/directives.js', $depends );

//localize urls for use in JS files
wp_localize_script(
'dec-scripts',
'decLocalized',
array(
'nonce' => wp_create_nonce( 'wp_rest' ),
'views' => get_template_directory_uri() . '/app/views/',
'scripts' => get_template_directory_uri() . '/app/scripts/',
'controllers' => get_template_directory_uri() . '/app/scripts/controllers/',
'images' => get_template_directory_uri() . '/app/images/'
)
);

}

add_action( 'wp_enqueue_scripts', 'dec_scripts' );