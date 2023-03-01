<?php get_header(); ?>
<?php if ( have_posts() ): ?>
    <?php while ( have_posts() ): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php if ( ln_current_page() === 1 ): ?>
    <section class="section">
        <div class="container">
            <h2 class="title section__title">Отобранные записи</h2>
            <div class="row justify-content-between">
                <?php get_recent_post(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="container">
    <h2 class="title section__title">Последнии записи</h2>
    <div id="paged-post">
        <div class="row justify-content-between">
            <?php
            $posts_per_page = 5;
            $args           = [
                'paged'          => ln_current_page(),
                'posts_per_page' => $posts_per_page,
                'post_type'      => 'post',
            ];
            $query          = new WP_Query( $args );
            while ( $query->have_posts() ) : $query->the_post();
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <?php get_template_part( 'template-parts/post/content', '', [ 'i' => 1 ] ); ?>
                </div>
            <?php
            endwhile;;
            wp_reset_postdata(); ?>
        </div>
        <?php
        get_pagination( [
            'posts_per_page' => $posts_per_page,
            'max_num_pages'  => $query->max_num_pages,
            'page'           => get_query_var( 'page' ) ? (int) get_query_var( 'page' ) : 1,
        ] );
        ?>
    </div>
</div>
<?php get_footer(); ?>
