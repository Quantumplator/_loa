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

<?php 
/**
 * Borrowed from the mighty pocketjoso https://gist.github.com/pocketjoso/58cb89ad9e69e4da297e 
 */
$pagefile = $_SERVER['DOCUMENT_ROOT'] . htmlspecialchars($_SERVER['PHP_SELF']);
$critcssfile = $pagefile . ".css";
if (file_exists($critcssfile)) { ?>
	<!-- inline critical css -->
	<style><?php include($critcssfile); ?></style>
	<!-- use loadCSS to load full CSS async, from: https://github.com/filamentgroup/loadCSS --> 
	<!-- (include file is built per project with Gulp.js) -->
	<?php include get_stylesheet_directory() . '/inc/loadCSS.php'; ?>
	<!-- provide a no JS fallback to get the full css -->
	<?php include get_stylesheet_directory() . '/inc/noloadCSS.php';
} else { ?>
	<!-- no critical css for this page - just load full css in ye ol fashion render blocking way. -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory() . '/style.css'; ?>" />
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_loa' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_loa' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
