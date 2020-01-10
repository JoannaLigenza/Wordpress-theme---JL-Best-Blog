<?php 
function myfirsttheme_get_settings( $option ) {
    $var = '';
    if ( is_single() ) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-single' );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-single' );
            return $var;
        } else if ( $option === 'imagePosition' ) {
            $var = get_theme_mod( 'post-image-single' );
            return $var;
        } else if ( $option === 'meta' ) {
            $var = get_theme_mod( 'post-meta-single' );
            return $var;
        }
    }
    if ( is_page() ) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-single-page' );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-single-page' );
            return $var;
        } else if ( $option === 'imagePosition' ) {
            $var = get_theme_mod( 'page-image' );
            return $var;
        } else if ( $option === 'meta' ) {
            $var = get_theme_mod( 'page-meta' );
            return $var;
        }
    }
}

?>

    <!-- left column -->
    <?php
        if ( myfirsttheme_get_settings( 'left-column' ) ) { ?>
            <aside class="column column-left">
                <?php dynamic_sidebar( 'sidebar-left' ); ?>
            </aside>
        <?php }
    ?>
    <!-- main content -->
    <main id="main-content--section"
            class="<?php if ( myfirsttheme_get_settings( 'left-column' ) && myfirsttheme_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-two-sidebars';
            } else if ( myfirsttheme_get_settings( 'left-column' ) || myfirsttheme_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-one-sidebar';
            } else if ( ! myfirsttheme_get_settings( 'left-column' ) && ! myfirsttheme_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-no-sidebars';
            } ?>
    ">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $imagePosition = myfirsttheme_get_settings( 'imagePosition' );
                    echo "<section class='article-section image-".esc_attr( $imagePosition )."'>";
                        if ( has_post_thumbnail() ) {
                            echo "<div class='image-container image-container-".esc_attr( $imagePosition )."'><a href='".get_permalink()."'>" ;
                                if ($imagePosition === 'above') {
                                    $imageWidth = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                                    $maxWidth = $imageWidth[1];
                                    if ($maxWidth > 1200) {
                                        $maxWidth = 1200;
                                    }
                                    echo the_post_thumbnail( 'full', array( 
                                        // 'sizes' => '(max-width:320px) 145px, (max-width:800px) 220px, 1200',
                                        'sizes' => '(max-width: '.$maxWidth.') 100vw, '.$maxWidth.'px',
                                        'alt' => 'post-image',
                                        // 'srcset' => $imageWidthFull[0].' '.$imageWidthFull[1].'w,'. $imageWidthMedium[0].' 400w'
                                        ) );
                                    echo "</a></div>" ;
                                    echo "<article class='article'>";
                                } else {
                                    echo the_post_thumbnail( 'medium', array(
                                        'alt' => 'post-image'
                                    ) );
                                    echo "</a></div>" ;
                                    echo "<article class='article article-padding'>";
                                }
                        } else {
                            echo "<article class='article'>";
                        } ?>
                        <h2><a href='<?php echo get_permalink(); ?>'> <?php echo esc_html( get_the_title() ); ?> </a></h2>
                        <?php
                        if ( myfirsttheme_get_settings( 'meta' ) ) {
                            $id = get_the_author_meta('ID');
                            $date = get_the_date( 'Y/m' ); ?>
                            <?php if ( is_single() ) : ?>
                            <div class="post-categories">
                                <?php the_category( ' ' ); ?>
                            </div>
                            <?php endif; ?>
                            <div class='post-meta'>
                                <div class='meta-author'><a href='<?php echo esc_url( get_author_posts_url($id) ) ?>'> <?php echo esc_html( get_the_author() ) ?> </a></div>
                                <div class='meta-date'><a href='<?php echo esc_url( get_home_url() )."/".$date ?>'> <?php echo esc_html( get_the_time('j-m-Y') ) ?> </a></div>
                            </div>
                            <?php
                        }
                        if ( is_single() || is_page() ) {
                                the_content('<article>', '</article>');
                            } else {
                                the_excerpt('<p>', '</p>');
                            }
                        echo "</article>";
                    echo "</section>";?>
                    <!-- post navigation -->
                    <div class="prev-next-post-navigation">
                        <?php if ( get_previous_post() ) : ?>
                            <div class="prev-post-link post-link">
                                <?php previous_post_link('&laquo; %link', __('Previous', 'myfirsttheme')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_next_post() ) : ?>
                            <div class="next-post-link post-link">
                                <?php next_post_link('%link &raquo;', __('Next', 'myfirsttheme')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php 
                    // display comments
                    if ( ! post_password_required() ) {
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                endwhile;
            else :
                _e( '<p>No content yet, write some :)</p>', 'myfirsttheme' );
            endif; 
        ?>
    </main>
    <!-- right column -->
    <?php
        if ( myfirsttheme_get_settings( 'right-column' ) ) { ?>
            <aside class="column column-right">
                <?php dynamic_sidebar( 'sidebar-right' ); ?>
            </aside>
        <?php }
    ?>