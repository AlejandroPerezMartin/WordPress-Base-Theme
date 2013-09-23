<?php
/*
 * The theme header
 *
 * Displays <head> section
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title>
<?php
global $page, $paged;

wp_title( '|', true, 'right' );

bloginfo( 'name' );

$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";

if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
?>
</title>
<!-- Meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="<?php the_author(); ?>">
<meta name="copyright" content="<?php echo date('Y') ?>">
<meta name="description" content="<?php bloginfo( 'description' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Google+ Profile -->
<link rel="author" href="https://plus.google.com/1234...567/">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" sizes="16x16" />
<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" sizes="16x16" />
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/images/apple-favicon.png" />
<!-- Stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!-- Wordpress generated code -->
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
    <header>
        <h1><a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <h2><?php bloginfo( 'description' ); ?></h2>
    </header>
        <?php wp_nav_menu( array( 'container' => 'nav', 'theme_location' => 'primary' ) ); ?>
