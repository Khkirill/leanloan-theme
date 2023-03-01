<?php

function ln_sidebar() {
	register_sidebar(
		array (
			'name' => __( 'Ln_sidebar', 'ln' ),
			'id' => 'ln-sidebar',
			'description' => __( 'Сайдбар темы', 'ln' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<p class="widget-title">',
			'after_title' => '</p>',
		)
	);
}
add_action( 'widgets_init', 'ln_sidebar' );
