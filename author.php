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

get_header(); 

$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
if (is_object($author)) {
    $authorId = $author->ID;
} else { $authorId = get_query_var( 'author' ) ; }
 
$avatar = get_author_image_url($authorId); 
$name = get_the_author_meta('display_name', $authorId);
$html = '<img src="'.$avatar.'" alt="Une photo de '.$name.'"/>';

get_header(); ?>

<div class="hero <?php echo forefront_additional_class(); ?>">
<figure>
		<?php
					{
		echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default.jpg" />';
		} ?>	
					<div>
						<div>
							<div>
								<!--<h1 class="page-title"><?php the_title(); ?></h1>-->
								<h1 class="page-title"><?php the_author_meta( 'display_name', $authorId ); ?></h1>
							</div>
						</div>
					</div>
				</figure>

	</div>		
			<!-- <div class="action-div"> <?php dynamic_sidebar( 'blockaction' ); //Sidebar pour dont contact et newsletter  ?> </div> -->


	<?php while ( have_posts() ) : the_post(); ?>

		
	<?php endwhile; ?>

	<?php rewind_posts(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
<span class="blog-thumbnail">
		
				<?php
		echo $html;    // Affiche l'image du Memebre.. cf 
		echo '<div class=\'author-details\'>';
		 echo '<div class=\'nommembre\'>';

		 if (get_the_author_meta( 'first_name', $authorId )) { the_author_meta( 'first_name', $authorId ); echo ' '; } 
		if (get_the_author_meta( 'last_name', $authorId )) { the_author_meta( 'last_name', $authorId ); echo '</br>'; }
			
		echo '</div>' ;
		 echo '<div class=\'adressemembre\'>';
		if (get_the_author_meta( 'adresse', $authorId )) { the_author_meta( 'adresse', $authorId ); echo '</br>'; } 
		if (get_the_author_meta( 'npa_ville', $authorId )) { the_author_meta( 'npa_ville', $authorId ); echo '</br>';} 
		echo '</div>' ;
		echo '<div class=\'telmembre\'>';
		if (get_the_author_meta( 'telephone', $authorId )) { the_author_meta( 'telephone', $authorId ); echo '</br>';} 
		echo '</div>' ;
		echo '<div class=\'socialmembre\'>';
		echo '<div class=\'faceb\'>';
		if (get_the_author_meta( 'facebook', $authorId )) { echo '<a href="'; the_author_meta( 'facebook', $authorId ); echo '">Facebook</a></br>';} 
		echo '</div>' ;
echo '<div class=\'twit\'>';
		if (get_the_author_meta( 'twitter', $authorId )) { echo '<a href="'; the_author_meta( 'twitter', $authorId ); echo '">Twitter</a></br>';} 
		echo '</div>' ;
echo '<div class=\'urlweb\'>';
		if (get_the_author_meta( 'url', $authorId )) { echo '<a href="'; the_author_meta( 'url', $authorId ); echo '">Site web</a></br>';} 
echo '</div>' ;
echo '</div>' ;
echo '</div>' ;
		
				?>
				
		</span>







	<div class="author-description">
	<?php if ( get_the_author_meta( 'description', $authorId ) ) : ?>
			<p class="author-bio">
			<?php the_author_meta( 'description', $authorId ); ?>
		</p><!-- .author-bio -->
				<?php endif; ?>

	</div><!-- .author-description -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
