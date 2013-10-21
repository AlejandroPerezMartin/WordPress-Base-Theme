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
    <title><?php base_title(); ?></title>
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
    
    <section id="page">
        
        <header>
            
            <h1><a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <h2><?php bloginfo( 'description' ); ?></h2>
            
        </header>
        
        <?php wp_nav_menu( array( 'container' => 'nav', 'theme_location' => 'main-nav' ) ); ?>
        
        <section id="main">
            
            <section id="content">
