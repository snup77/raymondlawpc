<?php
/*
Template Name: Practice Areas
Template Post Type: page
Description: A custom template for displaying practice areas.
*/

?>

<?php get_header(); ?>

<?php
// Choose menu location based on language
$menu_location = 'desktop-navigation';
$subnav_heading = 'Practice Areas';

set_query_var('subnav_heading', $subnav_heading);
set_query_var('menu_location', $menu_location);

get_template_part('template-parts/content');

get_footer(); ?>