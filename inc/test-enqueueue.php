<?php
/**
 * Load theme scripts in the footer
 */
function keel_load_theme_files() {
    // If stylesheet is in browser cache, load it the traditional way
    // Otherwise, inline critical CSS and load full stylesheet asynchronously
    // See keel_initialize_theme_detects()
    if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' ) {
        wp_enqueue_style( 'keel-theme-styles', get_template_directory_uri() . '/path/to/full.css', null, null, 'all' );
    }
    // Load JavaScript file
    wp_enqueue_script( 'keel-theme-scripts', get_template_directory_uri() . '/path/to/full.js', null, null, true );
}
add_action('wp_enqueue_scripts', 'keel_load_theme_files');

/**
 * Include feature detect inits in the header
 */
function keel_initialize_theme_detects() {
    // If stylesheet is in browser cache, load it the traditional way
    if ( isset($_COOKIE['fullCSS']) && $_COOKIE['fullCSS'] === 'true' ) {
    ?>
        <script>
            // Contains loadCSS.js, onloadCSS.js, and some light feature detection (for things like SVG support)
            <?php echo file_get_contents( get_template_directory_uri() . '/path/to/detects.js' ); ?>
        </script>
    <?php

    // Otherwise, inline critical CSS and load full stylesheet asynchronously
    } else {
    ?>
        <script>
            <?php echo file_get_contents( get_template_directory_uri() . '/path/to/detects.js' ); ?>
            var stylesheet = loadCSS('<?php echo get_template_directory_uri() . "/path/to/full.css"; ?>');
            onloadCSS( stylesheet, function() {
                var expires = new Date(+new Date + (7 * 24 * 60 * 60 * 1000)).toUTCString();
                document.cookie = 'fullCSS=true; expires=' + expires;
            });
        </script>
        <style>
            <?php echo file_get_contents( get_template_directory_uri() . '/path/to/critical.css' ); ?>
        </style>
    <?php
    }
}
add_action('wp_head', 'keel_initialize_theme_detects', 30);

/**
 * Include script inits in the footer
 */
function keel_initialize_theme_scripts() {
    // If cookie isn't set, load a noscript fallback
    if ( !isset($_COOKIE['fullCSS']) || $_COOKIE['fullCSS'] !== 'true' ) {
    ?>
        <noscript>
            <link href='<?php echo get_template_directory_uri() . "/path/to/full.css"; ?>' rel='stylesheet' type='text/css'>
        </noscript>
    <?php
    }

    ?>
        <script>
            // Inline footer JavaScript and inits
        </script>
    <?php
}
add_action('wp_footer', 'keel_initialize_theme_scripts', 30);