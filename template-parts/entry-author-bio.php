<div class="author">
    <?php if(false): ?>
    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
       class="author__link" rel="author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
		<?= esc_html( get_the_author() ) ?>
    </a>
    <?php endif; ?>
    <span class="date">
        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="calendar"
             class="svg-inline--fa fa-calendar fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path
                    fill="currentColor"
                    d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path></svg>
        <?php if ( current_time( 'timestamp' ) - get_the_date( 'U', get_the_ID() ) < ( 12 * 60 * 60 ) ): ?>
            Сегодня
        <?php else: ?>
            <?= human_time_diff( get_the_date( 'U', get_the_ID() ), current_time( 'timestamp' ) ) . ' ' . __( 'назад' ) ?>
        <?php endif; ?>
    </span>
</div>