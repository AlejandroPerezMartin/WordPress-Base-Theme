<?php
/**
 * Base Theme functions
 */

add_action( 'after_setup_theme', 'base_theme_setup' );

if ( ! function_exists( 'base_theme_setup' ) ):
/**
 * Sets up Base Theme (features and registers)
 */
function base_theme_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
        
        // Remove unused meta tags
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        
        // Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'base', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) require_once( $locale_file );
        
        /* Register sidebars */
        add_action( 'widgets_init', 'base_widgets_init' );
     
}
endif;


if ( ! function_exists( 'base_theme_comments' ) ) :
/**
 * Comments template
 */
function base_theme_comments() {
}
endif;

/**
 * Register widgets areas
 */
function base_widgets_init() {
        
        // Navigation menus in header and footer
	register_nav_menus( array(
		'main-nav' => __( 'Main navigation', 'base' ),
		'footer-nav' => __( 'Footer navigation', 'base' )
	) );
        
	// Sidebar widgets area
	register_sidebar( array(
		'name' => 'Primary sidebar',
		'id' => 'primary-sidebar',
		'description' => 'Primary sidebar widgets',
		'before_widget' => '<li id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Footer widgets area
	register_sidebar( array(
		'name' => 'Primary footer',
		'id' => 'primary-footer',
		'description' => 'Primary footer widgets',
		'before_widget' => '<li id="%1$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}

if ( ! function_exists( 'base_post_comments' ) ) :
/**
 * Display the number of comments on post
 */
function base_post_comments(){
    $comments_num = get_comments_number(); // returns a numeric value
    if ( comments_open() ){
        if ( $comments_num == 0 ){
            $comments = __( 'No comments', 'base' );
        }
        elseif ( $comments_num > 1 ) {
            $comments = $comments_num .  __( ' comments', 'base' );
        }
        else {
            $comments = __('1 comment', 'base');
        }
        printf( '<a href="%1$s" title="%2$s">%3$s</a>',
                get_comments_link(), 
                sprintf( esc_attr__( 'See al comments', 'base') ),
                $comments
        );
    }
}
endif;

if ( ! function_exists( 'base_posted_in' ) ) :
/**
 * Prints information of the current post (author, categories and tags)
 */
function base_posted_in() {
    if( get_the_tag_list() ) {
        printf( __('Posted by %1$s', 'base'),
            sprintf( '<a href="%1$s" title="%2$s">%3$s</a> %4$s %5$s',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'base' ), get_the_author() ),
                get_the_author(),
                sprintf( esc_attr__( 'in %s', 'base' ), get_the_category_list( ', ') ),
                sprintf( esc_attr__( 'and tagged with %s', 'base' ), get_the_tag_list( '', ', ', '.' ) )
            )
       );
    }
}
endif;

if ( ! function_exists( 'base_title' ) ) :
/**
 * Prints title tag
 */
function base_title() {
    global $page, $paged;

    wp_title( '|', true, 'right' );

    bloginfo( 'name' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
}
endif;
