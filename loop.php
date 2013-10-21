<?php if( have_posts() ) while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

        <div class="post-date">
            <?php the_date() ?>
        </div><!-- .post-date -->

        <div class="post-comments">
            <?php base_post_comments() ?>
        </div><!-- .post-comments -->

        <div class="post-content">
            <?php
            if( is_archive() || is_search() ) {
                the_excerpt();
            }
            else {
                the_content( __( 'Continue reading &rarr;', 'base' ) );
            }
            ?>
        </div><!-- .post-content -->

        <div class="post-metadata">
            <?php base_posted_in(); ?>
        </div><!-- .post-metadata -->

    </article>

<?php endwhile; ?>

<?php
    // Paginated links
    global $wp_query;
    // Get total number of pages
    $total_pages = $wp_query->max_num_pages;
    // Only paginate if we have more than one page
    if ( $total_pages > 1 )  {
        // Get the current page
        if ( !$current_page = get_query_var('paged') )
            $current_page = 1;
        // Structure of “format” depends on whether we’re using pretty permalinks
        $permalinks = get_option('permalink_structure');
        $format = empty( $permalinks ) ? '&page=%#%' : 'page/%#%/';
        echo paginate_links(array(
            'base' => get_pagenum_link(1).'%_%',
            'format' => $format,
            'current' => $current_page,
            'total' => $total_pages,
            'mid_size' => 2,
            'type' => 'list',
            'prev_text' => '&#x2190; Anterior',
            'next_text' => 'Siguiente &#x2192;'
        ));
    }
 ?>
