<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ProfitMag
 */

if ( ! function_exists( 'profitmag_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function profitmag_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( 
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'profitmag' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: author. */
		esc_html_x( 'by %s', 'post author', 'profitmag' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';// WPCS:XSS OK //

}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
    function wp_body_open() {
        do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }
endif;

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 */

if ( ! function_exists( 'profitmag_pingback_header' ) ) :
    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function profitmag_pingback_header() {

        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }

    }
endif;
add_action( 'wp_head', 'profitmag_pingback_header' );
