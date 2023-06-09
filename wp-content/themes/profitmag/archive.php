<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProfitMag
 */

get_header(); 

$profitmag_settings = profit_get_theme_options();

if( isset( $profitmag_settings['profitmag_sidebar_layout_setting'] )) {

        $sidebar_layout = $profitmag_settings['profitmag_sidebar_layout_setting'];    

}else {
       $sidebar_layout = 'right_sidebar';
}
if( $sidebar_layout == 'both_sidebar' ) {
       echo '<div id="primary-wrap" class="clearfix">';
}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<span class="bordertitle-red"></span>
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/* translators: %s: Author term */
							printf( esc_html__( 'Author: %s', 'profitmag' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							/* translators: %s: Date term */
							printf( esc_html__( 'Day: %s', 'profitmag' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							/* translators: %s: Date term */
							printf( esc_html__( 'Month: %s', 'profitmag' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'profitmag' ) ) . '</span>' );

						elseif ( is_year() ) :
							/* translators: %s: Date term */
							printf( esc_html__( 'Year: %s', 'profitmag' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'profitmag' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							esc_html_e( 'Asides', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							esc_html_e( 'Galleries', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							esc_html_e( 'Images', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							esc_html_e( 'Videos', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							esc_html_e( 'Quotes', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							esc_html_e( 'Links', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							esc_html_e( 'Statuses', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							esc_html_e( 'Audios', 'profitmag' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							esc_html_e( 'Chats', 'profitmag' );

						else :
							esc_html_e( 'Archives', 'profitmag' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						/* translators: %s: term description */
						printf( '<div class="taxonomy-description">%s</div>', wp_kses_post($term_description) );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
                        
            <?php profitmag_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>
<?php
if( $sidebar_layout == 'both_sidebar' ) {
    echo '</div>';
}
?>
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
