<?php
/**
 * Custom Recent_Posts with Thumbanil widget class
 *
 * @package ProfitMag
 */

add_action( 'widgets_init', 'register_recent_post_widget' );
function register_recent_post_widget() {
	register_widget( 'WP_ProfitMag_Recent_Posts' );
}

class WP_ProfitMag_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
            'classname'     => 'profitmag_widget_recent_entries',
            'description'   => esc_html__( "Display recent posts with thumbnail and date of post.", 'profitmag' ),
            'customize_selective_refresh' => true,
        );
		parent::__construct('profitmag-recent-posts', esc_html__('Profitmag: Recent Posts', 'profitmag'), $widget_ops);
		$this->alt_option_name = 'profitmag_widget_recent_entries';
		
	}

	public function widget($args, $instance) {		

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'profitmag' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
		if ( ! $number )
			$number = 4;
		

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => absint($number),
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
			) ) );

		if ($r->have_posts()) :
			?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		} ?>
		<ul>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>			
				<li>
					<figure class="widget-image recent-image clearfix">
						<?php if( has_post_thumbnail() ): ?>
							<?php $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'recent-thumb' ); ?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
						<?php endif; ?>
					</figure>
					
					<p class="post-desc">
						<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						<div class="post-date"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date( 'F d, Y')) ; ?></div>
					</p>
					
				</li>
			<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];		
		return $instance;
	}



	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'profitmag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'profitmag' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

				
				<?php
			}
		}