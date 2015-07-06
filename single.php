<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Forefront
 */

get_header(); ?>
<div class="hero <?php echo forefront_additional_class(); ?>">
<figure>
					<?php
			
echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default.jpg" />';
 ?>
					<div>
						<div>
							<div>
								<h1 class="page-title"><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</figure>

	</div>
	<div class="action-div"> <?php dynamic_sidebar( 'blockaction' ); //Sidebar pour dont contact et newsletter  ?> </div>

	<div id="primary" class="content-area">

		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				if ( 'jetpack-testimonial' == get_post_type() )
					get_template_part( 'content', 'testimonial' );
				else
					get_template_part( 'content', get_post_format() );
			?>

			<?php forefront_content_nav( 'nav-below' ); ?>

			

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>


<?php get_footer(); ?>