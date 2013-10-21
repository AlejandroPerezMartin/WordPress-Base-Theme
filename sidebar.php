<?php
 /*
  * 
  */
?>

</section><!-- #content -->

<aside>
    <?php
    /* Primary sidebar is shown if it's active */
    if( is_active_sidebar( 'primary-sidebar' ) ) : ?>
    <ul>
        <?php dynamic_sidebar( 'primary-sidebar' ); ?>
    </ul>
    <?php
    /* If there is no sidebar, a default one is shown */
    else: ?>
    <ul>
        <li>
            <h3><?php _e( 'Search', 'base' ); ?></h3>
            <ul><?php get_search_form(); ?></ul>
        </li>
        <li>
            <h3><?php _e( 'Archives', 'base' ); ?></h3>
            <ul><?php get_archives( 'monthly' ); ?></ul>
        </li>
        <li>
            <h3><?php _e( 'Meta', 'base' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
    </ul>
    <?php endif; ?>
</aside>
