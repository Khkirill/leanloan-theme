<?php $related = ln_get_related_posts(); ?>

<?php if (!empty($related)): ?>

    <?php if ($related->have_posts()): ?>

        <div class="related-post">
            <p class="title">
                Вам также может понравится
            </p>
            <div class="row">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php get_template_part( 'template-parts/post/content', '', [ 'i' => 0 ] ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>


    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>
