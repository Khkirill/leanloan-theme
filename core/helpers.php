<?php
/**
 *  Create additional image sizes
 *
 * @return  array List of image size parameters
 * @since  1.0
 */

if ( ! function_exists( 'ln_get_image_sizes' ) ) {
    function ln_get_image_sizes() {
        $sizes = [];

        return apply_filters( 'ln_modify_image_sizes', $sizes );
    }
}


/**
 * Get list of colors for block editor
 *
 * @return array
 * @since  1.0
 */
if ( ! function_exists( 'ln_get_editor_colors' ) ) {
    function ln_get_editor_colors() {
        $colors = [
            [
                'name'  => esc_html__( 'Background', 'ln' ),
                'slug'  => 'ln-bg',
                'color' => '#ddd',
            ],

        ];

        return apply_filters( 'ln_modify_editor_colors', $colors );
    }
}


/**
 * Get list of font sizes for block editor
 *
 * @return array
 * @since  1.9
 */
if ( ! function_exists( 'ln_get_editor_font_sizes' ) ) {
    function ln_get_editor_font_sizes() {

        $regular = absint( '16' );

        $s  = $regular * 0.8;
        $l  = $regular * 1.3;
        $xl = $regular * 1.7;

        $s_mobile  = 16 * 0.8;
        $l_mobile  = 16 * 1.3;
        $xl_mobile = 16 * 1.6;

        $sizes = [
            [
                'name'        => esc_html__( 'Small', 'ln' ),
                'shortName'   => esc_html__( 'S', 'ln' ),
                'size'        => $s,
                'size-mobile' => $s_mobile,
                'slug'        => 'small',
            ],

            [
                'name'      => esc_html__( 'Normal', 'ln' ),
                'shortName' => esc_html__( 'M', 'ln' ),
                'size'      => $regular,
                'slug'      => 'normal',
            ],

            [
                'name'        => esc_html__( 'Large', 'ln' ),
                'shortName'   => esc_html__( 'L', 'ln' ),
                'size'        => $l,
                'size-mobile' => $l_mobile,
                'slug'        => 'large',
            ],
            [
                'name'        => esc_html__( 'Huge', 'ln' ),
                'shortName'   => esc_html__( 'XL', 'ln' ),
                'size'        => $xl,
                'size-mobile' => $xl_mobile,
                'slug'        => 'huge',
            ]
        ];

        return apply_filters( 'ln_modify_editor_font_sizes', $sizes );
    }
}


/**
 * Generate dynamic css
 *
 * Function parses theme options and generates css code dynamically
 *
 * @return string Generated css code
 * @since  1.0
 */

if ( ! function_exists( 'ln_generate_dynamic_css' ) ) {
    function ln_generate_dynamic_css() {
        ob_start();
        get_template_part( 'assets/css/dynamic-css' );
        $output = ob_get_contents();
        ob_end_clean();
        return ln_compress_css_code( $output );
    }
}


/**
 * Compress CSS Code
 *
 * @param string $code Uncompressed css code
 *
 * @return string Compressed css code
 * @since  1.0
 */

if ( ! function_exists( 'ln_compress_css_code' ) ) {
    function ln_compress_css_code( $code ) {
        // Remove Comments
        $code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );
        // Remove tabs, spaces, newlines, etc.
        return str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

    }
}

/**
 * Get JS settings
 *
 * Function creates list of settings from thme options to pass
 * them to global JS variable so we can use it in JS files
 *
 * @return array List of JS settings
 * @since  1.0
 */
if ( !function_exists( 'ln_get_js_settings' ) ){
    function ln_get_js_settings():array {
        $js_settings = [];
        return $js_settings;
    }
}

if ( !function_exists( 'ln_module_template_is_paged' ) ):
    function ln_module_template_is_paged() {
        $current_page = is_front_page() ? absint( get_query_var( 'page' ) ) : absint( get_query_var( 'paged' ) );
        return $current_page > 1 ? $current_page : false;
    }
endif;


function ln_current_page() {
    $current_page = is_front_page() ? absint( get_query_var( 'page' ) ) : absint( get_query_var( 'paged' ) );
    return $current_page ? $current_page : 1;
}


if ( !function_exists( 'ln_get_prev_next_posts' ) ):
    function ln_get_prev_next_posts() {
        $prev = get_adjacent_post( false, '', false, 'category' );
        $next = get_adjacent_post( false, '', true, 'category' );
        return array( 'prev' => $prev, 'next' => $next );
    }
endif;

/**
 * Get related posts for particular post
 *
 * @param int     $post_id
 * @return object WP_Query
 * @since  1.6
 */
if ( !function_exists( 'ln_get_related_posts' ) ):
    function ln_get_related_posts( $post_id = false ) {
        if ( empty( $post_id ) ) {
            $post_id = get_the_ID();
        }
        $args['post_type'] = 'post';
        //Exclude current post from query
        $args['post__not_in'] = array( $post_id );
        $num_posts = 3;
        if ( $num_posts > 100 ) {
            $num_posts = 100;
        }
        $args['posts_per_page'] = $num_posts;
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
        return new WP_Query( $args );
    }
endif;


function get_pagination($params)
{
    global $wp_rewrite, $wp_query;
    $link = get_home_url() . '/page/%#%/';
    if (is_category()){
        $link = '/';
    }
    $current = $params['page'];
    $total = $params['max_num_pages'];
    $maxCountNumbers = 5;
    $paginationNumbers = [];
    $paginationNumbers[] = $current;
    $iter = 1;
    while (count($paginationNumbers) < $maxCountNumbers) {
        $leftPageNumber = $current - $iter;
        $rightPageNumber = $current + $iter;
        if ($leftPageNumber >= 1) {
            $paginationNumbers[] = $leftPageNumber;
        }
        if ($rightPageNumber <= $total) {
            $paginationNumbers[] = $rightPageNumber;
        }
        if ($leftPageNumber < 1 && $rightPageNumber > $total) {
            break;
        }
        $iter++;
    }
    sort($paginationNumbers);

    get_template_part('template-parts/pagination', '', [
        'current' => $current,
        'total' => $total,
        'paginationNumbers' => $paginationNumbers,
        'link' => $link
    ]);
}
