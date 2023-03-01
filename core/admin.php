<?php
require __DIR__ . '/taxonomy-meta.php';

add_action('admin_enqueue_scripts', 'ln_admin_scripts');

function ln_admin_scripts()
{
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script(
		'theme-admin-script',
		get_template_directory_uri() . '/assets/admin-scripts.js',
		['wp-color-picker'],
		false,
		true
	);
}
