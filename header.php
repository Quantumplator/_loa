<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _loa
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_loa' ); ?></a>

	<header id="masthead" class="site-header l-header" role="banner">
		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->

		<div class="site-controls">

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<!-- Menu button with screen-reader-text toggle instructions -->
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text" aria-hidden="false"><?php esc_html_e( 'Press enter to toggle', '_djh' ); ?></span><?php esc_html_e( 'Menu', '_loa' ); ?></button>
				<?php _loa_primary_menu(); ?>
			</nav><!-- #site-navigation -->

			<nav id="site-search" class="main-search" role="navigation">
				(search)
			</nav><!-- #site-search -->

		</div><!-- .site-controls -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
