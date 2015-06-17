<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Forefront<h1 class="page-title">
						
 */

get_header(); ?>

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
								<h1 class="page-title"><?php
							if ( have_posts() ) :
								printf( __( 'Search Results for: %s', 'forefront' ), '<span>' . get_search_query() . '</span>' );
							else :
								_e( 'Nothing Found', 'forefront' );
							endif;
						?>
					</h1>
							</div>
						</div>
					</div>
				</figure>

	</div>
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php forefront_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>