        <footer class="footer">
            <div class="container">
                <!-- Footer sidebars -->
                <div class="footer-sidebars-section">
                    <!-- sidebar 1 -->
                    <?php
                        if (get_theme_mod( 'footer-column-1' )) { ?>
                            <div class="footer-column">
                                <?php get_sidebar( 'footer-1' ); ?>
                            </div>
                        <?php }
                    ?>
                    <!-- sidebar 2 -->
                    <?php
                        if (get_theme_mod( 'footer-column-2' )) { ?>
                            <div class="footer-column">
                                <?php get_sidebar( 'footer-2' ); ?>
                            </div>
                        <?php }
                    ?>
                    <!-- sidebar 3 -->
                    <?php
                        if (get_theme_mod( 'footer-column-3' )) { ?>
                            <div class="footer-column">
                                <?php get_sidebar( 'footer-3' ); ?>
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
                        <a href="<?php echo get_theme_mod( 'social-icon-facebook' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/facebook-icon.png' ?>" alt="facebook-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- instagram icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-instagram' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-instagram' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/instagram-icon.png' ?>" alt="instagram-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- twitter icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-twitter' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-twitter' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/twitter-icon.png' ?>" alt="twitter-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- pinterest icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-pinterest' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-pinterest' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/pinterest-icon.png' ?>" alt="pinterest-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- youtube icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-youtube' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-youtube' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/youtube-icon.png' ?>" alt="youtube-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- whatsapp icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-whatsapp' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-whatsapp' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/whatsapp-icon.png' ?>" alt="whatsapp-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- messenger icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-messenger' ) !== "") { ?>
                        <a href="<?php echo get_theme_mod( 'social-icon-messenger' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/messenger-icon.png' ?>" alt="messenger-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    <!-- linkedin icon -->
                    <?php
                    if (get_theme_mod( 'social-icon-linkedin' ) !== "") { ?>
                        <a href="<?php get_theme_mod( 'social-icon-linkedin' ) ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/linkedin-icon.png' ?>" alt="linkedin-icon" class="social-icon">
                        </a>
                    <?php
                    } ?>
                    </div>
                    <?php
                }
                ?>  <!-- end of social icons section -->
                <p class="theme-author">Theme made by: <a href="https://love-coding.pl/en"><span class="theme-author-link">JL</span></a></p>
            </div>
            
        </footer>

<?php wp_footer(); ?> 
    </div>      <!-- main-container -->
</body>
</html>