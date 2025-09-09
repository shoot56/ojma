<?php 
function ojma_scripts() {
	
	// all style
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'), false );

	// JS
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/jquery.main.js', array('jquery', 'aos'), filemtime(get_template_directory() . '/js/jquery.main.js'), true );
}
add_action( 'wp_enqueue_scripts', 'ojma_scripts' );

// Setup admin style
function admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin.css', array(), filemtime(get_template_directory() . '/css/admin.css'), false );
}
add_action('admin_enqueue_scripts', 'admin_style');


// Custom JS for blocks
function mytheme_register_block_styles() {
    wp_enqueue_script(
        'mytheme-block-styles',
        get_stylesheet_directory_uri() . '/js/block-styles.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(get_stylesheet_directory() . '/js/block-styles.js')
    );
}
add_action('enqueue_block_editor_assets', 'mytheme_register_block_styles');