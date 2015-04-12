<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package PixelHunter
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'pixel_hunter' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'pixel_hunter' ), 'WordPress' ); ?></a>
			<span class="sep"> // </span>
			<?php printf( __( 'Theme: %1$s by %2$s', 'pixel_hunter' ), 'PixelHunter', '<a href="http://www.twitter.com/hmnt235" rel="designer">Hemant Acharya</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
