<?php
    get_header();
    echo "<h3 class='specific-pages-title container'>Date: ".get_the_date( 'Y-m' )." </h3>";
    get_template_part( 'content-excerpt' );
    get_footer();
?>