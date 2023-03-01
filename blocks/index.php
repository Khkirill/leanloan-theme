<?php

function create_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/gutenpride" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-gutenpride-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		$script_asset['dependencies'],
		$script_asset['version']
	);
	wp_set_script_translations( 'create-block-gutenpride-block-editor', 'gutenpride' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-gutenpride-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		[],
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-gutenpride-block',
		get_template_directory_uri() . "/blocks/$style_css",
		[],
		filemtime( "$dir/$style_css" )
	);

	add_action("wp_enqueue_scripts", function () {
		wp_enqueue_style('create-block-gutenpride-block');
	});

	add_action( 'enqueue_block_editor_assets', function (){
		wp_enqueue_script('create-block-gutenpride-block-editor');
		wp_enqueue_style('create-block-gutenpride-block-editor');
	});

	register_block_type( 'ln-blocks/carousel');
//	register_block_type( 'ln-blocks/gutenpride2');
	register_block_type( 'ln-blocks/container');

//	register_block_type( 'create-block/gutenpride', array(
//		'editor_script' => 'create-block-gutenpride-block-editor',
//		'editor_style'  => 'create-block-gutenpride-block-editor',
//		'style'         => 'create-block-gutenpride-block',
//	) );
}
add_action( 'init', 'create_block_init' );
