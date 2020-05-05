<?php
    /**
     * This is the template for displaying Comments.
     */

    if ( have_comments() ) : ?>
        <section class="comments-section">
            <header> 
                <h2 class="comments-title">
                    <?php 
                        $commentsNumber = get_comments_number();
                        echo esc_html_e('COMMENTS: ', 'jl-best-blog').absint( $commentsNumber );
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
                    <div class="comment-nav nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'jl-best-blog' ) ); ?></div>
                    <div class="comment-nav nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'jl-best-blog' ) ); ?></div>
                </nav>
            <?php endif; ?>
            <!-- if comments are closed -->
            <?php if ( ! comments_open() && get_comments_number() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'jl-best-blog' ); ?></p>
            <?php endif; ?>
        </section>
    <?php
    endif;
    comment_form();
?>