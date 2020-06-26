<?php 
    get_header( 'archive' );
?>

<div class="content">
    <!-- Archive title -->
    <h1 class="taxonomy-title container">
        <?php echo esc_html( the_archive_title() ); ?>
    </h1>
    <!-- Archive description top -->
    <?php
        if (get_theme_mod( 'taxonomy-description' ) === "top" && $paged < 2 ) { 
            esc_html(the_archive_description( '<div class="taxonomy-description container">', '</div>' ) );
        }
    ?>
    <div class="main-content main-content-taxonomy container">
        <!-- left column -->
        <?php
            if (get_theme_mod( 'left-column-archive' )) { ?>
                <aside class="column column-left">
                    <?php dynamic_sidebar( 'sidebar-left' ); ?>
                </aside>
            <?php }
        ?>
        <!-- main content -->
        <main id="main-content--section"
            class="<?php if ( get_theme_mod( 'left-column-archive' ) && get_theme_mod( 'right-column-archive' ) ) {
                echo 'main-content-section main-content-two-sidebars';
            } else if ( get_theme_mod( 'left-column-archive' ) || get_theme_mod( 'right-column-archive' ) ) {
                echo 'main-content-section main-content-one-sidebar';
            } else if ( ! get_theme_mod( 'left-column-archive' ) && ! get_theme_mod( 'right-column-archive' ) ) {
                echo 'main-content-section main-content-no-sidebars';
            } ?>
    ">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $imagePosition = get_theme_mod( 'archive-image', 'above' );
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'article image-'.esc_attr( $imagePosition ) ); ?>>
                        <?php
                            if ( has_post_thumbnail() ) {
                                echo "<div class='image-container image-container-".esc_attr( $imagePosition )."'><a href='".esc_url( get_permalink() )."'>" ;
                                    if ($imagePosition === 'above') {
                                        $imageWidth = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                                        $maxWidth = $imageWidth[1];
                                        if ($maxWidth > 1200) {
                                            $maxWidth = 1200;
                                        }
                                        the_post_thumbnail( 'full', array( 
                                            // 'sizes' => '(max-width:320px) 145px, (max-width:800px) 220px, 1200',
                                            'sizes' => '(max-width: '.$maxWidth.') 100vw, '.$maxWidth.'px',
                                            'alt' => 'post image'
                                            ) );
                                        echo "</a></div>" ;
                                        echo "<section class='section full-article-content'>";
                                    } else {
                                        the_post_thumbnail( 'medium', array(
                                        'alt' => 'post-image'
                                    ) );
                                        echo "</a></div>" ;
                                        echo "<section class='section section-padding'>";
                                    }
                            } else {
                                echo "<section class='section'>";
                            }
                            echo "<h2><a href='".esc_url( get_permalink() )."'>".esc_html( get_the_title() )."</a></h2>";
                            if (get_theme_mod( 'post-meta-archive' )) {
                                $author_id = get_the_author_meta('ID');
                                $date = get_the_date( 'Y/m' );
                                echo "<div class='post-meta'>";
                                    echo "<div class='meta-author'><a href='".esc_url( get_author_posts_url($author_id) )."'> ".esc_html( get_the_author() )." </a></div>";
                                    echo "<div class='meta-date'><a href='".esc_url( get_home_url() )."/".esc_url( $date )."'> ".esc_html( get_the_time('j-m-Y') )."</a></div>";
                                echo "</div>";
                            }
                            the_excerpt('<p>', '</p>');
                            echo "</section>";
                        echo "</article>";
                    endwhile;
                    the_posts_pagination(array( 'mid_size' => 2 ));
                else : ?>
                    <p><?php esc_html_e( 'No content yettt', 'jl-best-blog' ); ?></p>
                <?php
                endif; 
            ?>
        </main>
        <!-- right column -->
        <?php
            if (get_theme_mod( 'right-column-archive' )) { ?>
                <aside class="column column-right">
                    <?php dynamic_sidebar( 'sidebar-right' ); ?>
                </aside>
            <?php }
        ?>
    </div>
    <!-- Archive description bottom -->
    <?php
        if (get_theme_mod( 'taxonomy-description' ) === "bottom" && $paged < 2) { 
            esc_html( the_archive_description( '<div class="taxonomy-description container">', '</div>' ) );
        }
    ?>
</div>

<?php
    get_footer();
?>