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
	
	
	<div class="colonne1">
		<p>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lesverts.svg" width="25px"/> <strong>Les Verts, mouvement écologiste vaudois</strong>
			</p>
				<div class="adresse">
					<p>
						<br/>Place Palud 7
						<br/>1003 Lausanne
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/phone.svg" width="15px"/> 021 351 36 30
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/fax.svg" width="15px"/> 021 351 36 31
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mail.svg" width="15px"/> verts(at)verts-vd.ch
						<br/>CCP : 65-90000-6
					</p>
				</div>
	</div>
	
	
	<div class="colonne2">
		<a href="<?php echo get_stylesheet_directory_uri(); ?>/medias/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/medias.svg" width="300px"/></a>
	</div>
	
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