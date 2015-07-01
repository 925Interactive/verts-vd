<?php
/**
 * The default template for displaying content.
 *
 * @package Forefront
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( 'post' == get_post_type() && ! is_single() && '' != get_the_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" class="blog-thumbnail">
		<?php the_post_thumbnail( 'forefront-blog-thumbnail' ); ?>
	</a>
	<?php elseif ( 'post' == get_post_type() && '' != get_the_post_thumbnail() ) : ?>
	<span class="blog-thumbnail">
		<?php the_post_thumbnail( 'forefront-blog-thumbnail' ); ?>
	</span>
	<?php endif; ?>

	<header class="entry-header">
		<?php
			$categories_list = get_the_category_list( __( ', ', 'forefront' ) );
			if ( $categories_list && forefront_categorized_blog() )
				echo '<span class="categories-links">' . $categories_list . '</span>';
		?>

		<?php if ( ! has_post_format( 'aside' ) && ! has_post_format( 'quote' ) && ! has_post_format( 'link' ) ) : ?>
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
				endif;
			?>
		<?php endif; ?>

		<div class="entry-meta clear">
			<?php if ( false != get_post_format() ) : ?>
				<span class="entry-format">
					<a href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'forefront' ), get_post_format_string( get_post_format() ) ) ); ?>"><?php echo get_post_format_string( get_post_format() ); ?></a>
				</span>
			<?php endif; ?>

			<?php
				if ( 'post' == get_post_type() )
					forefront_posted_on();
			?>

			<?php edit_post_link( __( 'Edit', 'forefront' ), '<span class="edit-link">', '</span>' ); ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'forefront' ), __( '1 Comment', 'forefront' ), __( '% Comments', 'forefront' ) ); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->


	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'forefront' ) ); ?>

		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'forefront' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>'
			) );
		?>
	</div>
	<?php endif; ?>

	<?php
		$tags_list = get_the_tag_list( '', __( ', ', 'forefront' ) );
		if ( '' != $tags_list && 'post' == get_post_type() ) :
	?>
	<footer class="entry-meta">
		<span class="tags-links"><?php echo $tags_list; ?></span>
	</footer>
	<?php endif; // End if if $tags_list & 'post' == get_post_type() ?>
</article><!-- #post-## -->
