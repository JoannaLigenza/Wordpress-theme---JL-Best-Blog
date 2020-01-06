<?php 
    // Change 'standard' archive title - modyfying wordpress get_the_archive_title() function
    function myfirsttheme_set_archive_title() {
        $title = __( 'Archives' );
 
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            /* translators: Author archive title. %s: Author name. */
            $title = sprintf( __( 'Author: %s' ), esc_html( get_the_author() ) );
        } elseif ( is_year() ) {
            /* translators: Yearly archive title. %s: Year. */
            $title = sprintf( __( 'Year: %s' ), esc_html( get_the_date( _x( 'Y', 'yearly archives date format' ) ) ) );
        } elseif ( is_month() ) {
            /* translators: Monthly archive title. %s: Month name and year. */
            $title = sprintf( __( 'Month: %s' ), esc_html( get_the_date( _x( 'F Y', 'monthly archives date format' ) ) ) );
        } elseif ( is_day() ) {
            /* translators: Daily archive title. %s: Date. */
            $title = sprintf( __( 'Day: %s' ), esc_html( get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) ) );
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            single_term_title( '', false );
        }
 
        return apply_filters( 'get_the_archive_title', $title );
    }
?>

<?php
    get_header( 'archive' );
?>

<div class="content">
    <!-- Archive title -->
    <h1 class="taxonomy-title container">
        <?php echo esc_html( myfirsttheme_set_archive_title() ); ?>
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
        <main class="main-content--section">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $imagePosition = get_theme_mod( 'front-page-and-archive-image' );
                        echo "<section class='article-section image-".$imagePosition."'>";
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
                                        echo "</div></a>" ;
                                        echo "<article class='article'>";
                                    } else {
                                        echo the_post_thumbnail( 'medium' );
                                        echo "</div></a>" ;
                                        echo "<article class='article article-padding'>";
                                    }
                            } else {
                                echo "<article class='article'>";
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
                            echo "</article>";
                        echo "</section>";
                    endwhile;
                    the_posts_pagination(array( 'mid_size' => 2 ));
                else :
                    _e( '<p>No content yet, write some :)</p>', 'myfirsttheme' );
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