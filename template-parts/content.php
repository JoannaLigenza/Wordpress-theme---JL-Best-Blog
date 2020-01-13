<?php 
function jlbestblog_get_settings( $option ) {
    $var = '';
    if ( is_single() ) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-single' );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-single' );
            return $var;
        } else if ( $option === 'imagePosition' ) {
            $var = get_theme_mod( 'post-image-single', 'above' );
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
            $var = get_theme_mod( 'page-image', 'above' );
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
        if ( jlbestblog_get_settings( 'left-column' ) ) { ?>
            <aside class="column column-left">
                <?php dynamic_sidebar( 'sidebar-left' ); ?>
            </aside>
        <?php }
    ?>
    <!-- main content -->
    <main id="main-content--section"
            class="<?php if ( jlbestblog_get_settings( 'left-column' ) && jlbestblog_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-two-sidebars';
            } else if ( jlbestblog_get_settings( 'left-column' ) || jlbestblog_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-one-sidebar';
            } else if ( ! jlbestblog_get_settings( 'left-column' ) && ! jlbestblog_get_settings( 'right-column' ) ) {
                echo 'main-content-section main-content-no-sidebars';
            } ?>
    ">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $imagePosition = jlbestblog_get_settings( 'imagePosition' );
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'article image-'.esc_attr( $imagePosition ) ); ?>>
                    <?php
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
                                        'sizes' => '(max-width: '.$maxWidth.'px) 100vw, '.$maxWidth.'px',
                                        'alt' => 'post-image',
                                        // 'srcset' => $imageWidthFull[0].' '.$imageWidthFull[1].'w,'. $imageWidthMedium[0].' 400w'
                                        ) );
                                    echo "</a></div>" ;
                                    echo "<section class='section'>";
                                } else {
                                    echo the_post_thumbnail( 'medium', array(
                                        'alt' => 'post-image'
                                    ) );
                                    echo "</a></div>" ;
                                    echo "<section class='section section-padding'>";
                                }
                        } else {
                            echo "<section class='section'>";
                        } ?>
                        <h2><a href='<?php echo get_permalink(); ?>'> <?php echo esc_html( get_the_title() ); ?> </a></h2>
                        <?php
                        if ( jlbestblog_get_settings( 'meta' ) ) {
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
                                the_content('<p>', '</p>');
                            } else {
                                the_excerpt('<p>', '</p>');
                            }
                        echo "</section>";
                        // post tags
                        if ( is_single() &&  get_theme_mod( 'display-tags-in-post', true ) ) {
                            the_tags( '<div class="tag-label">Tags:</div> <span class="tag-list">', ', ', '</span>' );
                        }
                    echo "</article>";
                    // post page numbers
                        wp_link_pages( array( 
                            'before' => '<div class="page-numbers-container"> Preview page', 
                            'after' => ' Next Page</div>',
                            ) );
                    ?>
                    <!-- post navigation -->
                    <div class="prev-next-post-navigation">
                        <?php if ( get_previous_post() ) : ?>
                            <div class="prev-post-link post-link">
                                <?php previous_post_link('&laquo; %link', __('Previous', 'jl-best-blog')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_next_post() ) : ?>
                            <div class="next-post-link post-link">
                                <?php next_post_link('%link &raquo;', __('Next', 'jl-best-blog')); ?>
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
                _e( '<p>No content yet, write some :)</p>', 'jl-best-blog' );
            endif; 
        ?>
    </main>
    <!-- right column -->
    <?php
        if ( jlbestblog_get_settings( 'right-column' ) ) { ?>
            <aside class="column column-right">
                <?php dynamic_sidebar( 'sidebar-right' ); ?>
            </aside>
        <?php }
    ?>