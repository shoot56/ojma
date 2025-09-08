<?php 
function ojma_scripts() {
	
	// all style
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'), false );

	// JS
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/jquery.main.js', array('jquery', 'aos'), filemtime(get_template_directory() . '/js/jquery.main.js'), true );
}
add_action( 'wp_enqueue_scripts', 'ojma_scripts' );