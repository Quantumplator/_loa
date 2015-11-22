<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _loa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _loa_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

  // Adds a class of t-home (template home) to front page for smacss layout
  if ( is_front_page() ) {
    $classes[] = 't-home';
  }

  // Adds a class of t-list (template list) to all archives
  if ( is_home() || is_archive() || is_search() ) {
    $classes[] = 't-list';

    // Add t-posts class (template posts) in addition to t-list for all archives
    if ( 'post' == get_post_type() ) {
      $classes[] = 't-posts';
    }
  }

  // Add t-single (template single) to any single page or post
  if ( !is_front_page() && is_singular()) {
    $classes[] = 't-single';
  }

	return $classes;
}
add_filter( 'body_class', '_loa_body_classes' );
