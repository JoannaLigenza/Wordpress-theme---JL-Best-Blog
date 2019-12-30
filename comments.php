
<?php
    /**
     * This is the template for displaying Comments.
     */

    if ( have_comments() ) : ?>
        <section class="comments-section">
            <header> 
                <h2 class="comments-title">
                    <?php 
                        $commentsNUmber = get_comments_number();
                        echo _e('COMMENTS: ', 'myfirsttheme').$commentsNUmber;
                    ?>  
                </h2>
            </header>
            <ul class="comment-list">
                <?php
                    wp_list_comments( array(
                        'short_ping'  => true,
                        'avatar_size' => 50,
                        'type' => 'comment'
                    ) );
                ?>
            </ul>
            <!-- Comments navigation -->
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="navigation comment-navigation" role="navigation">
                    <div class="comment-nav nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'myfirsttheme' ) ); ?></div>
                    <div class="comment-nav nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'myfirsttheme' ) ); ?></div>
                </nav>
            <?php endif; ?>
            <!-- if comments are closed -->
            <?php if ( ! comments_open() && get_comments_number() ) : ?>
                <p class="no-comments"><?php _e( 'Comments are closed.' , 'myfirsttheme' ); ?></p>
            <?php endif; ?>
        </section>
    <?php
    endif;
    comment_form();
?>