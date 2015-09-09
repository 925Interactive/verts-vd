<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:


if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css' );

// END ENQUEUE PARENT ACTION



/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'forefront' ),
		'placeholder' => __( 'placeholder', 'verts' )
	) );




    /**
 * Register widgetized area and update sidebar with default widgets
 */

	register_sidebar( array(
		'name'          => __( 'block-action', 'forefront' ),
		'id'            => 'blockaction',
		'before_widget' => '<div id="action-w%1$s" class="action-w%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="">',
		'after_title'   => '</h1>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'block-social', 'forefront' ),
		'id'            => 'blocksocial',
		'before_widget' => '<div id="socialmedia" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'block-slider', 'forefront' ),
		'id'            => 'blockslider',
		'before_widget' => '<div id="slider" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'block-search', 'forefront' ),
		'id'            => 'blocksearch',
		'before_widget' => '<div id="search" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="">',
		'after_title'   => '</h1>',
	) );


/** Fonction ajoutée de l'ancien site **/
/**
 * Allows a non super-admin user to manage other users in his own sub-blog
 */
function mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
    foreach( $caps as $key => $capability ){
 
        if( $capability != 'do_not_allow' )
            continue;
 
        switch( $cap ) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }
 
    return $caps;
}
add_filter( 'map_meta_cap', 'mc_admin_users_caps', 1, 4 );
remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');
 
/**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
function mc_edit_permission_check() {
    global $current_user, $profileuser;
 
    $screen = get_current_screen();
 
    get_currentuserinfo();
 
    if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile

        if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
            wp_die( __( 'You do not have permission to edit this user.' ) );
        } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
            wp_die( __( 'You do not have permission to edit this user.' ) );
        }
    }
 
}
add_filter( 'admin_head', 'mc_edit_permission_check', 1, 4 );

/**
 * Displays the needed social networks and contact methods
 */
function my_new_contactmethods( $contactmethods ) {
    $contactmethods['public_mail'] = 'Adresse mail publique';

    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';

    $contactmethods['instagram'] = 'Instagram';


    $contactmethods['telephone'] = 'Telephone';
    $contactmethods['adresse'] = 'Adresse';
    $contactmethods['npa_ville'] = 'NPA et Localité';


    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['googleplus']);
    unset($contactmethods['jabber']);
    unset($contactmethods['dbem_phone']);
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);


/**
 * Add an extra checkbox in the user profile form so that the admin can decide when the member appears in front end
 */
function my_show_extra_profile_fields( $user ) { ?>
<h3>Membres</h3>
    <table class="form-table">
<tr>
	    <th><label for="membre">Inclure cet utilisateur de la liste des membres</label></th>
	    <td>
	    <input type="checkbox" name="membre" id="membre" value="yes" <?php if (esc_attr( get_the_author_meta( 'membre', $user->ID ) ) == 'yes') { echo 'checked'; } ?> class="checkbox double" /><br />
		<span class="description">Cocher si cet utilisateur doit s'afficher publiquement dans la liste des membres.</span>
	    </td>
</tr>
</table>
<?php }
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );


/**
 * Tell the system to save whether or not the user has to appear in front end as a member
 */
function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
	return false;

    if (isset($_POST['membre'])) {	
	update_user_meta( $user_id, 'membre', $_POST['membre'] );
    } else {
	update_user_meta( $user_id, 'membre', 0);
    }
}
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

/**
 * Rewrite rule to access a given user with mysite.com/membres/username
 */
function verts_rewrite_rules( $wp_rewrite )
{
    $new_rules = array();
    
    $new_rules['membres/(.+?)/?$'] = 'index.php?author_name='.$wp_rewrite->preg_index(1);
    
    //​ Add the new rewrite rule into the top of the global rules array
    $wp_rewrite->rules = $new_rules  + $wp_rewrite->rules ;
    return $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'verts_rewrite_rules'); 

/**
 * Build an array of users alphabetically sorted
 */
function verts_get_members() {
    global $wpdb;
    $allusers = $wpdb->get_results("SELECT u.ID, u.display_name FROM $wpdb->users u, $wpdb->usermeta m WHERE u.ID =m.user_id AND m.meta_key='membre' and m.meta_value='yes'");
    foreach ( $allusers as $u ) {

	$lastname = get_the_author_meta('last_name', $u->ID);
	$firstname = get_the_author_meta('first_name', $u->ID);
	$user_keyname = $lastname.' '.$firstname;
	$users_alphabet[substr($user_keyname, 0, 1)][$user_keyname] = $u->ID;
    }

    ksort($users_alphabet);
    return $users_alphabet;
}
 
function the_breadcrumb () {
     
    // Settings
    $separator  = '&gt;';
    $id         = 'breadcrumbs';
    $class      = 'breadcrumbs';
    $home_title = 'Accueil';
     
    // Get the query & post information
    global $post,$wp_query;
    $category = get_the_category();
     
    // Build the breadcrums
    echo '<ul id="' . $id . '" class="' . $class . '">';
     
    // Do not display on the homepage
    if ( !is_front_page() ) {
         
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
         
        if ( is_single() ) {
             
            // Single post (Only display the first category)
            echo '<li class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a class="bread-cat bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '" href="' . get_category_link($category[0]->term_id ) . '" title="' . $category[0]->cat_name . '">' . $category[0]->cat_name . '</a></li>';
            echo '<li class="separator separator-' . $category[0]->term_id . '"> ' . $separator . ' </li>';
            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
             
        } else if ( is_category() ) {
             
            // Category page
            echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';
             
        } else if ( is_page() ) {
             
            // Standard page
            if( $post->post_parent ){
                 
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                 
                // Get parents in the right order
                $anc = array_reverse($anc);
                 
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                 
                // Display parent pages
                echo $parents;
                 
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                 
            } else {
                 
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                 
            }
             
        } else if ( is_tag() ) {
             
            // Tag page
             
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
             
            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
         
        } elseif ( is_day() ) {
             
            // Day archive
             
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
             
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
             
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
             
        } else if ( is_month() ) {
             
            // Month Archive
             
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
             
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
             
        } else if ( is_year() ) {
             
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
             
        } else if ( is_author() ) {
             
            // Auhor archive
             
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
             
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
         
        } else if ( get_query_var('paged') ) {
             
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
             
        } else if ( is_search() ) {
         
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
         
        } elseif ( is_404() ) {
             
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
         
    }
     
    echo '</ul>';
     
}
 
add_filter('get_search_form', 'new_search_button');
function new_search_button($text) {
$text = str_replace('value="Rechercher"', 'value="GO!"', $text);
return $text;
}

