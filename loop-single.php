<?php if(have_posts() ) while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <h1><?php the_title(); ?></h1>

        <div class="post-date">
            <?php the_date() ?>
        </div><!-- .post-date -->

        <div class="post-content">
            <?php the_content(); ?>
        </div><!-- .post-content -->

        <div class="post-metadata">
            <?php base_posted_in(); ?>
        </div><!-- .post-metadata -->

        <?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'base' ), 'after' => '</nav>' ) ); ?>
        
    </article>

    <?php comments_template( '', true ); ?>

<?php endwhile; ?>
