<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProfitMag
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<span class="bordertitle-red"></span>
			<?php esc_html_e( 'Nothing Found', 'profitmag' ); ?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
			/* translators: %s: Publish term */ 
			printf( esc_html__( 'Ready to publish your first post? <a href="%1$s"></a>.', 'profitmag' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'profitmag' ); ?></p>
			

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'profitmag' ); ?></p>
			

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
