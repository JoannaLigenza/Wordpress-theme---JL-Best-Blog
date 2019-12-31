<?php
    get_header();
?>

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
        <h3 class="page-404">Sorry! This page not found</h3>
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
<?php
    get_footer();
?>