<!DOCTYPE html>
<html <?php echo language_attributes(); ?> >
<head>
    <meta charset="<?php echo bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name') ?></title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <!-- Adds scripts in heads -->
    <?php wp_head(); ?> 
</head>
<body <?php body_class(); ?> >
    <div class="main-container">
        <header class="header container">
            <h2><a href="<?php echo home_url() ?>"><?php bloginfo('name') ?></a></h2>
            <h5><?php bloginfo('description') ?></h5>
        </header>