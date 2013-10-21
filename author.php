<?php get_header(); ?>

<h1><?php printf( __( 'Posts by: %s', 'base' ), get_the_author() ); ?></h1>

<?php get_template_part( 'loop', 'author'); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
