<?php
require __DIR__ . '/admin.php';
require __DIR__ . '/sidebar.php';

spl_autoload_register(function($class_name) {
	$file_name = __DIR__ . "/classes/{$class_name}.php";
	if (file_exists($file_name)) require $file_name;
});

function ln_widgets_load() {
	register_widget( 'LnCategoryWidget' );
	register_widget( 'Ln_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'ln_widgets_load' );
