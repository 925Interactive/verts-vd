<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Forefront
 */

get_header(); ?>
	<!-- <div class="action-div"> <?php dynamic_sidebar( 'blockaction' );  ?> </div> -->

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