<?php
/**
 * @global array $args
 */
$current           = $args['current'];
$total             = $args['total'];
$paginationNumbers = $args['paginationNumbers'];
$link              = $args['link'];

function ln_get_page_link( $num, $link ) {
	return esc_attr(preg_replace( '@%#%@', $num, $link ));
}

?>

<nav class="pagination">
	<? foreach ( $paginationNumbers as $number ): ?>
		<? if ( $number === $current ): ?>
            <span class="page-numbers current" tabindex="0">
                <?= $current; ?>
            </span>
		<? else: ?>
            <a class="page-numbers js-page-numbers" tabindex="0" data-page="<?= $number ?>"
               href="<?= ln_get_page_link( $number, $link ); ?>">
				<?= $number; ?>
            </a>
		<? endif; ?>
	<? endforeach; ?>
</nav>
