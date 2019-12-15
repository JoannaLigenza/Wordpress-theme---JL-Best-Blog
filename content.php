<div class="content">

<div class="main-content container">
    <!-- left column -->
    <?php
        if (get_theme_mod( 'left-column' )) { ?>
            <aside class="aside aside-left">
                aside
            </aside> 
        <?php }
    ?>
    <!-- main content -->
    <main class="main-content--section">
        <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); 
                    echo "<section>";
                    echo "<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>"; 
                    the_post_thumbnail(); 
                    the_excerpt('<p>', '</p>');
                    echo "</section>";
                endwhile; 
            else :
                echo '<p>No content</p>';
            endif; 
        ?>
    </main>
    <!-- right column -->
    <?php
        if (get_theme_mod( 'right-column' )) { ?>
            <aside class="aside aside-left">
                aside
            </aside> 
        <?php }
    ?>
</div>


</div>