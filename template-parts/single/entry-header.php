<header class="post__header">
    <?php if ( has_category() ): ?>
        <?php the_category( '' ); ?>
    <?php endif; ?>
    <h2 class="post__title<?php if(is_single()): ?> post-single__title<?php endif; ?>">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_title() ?>
        </a>
    </h2>
</header>
