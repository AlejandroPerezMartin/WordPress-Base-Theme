        </section><!-- #main -->
        
        <footer>
            <?php
            // Primary sidebar is shown if it's active
            if( is_active_sidebar( 'primary-footer' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'primary-footer' ); ?>
            </ul>
            <?php endif; ?>
            
            <?php wp_nav_menu( array( 'container' => 'nav', 'theme_location' => 'footer-nav' ) ); ?>
            
        </footer>
        
    </section><!-- #page -->
    
</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>
