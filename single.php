<?php get_header(); ?>
<div class="container">
    <div class="row justify-content-between">
        <div class="post-single__content">
            <?php if ( have_posts() ): ?>
                <?php while ( have_posts() ): the_post(); ?>
                    <article id="post-<?php the_ID() ?>" class="post-single">
                        <div class="post-single__inner">
                            <?php get_template_part('template-parts/single/entry-header'); ?>
                            <?php get_template_part('template-parts/entry-author-bio'); ?>
                            <?php the_content(); ?>
                            <?php get_template_part('template-parts/prev-next') ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php //get_template_part('template-parts/related') ?>
        </div>
        <?php get_sidebar() ?>
    </div>
</div>

<?php get_footer(); ?>
