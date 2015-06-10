<?php
/**
 * The default template for displaying pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Forefront
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="hero <?php echo forefront_additional_class(); ?>">
		<?php
			if ( '' != get_the_post_thumbnail() )
				the_post_thumbnail( 'forefront-page-thumbnail' );
		?>
		<div>
			<div>
				<div>
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="action-div"> <?php dynamic_sidebar( 'blockaction' ); //Sidebar pour dont contact et newsletter  ?> </div>

	<?php endwhile; ?>

	<?php rewind_posts(); ?>

	<div id="primary" class="content-area">
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>