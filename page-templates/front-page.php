<?php
/**
 * Template Name: Front Page 
 *
 * @package Forefront
 
 * Utilisé pour l'affichages des pages d'acceuil > site principal , blogues, sections
 */

get_header(); ?>

	<div id="primary-home" class="content-area front-page-content-area full-width">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			
				<?php
								if ( is_main_site($blog_id) ) {
								    // Si vous êtes sur le site principal Le Slider
								   
								dynamic_sidebar( 'blockslider' ); //Sidebar slider 
								} else {
								    // Si vous êtes sur les autres sites une Images et un titre
								    ?>
								    
			<div class="hero <?php echo forefront_additional_class(); ?>">					    
								   <?php if ( '' != get_the_post_thumbnail() ) : ?>
				<figure>
					<?php the_post_thumbnail( 'forefront-page-thumbnail' ); ?>
					<div>
						<div>
							<div>
								<h1 class="page-title"><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</figure>
			
				<?php endif; ?>
				<div><div><div>
					 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
																<header class="entry-header">
																	<h1 class="page-title sanukot"><?php the_title(); ?></h1>
																</header>
					<div class="entry-content">
									<?php the_content(); ?>
								</div>
								<?php edit_post_link( __( 'Edit', 'forefront' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
							</article>
						</div>
					</div>
				</div>
			</div>


								    
								<?php }
								?>
				
								
					
						
							
							

								
							
							
								
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<div class="action-div"> <?php dynamic_sidebar( 'blockaction' ); //Sidebar pour dont contact et newsletter  ?> </div>
	 <?php get_sidebar(); ?> 

	<?php get_sidebar( 'front-page-one' ); ?>

	<?php get_sidebar( 'front-page-two' ); ?>
	
	

	<?php $testimonials = forefront_get_random_posts( 2, 'jetpack-testimonial' ); ?>

	<?php if ( ! empty( $testimonials ) ) : ?>
	<div class="clear testimonials">
		<?php
			foreach ( $testimonials as $testimonial ) : setup_postdata( $GLOBALS['post'] =& $testimonial );
				 get_template_part( 'content', 'testimonial' );
			endforeach;
			wp_reset_postdata();
		?>
	</div>
	<?php endif; ?>

<?php get_footer(); ?>