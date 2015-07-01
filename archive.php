<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Forefront
 */

get_header(); ?>

	<div class="hero page-header <?php echo forefront_additional_class(); ?>">
		
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
								<h1 class="page-title"> <?php
						if ( have_posts() ) :
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'forefront' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'forefront' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'forefront' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'forefront' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'forefront' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'forefront' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'forefront');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audio', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'forefront' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'forefront' );

							else :
								_e( 'Archives', 'forefront' );

							endif;
						else :
					 		_e( 'Oops! Nothing Found.', 'forefront' );
						endif;
					?>
					</h1>
							</div>
						</div>
					</div>
				</figure>


		
	</div><!-- .page-header -->

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() );?>

			<?php endwhile; ?>

			<?php forefront_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>