<div class="container">


<?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 
            echo "<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>"; 
            the_post_thumbnail(); 
            the_excerpt('<p>', '</p>');
        endwhile; 
    else :
        echo '<p>No content</p>';
    endif; 
?>

</div>