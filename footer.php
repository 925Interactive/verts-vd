<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Forefront
 */
?>
	</div><!-- #main -->

	<?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="site-info">
			©<?php echo date('Y');?> Les Verts Vaudois			
		</div><!-- .site-info -->

			
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php dynamic_sidebar( 'blocksocial' ); //Sidebar liens social media  ?> 
</body>
</html>