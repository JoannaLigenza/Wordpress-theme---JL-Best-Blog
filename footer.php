        <footer class="footer">
            <div class="container">
                <!-- Footer sidebars -->
                <div class="footer-sidebars-section">
                    <!-- sidebar 1 -->
                    <?php
                        if ( get_theme_mod( 'footer-column-1' ) ) { ?>
                            <div class="footer-column">
                                <?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
                            </div>
                        <?php }
                    ?>
                    <!-- sidebar 2 -->
                    <?php
                        if (get_theme_mod( 'footer-column-2' )) { ?>
                            <div class="footer-column">
                                <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
                            </div>
                        <?php }
                    ?>
                    <!-- sidebar 3 -->
                    <?php
                        if (get_theme_mod( 'footer-column-3' )) { ?>
                            <div class="footer-column">
                                <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
                            </div>
                        <?php }
                    ?>
                </div>
                <!-- social icons section -->
                <?php 
                if (get_theme_mod( 'footer-social-icon' )) { ?>
                    <div class="social-icon-section">
                    <!-- facebook icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-facebook' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-facebook' ) ); ?>">
                            <div class="social-icon-image facebook-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- instagram icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-instagram' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-instagram' ) ); ?>">
                            <div class="social-icon-image instagram-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- twitter icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-twitter' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-twitter' ) ); ?>">
                            <div class="social-icon-image twitter-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- pinterest icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-pinterest' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-pinterest' ) ); ?>">
                            <div class="social-icon-image pinterest-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- youtube icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-youtube' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-youtube' ) ); ?>">
                            <div class="social-icon-image youtube-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- whatsapp icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-whatsapp' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-whatsapp' ) ); ?>">
                            <div class="social-icon-image whatsapp-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- messenger icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-messenger' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-messenger' ) ); ?>">
                            <div class="social-icon-image messenger-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    <!-- linkedin icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-linkedin' ) !== "") { ?>
                        <a href="<?php echo esc_attr( get_theme_mod( 'social-icon-linkedin' ) ); ?>">
                            <div class="social-icon-image linked-icon"> </div>
                        </a>
                    <?php
                    } ?>
                    </div>
                    <?php
                }
                ?>  <!-- end of social icons section -->
                <p class="footer-link"><small><?php _e( 'Theme made by: ', 'myfirsttheme') ?></small><a href="<?php echo esc_url( 'https://love-coding.pl/en' ); ?>" class="footer-theme-link">JL</a><small>, 
                    <?php _e( 'used by: ', 'myfirsttheme') ?> <a href="<?php echo esc_url( home_url() ); ?>" class="footer-theme-link"><?php echo bloginfo('name') ?></a></small></p>
            </div>
            
        </footer>

<?php wp_footer(); ?> 
    </div>      <!-- main-container -->
</body>
</html>