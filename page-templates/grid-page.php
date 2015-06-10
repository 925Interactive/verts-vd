<?php
/**
 * Template Name: Grid Page
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

	<?php endwhile; ?>

	<?php rewind_posts(); ?>

	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			<div class="child-pages grid clear">
				<?php
					$child_pages = new WP_Query( array(
						'post_type'      => 'page',
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'post_parent'    => $post->ID,
						'posts_per_page' => 999,
						'no_found_rows'  => true,
					) );

					while ( $child_pages->have_posts() ) : $child_pages->the_post();
						 get_template_part( 'content', 'grid' );
					endwhile;
					wp_reset_postdata();
				?>
			</div><!-- .child-pages -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
<div class="action-div"> <?php dynamic_sidebar( 'blockaction' ); //Sidebar pour dont contact et newsletter  ?> </div>
<?php get_footer(); ?>
