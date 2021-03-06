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
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lesverts.svg" width="25px" height="20px"/> <strong>Les Verts, mouvement écologiste vaudois</strong>
			</p>
				<div class="adresse">
					<p>
						<br/>Place Palud 7
						<br/>1003 Lausanne
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/phone.svg" width="15px" height="15px"/> 021 351 36 30
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/fax.svg" width="15px" height="15px"/> 021 351 36 31
						<br/><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mail.svg" width="15px" height="15px"/> verts(at)verts-vd.ch
						<br/>CCP : 65-90000-6
					</p>
				</div>
	</div>
	
	
	<div class="colonne2">
		<a href="<?php echo network_home_url(); ?>medias/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/medias.svg" width="300px" height="100%"/></a>
	</div>
	
	<div class="colonne3">
		<div class="menu-footer">
					<p>
			
						 <p><span class="icones icon-calendrier"></span><a href="<?php echo network_home_url(); ?>events/ "> Calendrier </a></p>
                     
                        <p><span class="icones icon-contact"></span><a href="<?php echo network_home_url(); ?>accueil/contact/ "> Contact </a></p>
	
						<p><span class="icones icon-membre"></span><a href="<?php echo network_home_url(); ?>devenir-membre/ "> Devenir Membre </a></p>
                
                        <p><span class="icones icon-soutien"></span><a href="<?php echo network_home_url(); ?>nous-soutenir"> Nous soutenir </a></p>
						
					</p>
				</div>

	</div>
	
	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="site-info">
			©<?php echo date('Y');?> Les Verts Vaudois			
		</div>
		<br/>
		<div class="site-real">
			
			
				<p class="realisation">Réalisation:
				<a href="http://925.ch" target="_blank" title="925interactive"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logoblanc_130x130.svg" width="20px"/></a> & <a href="http://whyopencomputing.ch/" target="_blank" title="why open computing">Why	</a>	
				</p>	
		</div>
		
		<!-- .site-info -->

			
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>
<?php dynamic_sidebar( 'blocksocial' ); //Sidebar liens social media  ?> 
</body>
</html>