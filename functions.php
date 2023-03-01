<?php
define( 'TEMPLATE_PATH', __DIR__ );
define( 'LEAN_LOAN_NEWS_THEME_VERSION', '1.0' );
load_theme_textdomain( 'ln', get_parent_theme_file_path( '/languages' ) );

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

include_once get_parent_theme_file_path( '/core/helpers.php' );
include_once get_parent_theme_file_path( '/core/functions.php' );
include_once get_parent_theme_file_path( '/core/index.php' );
include_once get_parent_theme_file_path( '/blocks/index.php' );


add_action( 'after_setup_theme', 'ln_theme_setup' );
add_action( 'wp_enqueue_scripts', 'ln_enqueue_scripts' );
add_action( 'admin_print_styles', 'ln_admin_enqueue_scripts' );
add_action( 'wp_footer', 'ln_deregister_scripts' );
add_action('wp_ajax_load_more', 'ln_load_more');
add_action('wp_ajax_nopriv_load_more', 'ln_load_more');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter( 'emoji_svg_url', '__return_false' );


function ln_enqueue_scripts() {
	wp_enqueue_style(
		'theme-fonts',
		'https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500,700,900&display=swap&subset=cyrillic',
		null
	);
	wp_enqueue_style(
		'theme-styles',
		get_parent_theme_file_uri() . '/assets/style.css ',
		null,
		LEAN_LOAN_NEWS_THEME_VERSION,
		''
	);
//	wp_enqueue_style( 'wp-block-library', );
	wp_enqueue_script(
		'theme-scripts',
		get_parent_theme_file_uri() . '/assets/scripts.js',
		null,
		LEAN_LOAN_NEWS_THEME_VERSION,
		true
	);
	wp_add_inline_style( 'theme-styles', ln_generate_dynamic_css() );
	wp_localize_script( 'theme-scripts', 'ln_js_settings', ln_get_js_settings() );
}

function ln_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-color-palette', ln_get_editor_colors() );
	add_theme_support( 'editor-font-sizes', ln_get_editor_font_sizes() );

	$image_sizes = ln_get_image_sizes();
	if ( ! empty( $image_sizes ) ) {
		foreach ( $image_sizes as $id => $size ) {
			add_image_size( $id, $size['w'], $size['h'], $size['crop'] );
		}
	}

	if ( is_admin() ) {
		add_editor_style( get_parent_theme_file_uri( '/assets/css/editor-style.css' ) );
	}
}


function ln_deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}

function ln_admin_enqueue_scripts()
{
	echo '
		<style>   
		.interface-interface-skeleton__body {
		    max-width: 100vw;
		}
		</style>
	';
}

function ln_load_more()
{
	preg_match('#/(\d+)/#', $_POST['request'], $matches);
	$page_num = (int) $matches[1];
	$posts_per_page = 5;
	$query = new WP_Query([
		'post_type' => 'post',
		'posts_per_page' => $posts_per_page,
		'paged' => $page_num

	]);
	if ($query->have_posts()) {
		ob_start();
		echo '<div class="row">';
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<div class="col-lg-4 col-md-6 col-sm-12">';
			get_template_part( 'template-parts/post/content', '', ['i' => 1] );
			echo '</div>';
		}
		echo '</div>';
		get_pagination([
			'posts_per_page' => $posts_per_page,
			'max_num_pages' => $query->max_num_pages,
			'page' => $page_num,
		]);
		$html = ob_get_clean();
		die( $html );
	}
	die('no');
}

//add_action('pre_get_posts','category_per_page');
//function category_per_page($query) {
//	if ( is_category() && $query->is_main_query() )   {
//		$query->set('posts_per_page', 2);
//	}
//}
