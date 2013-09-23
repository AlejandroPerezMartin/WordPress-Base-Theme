<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	// add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

  // Remove generator metatag
  remove_action('wp_head', 'wp_generator');

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Navegación principal', 'starkers' ),
	) );
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
    ?>
    <article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="autor-info">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
            &nbsp;&bull;&nbsp;<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) );?>">
            <?php
                    /* translators: 1: date, 2: time */
                    printf( __( '%1$s a las %2$s', 'starkers' ), get_comment_date("d/m/Y"),  get_comment_time("H:i") ); ?></a><?php edit_comment_link( __( '(Editar)', 'starkers' ), ' ' );
                ?>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <?php _e( '<span class="awaiting-moderation">(Esperando moderación)</span>', 'starkers' ); ?>
            <?php endif; ?>
        </div><!-- .author-info -->
        <div class="author-comment">
            <?php comment_text(); ?>
        </div><!-- .author-comment -->

            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
    ?>
    <article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Editar)', 'starkers'), ' ' ); ?></p>
    <?php
            break;
    endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Barra lateral derecha',
		'id' => 'primary-widget-area',
		'description' => 'Barra lateral derecha',
		'before_widget' => '<li id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => 'Pie de página',
		'id' => 'first-footer-widget-area',
		'description' => 'Pie de página',
		'before_widget' => '<li id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( '<span aria-hidden="true" class="icon-user"></span> Por <a href="%1$s" title="Ver todas las publicaciones de %2$s">%2$s</a>', get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author());
}
endif;

/* Shows date, tags and comments */
function post_info(){
	// Date
    printf( '<ul><li><span aria-hidden="true" class="icon-clock"></span> <time datetime="%1$s" pubdate>%2$s</time></a></li>', get_the_date('Y-m-d'), get_the_date() );
    // Category
    if ( count( get_the_category() ) ) :
    	printf( '<li><span aria-hidden="true" class="icon-folder-open"></span> %1$s</li>', get_the_category_list( ', ' ) );
    endif;

    // Tags
    $tags_list = get_the_tag_list( '', ', ' );
    if ( $tags_list ){
    	printf( '<li><span aria-hidden="true" class="icon-tag"></span> %1$s</li>', $tags_list );
    }

    // Comments
    $comments_num = get_comments_number(); // returns a numeric value
    if ( comments_open() ){
    	if ( $comments_num == 0 ){
        	$comments = "Sin comentarios";
        }
        elseif ( $comments_num > 1 ) {
        	$comments = $comments_num." comentarios";
        }
        else {
        	$comments = "1 comentario";
        }
        printf( '<li><span aria-hidden="true" class="icon-bubble"></span> <a href="%1$s" title="Ver comentarios">%2$s</a></li>', get_comments_link(), $comments );
    }
    printf('</ul>');
}

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// Credits: http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
class description_walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth, $args ){
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<span>';
           $append = '</span>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

           $item_output = $args->before;
           $item_output .= '<a'. $attributes .'>';
           $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
           $item_output .= $description.$args->link_after;
           $item_output .= '</a>';
           $item_output .= $args->after;

           $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
