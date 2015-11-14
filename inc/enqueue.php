<?php
/**
 * Enqueue scripts and styles.
 */
function _loa_scripts() {
  wp_enqueue_style( '_loa-style', get_stylesheet_uri() );

  wp_enqueue_style( '_loa-fonts', '//fonts.googleapis.com/css?family=Julius+Sans+One|Open+Sans:400,700,400italic' );

  wp_enqueue_script( '_loa-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'), '20151101', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', '_loa_scripts' );