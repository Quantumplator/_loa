<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _loa
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php _loa_social_menu(); ?>
		<div class="site-info">
      Copyright
      <span class="sep">&copy;</span>
      1984&ndash;<?php echo date('Y'); ?>
      <a href="https://dylanjharris.net" rel="designer">Dylan J Harris</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
