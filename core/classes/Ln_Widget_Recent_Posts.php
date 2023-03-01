<?php


class Ln_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget-recent',
			'description'                 => __( 'Your site&#8217;s most recent Posts.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'ln-recent-posts', __( 'Themes Recent Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Recent Posts' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query(
		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 */
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'];
			echo $title;
			?>
            <span class="widget-recent__carousel-controls">
                    <button class="js-control-prev widget-recent__carousel-control widget-recent__prev">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="284.935px" height="284.936px" viewBox="0 0 284.935 284.936">
                            <path fill="#5e5e5e" d="M222.701,135.9L89.652,2.857C87.748,0.955,85.557,0,83.084,0c-2.474,0-4.664,0.955-6.567,2.857L62.244,17.133
                            c-1.906,1.903-2.855,4.089-2.855,6.567c0,2.478,0.949,4.664,2.855,6.567l112.204,112.204L62.244,254.677
                            c-1.906,1.903-2.855,4.093-2.855,6.564c0,2.477,0.949,4.667,2.855,6.57l14.274,14.271c1.903,1.905,4.093,2.854,6.567,2.854
                            c2.473,0,4.663-0.951,6.567-2.854l133.042-133.044c1.902-1.902,2.854-4.093,2.854-6.567S224.603,137.807,222.701,135.9z"/>
                        </svg>
                    </button>
                    <button class="js-control-next widget-recent__carousel-control widget-recent__next">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="284.935px" height="284.936px" viewBox="0 0 284.935 284.936">
                            <path fill="#5e5e5e" d="M222.701,135.9L89.652,2.857C87.748,0.955,85.557,0,83.084,0c-2.474,0-4.664,0.955-6.567,2.857L62.244,17.133
                            c-1.906,1.903-2.855,4.089-2.855,6.567c0,2.478,0.949,4.664,2.855,6.567l112.204,112.204L62.244,254.677
                            c-1.906,1.903-2.855,4.093-2.855,6.564c0,2.477,0.949,4.667,2.855,6.57l14.274,14.271c1.903,1.905,4.093,2.854,6.567,2.854
                            c2.473,0,4.663-0.951,6.567-2.854l133.042-133.044c1.902-1.902,2.854-4.093,2.854-6.567S224.603,137.807,222.701,135.9z"/>
                        </svg>
                    </button>
                </span>
			<?php
			echo $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav role="navigation" aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

        <div class="js-widget-recent-carousel">
			<?php foreach ( $r->posts as $key => $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$aria_current = '';

				if ( get_queried_object_id() === $recent_post->ID ) {
					$aria_current = ' aria-current="page"';
				}
				?>
			    <?php if( ( $key + 1 ) % 3 === 1): ?>
                <div>
				<?php endif; ?>
                    <div class="widget-recent__item">
                        <div class="widget-recent__image">
                            <a href="<?php the_permalink( $recent_post->ID ); ?>">
								<?= get_the_post_thumbnail(  $recent_post->ID, 'thumbnail' ); ?>
                            </a>
                        </div>
                        <div>
                            <a class="widget-recent__post-title" href="<?php the_permalink( $recent_post->ID ); ?>"
								<?php echo $aria_current; ?>><?php echo $title; ?>
                            </a>
                        </div>
						<?php if ( $show_date ) : ?>
                            <span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
						<?php endif; ?>
                    </div>
                <?php if( ( $key + 1 ) % 3 === 0): ?>
                    </div>
                <?php else: ?>
				    <?php if( ( $key + 1 ) === count($r->posts)): ?>
                    </div>
					<?php endif; ?>
				<?php endif; ?>

			<?php endforeach; ?>
        </div>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 * @since 2.8.0
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @param array $instance Current settings.
	 *
	 * @since 2.8.0
	 *
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>"
                   name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1"
                   value="<?php echo $number; ?>" size="3"/>
        </p>

        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?>
                   id="<?php echo $this->get_field_id( 'show_date' ); ?>"
                   name="<?php echo $this->get_field_name( 'show_date' ); ?>"/>
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
        </p>
		<?php
	}
}
