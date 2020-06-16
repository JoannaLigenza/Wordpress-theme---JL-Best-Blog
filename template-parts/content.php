<?php 
function jlbestblog_get_settings( $option ) {
    $var = '';
    if ( is_single() ) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-single', false );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-single', false );
            return $var;
        } else if ( $option === 'display-image' ) {
            $var = get_theme_mod( 'post-image-single', true);
            return $var;
        } else if ( $option === 'meta' ) {
            $var = get_theme_mod( 'post-meta-single', true );
            return $var;
        }
    }
    if ( is_page() ) {
        if ( $option === 'left-column' ) {
            $var = get_theme_mod( 'left-column-single-page', false );
            return $var;
        } else if ( $option === 'right-column' ) {
            $var = get_theme_mod( 'right-column-single-page', false );
            return $var;
        } else if ( $option === 'display-image' ) {
            $var = get_theme_mod( 'page-image', true);
            return $var;
        } else if ( $option === 'meta' ) {
            $var = get_theme_mod( 'page-meta', true );
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
                    $displayImage = jlbestblog_get_settings( 'display-image' );
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'article article-single' ); ?>>
                    <?php
                        if ( has_post_thumbnail() ) {
                            if ( $displayImage ) {
                                echo "<div class='image-container image-container-above'><a href='".esc_url( get_permalink() )."'>" ;
                                $imageWidth = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                                $maxWidth = $imageWidth[1];
                                if ($maxWidth > 1200) {
                                    $maxWidth = 1200;
                                }
                                echo esc_html( the_post_thumbnail( 'full', array( 
                                    'sizes' => '(max-width: '.$maxWidth.'px) 100vw, '.$maxWidth.'px',
                                    'alt' => 'post-image',
                                    ) ) );
                                echo "</a></div>" ;
                                echo "<section class='section'>";
                            }       
                        } else {
                            echo "<section class='section'>";
                        } ?>
                        <h2><a href='<?php echo esc_url( get_permalink() ); ?>'> <?php echo esc_html( get_the_title() ); ?> </a></h2>
                        <?php
                        if ( jlbestblog_get_settings( 'meta' ) ) {
                            $author_id = get_the_author_meta('ID');
                            $date = get_the_date( 'Y/m' ); ?>
                            <?php if ( is_single() ) : ?>
                            <div class="post-categories">
                                <?php the_category( ' ' ); ?>
                            </div>
                            <?php endif; ?>
                            <div class='post-meta'>
                                <div class='meta-author'><a href='<?php echo esc_url( get_author_posts_url($author_id) ) ?>'> <?php echo esc_html( get_the_author() ) ?> </a></div>
                                <div class='meta-date'><a href='<?php echo esc_url( get_home_url()."/".$date) ?>'> <?php echo esc_html( get_the_time('j-m-Y') ) ?> </a></div>
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
            else : ?>
                <p><?php esc_html_e( 'No content yet', 'jl-best-blog' ); ?></p>
            <?php endif; 
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