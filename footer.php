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
			<?php do_action( 'forefront_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'forefront' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'forefront' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'forefront' ), 'Forefront', '<a href="http://theme.wordpress.com/" rel="designer">WordPress.com</a>' ); ?>
		</div><!-- .site-info -->

		<?php
			$twitter_link  = get_theme_mod( 'jetpack-twitter', false );
			$facebook_link = get_theme_mod( 'jetpack-facebook', false );
			$linkedin_link = get_theme_mod( 'jetpack-linkedin', false );
			$tumblr_link   = get_theme_mod( 'jetpack-tumblr', false );
			$google_plus   = get_theme_mod( 'jetpack-google_plus', false );
			$social_links  = ( '' != $twitter_link
				|| '' != $facebook_link
				|| '' != $linkedin_link
				|| '' != $tumblr_link
				|| '' != $google_plus
			);
			$services = get_theme_support( 'social-links' );
		?>

		<?php if ( $social_links ) : ?>
		<ul class="social-links clear">
			<?php
				foreach ( $services[0] as $service ) :
				if ( get_theme_mod( "jetpack-$service", false ) ) :
			?>
			<li class="<?php echo $service; ?>-link">
				<a href="<?php echo esc_url( get_theme_mod( "jetpack-$service", '' ) ); ?>" title="<?php echo esc_attr( ucfirst( $service ) ); ?>" target="_blank">
					<?php echo ucfirst( $service ); ?>
				</a>
			</li>
			<?php
				endif;
				endforeach;
			?>
		</ul>
		<?php endif; ?>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php dynamic_sidebar( 'blocksocial' ); //Sidebar liens social media  ?> 


</body>
</html>