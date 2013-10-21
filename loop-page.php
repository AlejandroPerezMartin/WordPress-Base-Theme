<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <?php if( is_front_page() ) : ?>
            <h2><?php the_title(); ?></h2>
        <?php else: ?>
            <h1><?php the_title(); ?></h1>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div><!-- .post-content -->

        <?php wp_link_pages( array( 'before' => '<nav>' . __( 'Páginas:', 'starkers' ), 'after' => '</nav>' ) ); ?>

    </article>

    <?php comments_template( '', true ); ?>

<?php endwhile; ?>
