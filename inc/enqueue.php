<?php
/**
 * Enqueue scripts and styles.
 */
function _loa_scripts() {
  // wp_enqueue_style( '_loa-style', get_stylesheet_uri() );

  // If not in admin, move jquery to the footer like a baows
  if(!is_admin()){
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery-core', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery-core' );
  }

  // Grab our own custom js
  wp_enqueue_script( '_loa-main', get_template_directory_uri() . '/js/main.min.js', array('jquery-core'), '', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

add_action( 'wp_enqueue_scripts', '_loa_scripts' );




// NOTES FOR LATER
// Tricks in here https://github.com/ericvalois/bulledev-v10/blob/master/functions.php#L29

// function atom_scripts_and_styles() {
//     // Only on stage
//     if( !strpos($_SERVER['SERVER_NAME'], 'bulledev.com') ){
//         wp_enqueue_style( 'atom-style', get_stylesheet_uri() );
//     }
  
//     // jQuery
//     if( is_page(199) || is_page(1485) || is_page(1489) || is_page(1450) ){
//         wp_enqueue_script( 'jquery' ); 
//     }
// }
