<?php
$post_classes = '';
if ( $args['i'] === 0 ) {
	$post_classes = 'post_type_horizontal';
} else {
	$post_classes = 'post_type_vertical';
}
if (has_post_thumbnail()){
	$post_classes .= ' post_has_image';
}
?>
<article <?php post_class( "post $post_classes" ); ?> id="post-<?php the_ID(); ?>">
    <div class="post__image">
		<?php if ( has_post_thumbnail()) { // && $args['i'] === 0
			the_post_thumbnail( 'medium' );
		} ?>
    </div>
    <div class="post__inner">
		<?php get_template_part( 'template-parts/entry-header' ); ?>
        <div class="post__content">
	        <?php the_excerpt(); ?>
        </div>
        <div class="post__meta">
	        <?php get_template_part( 'template-parts/entry-author-bio' ); ?>
            <p style="text-align: right; margin: 0;">
	            <?php edit_post_link(); ?>
            </p>
        </div>
    </div>
</article>
