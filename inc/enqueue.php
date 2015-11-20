<?php
/**
* Load theme scripts in the footer
* Big thanks to Chris Ferdinandi on this one!
* ref: http://gomakethings.com/inlining-critical-css-for-better-web-performance/
*/
function _loa_load_theme_files() {
  // If stylesheet is in browser cache, load it the traditional way
  // Otherwise, inline critical CSS and load full stylesheet asynchronously
  // See _loa_initialize_theme_detects()
  if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' ) {
    wp_enqueue_style( '_loa-theme-styles', get_template_directory_uri() . '/style.css', null, null, 'all' );
  }
  // Load JavaScript file
  wp_enqueue_script( '_loa-theme-scripts', get_template_directory_uri() . '/js/main.min.js', null, null, true );
}
add_action('wp_enqueue_scripts', '_loa_load_theme_files');

/**
* Include feature detect inits (in my case just loadCSS) in the header
*/
function _loa_initialize_theme_detects() {
  // If stylesheet is in browser cache, load it the traditional way
  if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' ) { ?>
    <script>
      // Contains only loadCSS.js and onloadCSS.js
      // consider setting up some light feature detection (for things like SVG support)
      <?php echo file_get_contents( get_template_directory_uri() . '/js/detectsHAScookie.js' ); ?>
    </script>
  <?php
  // Otherwise, inline critical CSS and load full stylesheet asynchronously
  } else { ?>
    <script>
      <?php echo file_get_contents( get_template_directory_uri() . '/js/detectsSETcookie.js' ); ?>
    </script>
    <style>
      <?php 
      // THIS NEEDS TO RESPOND TO PAGE TEMPLATES IN THE FUTURE
      echo file_get_contents( get_template_directory_uri() . '/css/critical.css' ); ?>
    </style>
  <?php
  }
}
add_action('wp_head', '_loa_initialize_theme_detects', 30);

/**
* Include script inits in the footer
*/
function _loa_initialize_theme_scripts() {
  // If cookie isn't set, load a noscript fallback
  if ( !isset($_COOKIE['fullCSS']) || $_COOKIE['fullCSS'] !== 'true' ) {
  ?>
    <noscript>
      <link href='<?php echo get_template_directory_uri() . "/style.css"; ?>' rel='stylesheet' type='text/css'>
    </noscript>
  <?php
  }
  ?>
<script>
// Inline footer JavaScript and inits
</script>
<?php
}
add_action('wp_footer', '_loa_initialize_theme_scripts', 30);