<?php
    get_header( 'post' );
?>

<div class="content">

<div class="main-content container">
    <!-- left column -->
    <?php
        if (get_theme_mod( 'left-column-single' )) { ?>
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
                    $imagePosition = get_theme_mod( 'post-image-single' );
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
                        } ?>
                        <h2><a href='<?php echo get_permalink(); ?>'> <?php echo get_the_title(); ?> </a></h2>
                        <?php 
                        if (get_theme_mod( 'post-meta-single' )) {
                            $author = get_the_author();
                            $date = get_the_date( 'Y/m' ); ?>
                            <div class="post-categories">
                                <?php the_category( ' ' ); ?>
                            </div>
                            <div class='post-meta'>
                                <div class='meta-author'><a href='<?php echo get_home_url()."/author/".$author ?>'> <?php echo $author ?> </a></div>
                                <div class='meta-date'><a href='<?php echo get_home_url()."/".$date ?>'> <?php echo get_the_time('j-m-Y') ?> </a></div>
                            </div>
                            <?php
                        }
                        the_content('<article>', '</article>');
                        echo "</article>";
                    echo "</section>"; ?>
                    <!-- post navigation -->
                    <div class="prev-next-post-navigation">
                        <?php if ( get_previous_post() ) : ?>
                            <div class="prev-post-link post-link">
                                <?php previous_post_link('&laquo; %link', __( 'Previous', 'myfirsttheme')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_next_post() ) : ?>
                            <div class="next-post-link post-link">
                                <?php next_post_link('%link &raquo;', __( 'Next', 'myfirsttheme')); ?>
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
        if (get_theme_mod( 'right-column-single' )) { ?>
            <aside class="column column-right">
                <?php get_sidebar( 'right' ); ?>
            </aside>
        <?php }
    ?>
</div>


</div>



<?php
    get_footer();
?>