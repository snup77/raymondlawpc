<?php
/*
Template Name: Utility Page
*/

?>

<?php get_header();

set_query_var('subnav_heading', 'Helpful Links');
set_query_var('menu_location', 'helpful_links_subnav');

get_template_part('template-parts/content');

get_footer(); ?>