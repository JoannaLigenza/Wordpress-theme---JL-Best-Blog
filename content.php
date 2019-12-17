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
                    echo "<section class='article-section'>";
                        if ( has_post_thumbnail() ) {
                            echo "<div class='image-container'><a href='".get_permalink()."'>" ;
                                echo the_post_thumbnail( 'medium' );
                            echo "</div></a>" ;
                            echo "<div><article class='article article-padding'>";
                        }
                        echo "<div><article class='article'>";
                        echo "<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>"; 
                        the_excerpt('<p>', '</p>');
                        echo "</article></div>";
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