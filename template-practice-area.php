<?php
/*
Template Name: Practice Areas
Template Post Type: page
Description: A custom template for displaying practice areas.
*/

?>

<?php get_header(); ?>

<?php
// Get the ACF group field 'language_settings'
$settings = get_field('language_settings');

// Default to English if language is not set
$language = isset($settings['language']) ? $settings['language'] : 'en';

// Choose menu location based on language
$menu_location = ($language === 'es') ? 'practice_subnav_es' : 'desktop-navigation';
$subnav_heading = ($language === 'es') ? 'Servicios en Español' : 'Practice Areas';

set_query_var('subnav_heading', $subnav_heading);
set_query_var('menu_location', $menu_location);

get_template_part('template-parts/content');

get_footer(); ?>