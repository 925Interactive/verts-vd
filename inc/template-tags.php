<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Forefront
 */

if ( ! function_exists( 'forefront_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function forefront_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'forefront' ); ?></h1>

	<?php
		if ( is_single() && 'jetpack-testimonial' == get_post_type() ) :
			previous_post_link( '<div class="nav-previous">%link</div>', __( '<span class="meta-nav">Previous testimonial</span>', 'forefront' ) );
			next_post_link( '<div class="nav-next">%link</div>', __( 'Next testimonial', 'forefront' ) );

		elseif ( is_attachment() ) :
			previous_post_link( '<div class="nav-previous">%link</div>', __( '<span class="meta-nav">View the post</span>', 'forefront' ) );

		elseif ( is_single() ) :
			previous_post_link( '<div class="nav-previous">%link</div>', __( '<span class="meta-nav">Previous post</span>', 'forefront' ) );
			next_post_link( '<div class="nav-next">%link</div>', __( 'Next post', 'forefront' ) );

		elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages
			if ( get_next_posts_link() )
	?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'forefront' ) ); ?></div>

	<?php
			if ( get_previous_posts_link() )
	?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'forefront' ) ); ?></div>
	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // forefront_content_nav

if ( ! function_exists( 'forefront_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function forefront_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<p><?php _e( 'Pingback:', 'forefront' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'forefront' ), '<span class="edit-link">', '<span>' ); ?></p>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<span class="comment-author-avatar"><?php echo get_avatar( $comment, 48 ); ?></span>
				<cite class="fn"><?php comment_author_link(); ?></cite>
			</div><!-- .comment-author .vcard -->

			<div class="comment-content">
				<?php comment_text(); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'forefront' ); ?></p>
				<?php endif; ?>
			</div>

			<div class="comment-meta commentmetadata">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'forefront' ), get_comment_date(), get_comment_time() ); ?>
					</time>
				</a>

				<?php
					comment_reply_link( array_merge( $args,array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					) ) );
				?>

				<?php edit_comment_link( __( 'Edit', 'forefront' ), '<span class="edit-link">', '<span>' ); ?>
			</div><!-- .comment-meta .commentmetadata -->
		</article><!-- #comment-## -->

	<?php
	endif;
}
endif; // ends check for forefront_comment()

if ( ! function_exists( 'forefront_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function forefront_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) :
		printf( __( '<span class="sticky-post">Sticky</span><span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'forefront' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'forefront' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	else :
		printf( __( '<span class="entry-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'forefront' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'forefront' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	endif;
}
endif;
if ( ! function_exists( 'forefront_posted_on_home' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function forefront_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) :
		printf( __( '<span class="sticky-post">Sticky</span><span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'forefront' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'forefront' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	else :
		printf( __( '<span class="entry-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'forefront' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'forefront' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	endif;
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function forefront_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so forefront_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so forefront_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in forefront_categorized_blog
 */
function forefront_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'forefront_category_transient_flusher' );
add_action( 'save_post', 'forefront_category_transient_flusher' );