<?php
    printf(
        '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
            <div>
                <input type="text" placeholder="'.__( 'Search for...', 'base' ).'" value="' . get_search_query() . '" name="s" id="s" />
                <input type="submit" id="searchsubmit" value="'. __( 'Search', 'base' ) .'" />
            </div>
        </form>'
    );
?>
