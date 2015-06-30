<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Forefront
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
								<h1 class="page-title">
						<?php _e( 'Oops! That page can&rsquo;t be found.', 'forefront' ); ?>
					</h1>
							</div>
						</div>
					</div>
				</figure>

	</div>


	
	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'forefront' ); ?></p>

					<?php get_search_form(); ?>

					<div class="widget-container">
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

						<?php if ( forefront_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
						<div class="widget widget_categories">
							<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'forefront' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->
						<?php endif; ?>

						<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'forefront' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						?>

						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

					</div><!-- .widget-container -->
				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>