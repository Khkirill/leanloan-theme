<?php

add_action( 'init', 'register_additional_term_fields' );
add_filter( 'the_category', function () {
	return ln_get_the_category_list();
}, 10 );

function register_additional_term_fields() {
	new TaxonomyMeta( [
		'id'       => 'ln',
		'taxonomy' => [ 'category' ],
		'args'     => [
			[
				'id'    => 'color',
				'title' => 'Цвет категории',
				'type'  => 'color',
				'desc'  => 'Укажите цвет ссылки категории',
				'std'   => '#a66bbe',
			]
		]
	] );
}

function get_category_color($category)
{
	$color = get_term_meta($category->term_id, 'ln_color', true);
	return $color ? ' style="background-color:' . esc_attr($color) . ';"' : '';
}

function ln_get_the_category_list( $separator = '', $parents = '', $post_id = false ) {
	global $wp_rewrite;

	if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
		return apply_filters( 'ln_the_category', '', $separator, $parents );
	}
	$categories = apply_filters( 'ln_the_category_list', get_the_category( $post_id ), $post_id );

	if ( empty( $categories ) ) {
		return apply_filters( 'ln_the_category', __( 'Uncategorized' ), $separator, $parents );
	}

	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

	$thelist = '';
	if ( '' === $separator ) {
		$thelist .= ('<span class="screen-reader-text">' . __( "Categories", "ln" ) . '</span>');
		$thelist .= '<ul class="post__categories">';
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, true, $separator );
					}
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name . '</a></li>';
					break;
				case 'single':
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '"  ' . $rel . '>';
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, false, $separator );
					}
					$thelist .= $category->name . '</a></li>';
					break;
				case '':
				default:
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name . '</a></li>';
			}
		}
		$thelist .= '</ul>';
	} else {
		$thelist .= '<div class="post__categories">';
		$thelist .= '<span class="screen-reader-text">' . _e( "Categories", "ln" ) . '</span>';
		$i = 0;
		foreach ( $categories as $category ) {
			if ( 0 < $i ) {
				$thelist .= $separator;
			}
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, true, $separator );
					}
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name . '</a>';
					break;
				case 'single':
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>';
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, false, $separator );
					}
					$thelist .= "$category->name</a>";
					break;
				case '':
				default:
					$thelist .= '<a'.get_category_color($category).' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name . '</a>';
			}
			++$i;
		}
		$thelist .= '</div>';
	}

	return apply_filters( 'ln_the_category', $thelist, $separator, $parents );
}
