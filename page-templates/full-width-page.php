<?php
/**
 * Template Name: Full Width Page
 *
 * @package Forefront
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
<div class="hero <?php echo forefront_additional_class(); ?>">
<figure>
					<?php
			if ( '' != get_the_post_thumbnail() )
				the_post_thumbnail( 'forefront-page-thumbnail' );
		else {
echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default.jpg" />';
} ?>
					<div>
						<div>
							<div>
								<h1 class="page-title"><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</figure>

	</div>


	<?php endwhile; ?>

	<?php rewind_posts(); ?>

	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
