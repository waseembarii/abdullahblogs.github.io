<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProfitMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php profitmag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="post-thumb">
        <?php 
            if( has_post_thumbnail() ):
               
        ?>
                <a href="<?php the_permalink(); ?>"><?php  the_post_thumbnail( 'archive-thumb' ); ?></a>
        <?php
            endif;
        ?>
    </div>
    
    
    <div class="entry-content">
		<?php
			the_excerpt();            
		?>
		<a class="read-more" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?> "><?php esc_html_e('Read More', 'profitmag'); ?></a>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'profitmag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'profitmag' ) );
				if ( $categories_list ) :
			?>
			<span class="cat-links">
				<?php /* translators: 1: list of categories. */
				printf( esc_html__( 'Posted in %1$s', 'profitmag' ), $categories_list );// WPCS: XSS OK. ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'profitmag' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php /* translators: 1: list of tag. */
				printf( esc_html__( 'Tagged %1$s', 'profitmag' ), $tags_list );// WPCS: XSS OK. ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : 
		/* translators: 1: list of comment. */
		?>
		<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'profitmag' ), esc_html__( '1 Comment', 'profitmag' ), esc_html__( '% Comments', 'profitmag' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'profitmag' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->