<?php

/**
 * Theme setup functions.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';