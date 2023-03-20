<?php
/**
 * @package ProfitMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php  profitmag_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="single-feat clearfix">
        <figure class="single-thumb">
            <?php 
                if( has_post_thumbnail() ):
                    the_post_thumbnail( 'single-thumb' );           
                endif; 
            ?>
        </figure>
        
        <div class="related-post">
            <h2 class="block-title"><span class="bordertitle-red"></span><?php esc_html_e( 'Related Post', 'profitmag'); ?></h2>
            <?php profitmag_related_post( get_the_ID() ); ?>
            <ul>
                
            </ul>
        </div>
    </div>
    
    <div class="entry-content">
		
        <figure></figure>
        <?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'profitmag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'profitmag' ) );
				if ( $categories_list ) :
			?>
			<span class="cat-links">
				<?php /* translators: list of category*/
				printf( esc_html__( 'Posted in %1$s', 'profitmag' ), $categories_list );// WPCS: XSS OK. ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'profitmag' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php /* translators: list of term*/
				printf( esc_html__( 'Tagged %1$s', 'profitmag' ), $tags_list );// WPCS: XSS OK. ?>
			</span>
			<?php endif; // End if $tags_list ?>
		     
	

		<?php edit_post_link( esc_html__( 'Edit', 'profitmag' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
