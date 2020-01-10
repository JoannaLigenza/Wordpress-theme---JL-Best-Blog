<?php
    get_header();
?>

<div class="content">

<div class="main-content container">
    <!-- left column -->
    <?php
        if (get_theme_mod( 'left-column' )) { ?>
            <aside class="column column-left">
                <?php dynamic_sidebar( 'sidebar-left' ); ?>
            </aside>
        <?php }
    ?>
    <!-- main content -->
    <main class="main-content--section">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $imagePosition = get_theme_mod( 'front-page-and-archive-image' );
                    echo "<article class='article image-".esc_attr( $imagePosition )."'>";
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
                                        'alt' => 'post image'
                                        ) );
                                    echo "</a></div>" ;
                                    echo "<section class='section'>";
                                } else {
                                    echo the_post_thumbnail( 'medium' );
                                    echo "</a></div>" ;
                                    echo "<section class='section section-padding'>";
                                }
                        } else {
                            echo "<section class='section'>";
                        }
                        echo "<h2><a href='".get_permalink()."'>".esc_html( get_the_title() )."</a></h2>";
                        if (get_theme_mod( 'post-meta' )) {
                            $id = get_the_author_meta('ID');
                            $date = get_the_date( 'Y/m' );
                            echo "<div class='post-meta'>";
                                echo "<div class='meta-author'><a href='".esc_url( get_author_posts_url($id) )."'> ".esc_html( get_the_author() )." </a></div>";
                                echo "<div class='meta-date'><a href='".esc_url( get_home_url() )."/".$date."'> ".esc_html( get_the_time('j-m-Y') )."</a></div>";
                            echo "</div>";
                        }
                        the_excerpt('<p>', '</p>');
                        echo "</section>";
                    echo "</article>";
                endwhile;
                the_posts_pagination(array( 'mid_size' => 2 ));
            else : ?>
                <div class="nothing-found-search-results">
                    <h2 class="nothing-found-search-results-title">Nothing Found</h2>
                    <p class="nothing-found-search-results-message">
                        <?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'myfirsttheme' ) ?>
                    </p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; 
        ?>
    </main>
    <!-- right column -->
    <?php
        if (get_theme_mod( 'right-column' )) { ?>
            <aside class="column column-right">
                <?php dynamic_sidebar( 'sidebar-right' ); ?>
            </aside>
        <?php }
    ?>
</div>

</div>


<?php
    get_footer();
?>