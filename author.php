<?php
    get_header();
    echo "<h3 class='specific-pages-title container'>Author: ".get_the_author()." </h3>";
    get_template_part( 'content-excerpt' );
    get_footer();
?>