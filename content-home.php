<div class="content">

<div class="main-content container">
    <!-- left column -->
    <?php
        if (get_theme_mod( 'left-column' )) { ?>
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
                    $imagePosition = get_theme_mod( 'front-page-and-archive-image' );
                    echo "<section class='article-section image-".$imagePosition."'>";
                        if ( has_post_thumbnail() ) {
                            echo "<div class='image-container image-container-".$imagePosition."'><a href='".get_permalink()."'>" ;
                                if ($imagePosition === 'above') {
                                    echo the_post_thumbnail( 'full', array( 'sizes' => '(max-width:320px) 145px, (max-width:425px) 220px, 500px' ) );
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
                        echo "<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>";
                        if (get_theme_mod( 'post-meta' )) {
                            $id = get_the_author_meta('ID');
                            $date = get_the_date( 'Y/m' );
                            echo "<div class='post-meta'>";
                                echo "<div class='meta-author'><a href='?author=".$id."'> ".get_the_author()." </a></div>";
                                echo "<div class='meta-date'><a href='".get_home_url()."/index.php/".$date."'> ".get_the_time('j-m-Y')."</a></div>";
                            echo "</div>";
                        }
                        the_excerpt('<p>', '</p>');
                        echo "</article>";
                    echo "</section>";
                endwhile;
                the_posts_pagination(array( 'mid_size' => 2 ));
            else :
                echo '<p>No content</p>';
            endif; 
        ?>
    </main>
    <!-- right column -->
    <?php
        if (get_theme_mod( 'right-column' )) { ?>
            <aside class="column column-right">
                <?php get_sidebar( 'right' ); ?>
            </aside>
        <?php }
    ?>
</div>


</div>
