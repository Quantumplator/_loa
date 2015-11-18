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
<script>
  // include loadCSS here...
    /*! loadCSS: load a CSS file asynchronously. [c]2015 @scottjehl, Filament Group, Inc. Licensed MIT */
			(function(w){
				"use strict";
				/* exported loadCSS */
				var loadCSS = function( href, before, media ){
					// Arguments explained:
					// `href` [REQUIRED] is the URL for your CSS file.
					// `before` [OPTIONAL] is the element the script should use as a reference for injecting our stylesheet <link> before
						// By default, loadCSS attempts to inject the link after the last stylesheet or script in the DOM. However, you might desire a more specific location in your document.
					// `media` [OPTIONAL] is the media type or query of the stylesheet. By default it will be 'all'
					var doc = w.document;
					var ss = doc.createElement( "link" );
					var ref;
					if( before ){
						ref = before;
					}
					else {
						var refs = ( doc.body || doc.getElementsByTagName( "head" )[ 0 ] ).childNodes;
						ref = refs[ refs.length - 1];
					}

					var sheets = doc.styleSheets;
					ss.rel = "stylesheet";
					ss.href = href;
					// temporarily set media to something inapplicable to ensure it'll fetch without blocking render
					ss.media = "only x";

					// Inject link
						// Note: the ternary preserves the existing behavior of "before" argument, but we could choose to change the argument to "after" in a later release and standardize on ref.nextSibling for all refs
						// Note: `insertBefore` is used instead of `appendChild`, for safety re: http://www.paulirish.com/2011/surefire-dom-element-insertion/
					ref.parentNode.insertBefore( ss, ( before ? ref : ref.nextSibling ) );
					// A method (exposed on return object for external use) that mimics onload by polling until document.styleSheets until it includes the new sheet.
					var onloadcssdefined = function( cb ){
						var resolvedHref = ss.href;
						var i = sheets.length;
						while( i-- ){
							if( sheets[ i ].href === resolvedHref ){
								return cb();
							}
						}
						setTimeout(function() {
							onloadcssdefined( cb );
						});
					};

					// once loaded, set link's media back to `all` so that the stylesheet applies once it loads
					ss.onloadcssdefined = onloadcssdefined;
					onloadcssdefined(function() {
						ss.media = media || "all";
					});
					return ss;
				};
				// commonjs
				if( typeof module !== "undefined" ){
					module.exports = loadCSS;
				}
				else {
					w.loadCSS = loadCSS;
				}
			}( typeof global !== "undefined" ? global : this ));
  	// load a file
  		loadCSS( "http://loa.dylanjharris.net/wp-content/themes/_loa/style.css" );
</script>
<noscript><link href="style.css" rel="stylesheet"></noscript>

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
