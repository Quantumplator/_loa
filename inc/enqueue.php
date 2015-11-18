<?php
/**
 * Enqueue scripts and styles.
 */
function _loa_scripts() {
  // wp_enqueue_style( '_loa-style', get_stylesheet_uri() );

  // If not in admin, move jquery to the footer & just kill jquery-migrate like a baows
  if(!is_admin()){
    wp_deregister_script( 'jquery' );
    wp_deregister_script( 'jquery-migrate' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );
  }

  // Grab our own custom js
  wp_enqueue_script( '_loa-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'), '', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

add_action( 'wp_enqueue_scripts', '_loa_scripts' );