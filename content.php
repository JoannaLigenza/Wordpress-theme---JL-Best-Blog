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
    if (is_archive()) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-archive' );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-archive' );
            return $var;
        } else if ( $option === 'imagePosition' ) {
            $var = get_theme_mod( 'front-page-and-archive-image' );
            return $var;
        } else if ( $option === 'meta' ) {
            $var = get_theme_mod( 'post-meta' );
            return $var;
        }
    }
}

?>


    <!-- left column -->
    <?php
        if ( myfirsttheme_get_settings( 'left-column' ) ) { ?>
            <aside class="column column-left">
                <?php get_sidebar( 'left' ); ?>
            </aside>
        <?php }
    ?>
    <!-- main content -->
    <main class="main-content--section">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $imagePosition = myfirsttheme_get_settings( 'imagePosition' );
                    echo "<section class='article-section image-".$imagePosition."'>";
                        if ( has_post_thumbnail() ) {
                            echo "<div class='image-container image-container-".$imagePosition."'><a href='".get_permalink()."'>" ;
                                if ($imagePosition === 'above') {
                                    $imageWidth = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                                    $maxWidth = $imageWidth[1];
                                    if ($maxWidth > 1200) {
                                        $maxWidth = 1200;
                                    }
                                    echo the_post_thumbnail( 'full', array( 
                                        // 'sizes' => '(max-width:320px) 145px, (max-width:800px) 220px, 1200',
                                        'sizes' => '(max-width: '.$maxWidth.') 100vw, '.$maxWidth.'px',
                                        'alt' => 'post image',
                                        // 'srcset' => $imageWidthFull[0].' '.$imageWidthFull[1].'w,'. $imageWidthMedium[0].' 400w'
                                        ) );
                                    echo "</div></a>" ;
                                    echo "<article class='article'>";
                                } else {
                                    echo the_post_thumbnail( 'medium' );
                                    echo "</div></a>" ;
                                    echo "<article class='article article-padding'>";
                                }
                        } else {
                            echo "<article class='article'>";
                        } ?>
                        <h2><a href='<?php echo get_permalink(); ?>'> <?php echo get_the_title(); ?> </a></h2>
                        <?php
                        if (get_theme_mod( 'post-meta-single' )) {
                            $author = get_the_author();
                            $date = get_the_date( 'Y/m' ); ?>
                            <?php if ( is_single() ) : ?>
                            <div class="post-categories">
                                <?php the_category( ' ' ); ?>
                            </div>
                            <?php endif; ?>
                            <div class='post-meta'>
                                <div class='meta-author'><a href='<?php echo get_home_url()."/author/".$author ?>'> <?php echo $author ?> </a></div>
                                <div class='meta-date'><a href='<?php echo get_home_url()."/".$date ?>'> <?php echo get_the_time('j-m-Y') ?> </a></div>
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
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
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
                <?php get_sidebar( 'right' ); ?>
            </aside>
        <?php }
    ?>