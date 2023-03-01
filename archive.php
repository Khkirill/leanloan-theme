<?php get_header(); ?>
<?php if ( have_posts() ): ?>
    <div class="container">
        <div class="row justify-content-between">
            <div class="post-single__content">
                <div class="row">
                    <?php while ( have_posts() ): the_post(); ?>
                        <div class="col-md-6">
                            <?php get_template_part( 'template-parts/post/content' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?=  get_the_posts_pagination(); ?>
            </div>
            <?php get_sidebar() ?>
        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
