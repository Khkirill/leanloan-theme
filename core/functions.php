<?php

function get_recent_post() {
	$params = [
		'posts_per_page'      => 5,
		'offset'           => 0,
		'category'         => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true,
	];
	$query  = new WP_Query( $params );
	$i = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
        <div class="<?php if($i === 0): ?>col-lg-8 col-md-12<?php else: ?>col-lg-4 col-md-6<?php endif; ?> col-sm-12">
			<?php get_template_part( 'template-parts/post/content', '', ['i' => $i] ); ?>
        </div>
	<?php $i++; }
	wp_reset_postdata();
}
