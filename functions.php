<?php

// Theme supports

function theme_supports() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}

add_action('after_setup_theme', 'theme_supports');

// Enqueue styles and scripts

function custom_theme_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_uri()); // Loads style.css
}
add_action('wp_enqueue_scripts', 'custom_theme_styles');

function custom_theme_scripts() {
    wp_enqueue_script(
        'custom-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),         // Dependencies (leave empty if none)
        null,            // Version (null = no version string)
        true             // Load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );

// Remove block editor styles

function remove_block_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );

// Disable emoji scripts (frontend only)

function disable_wp_emojicons_frontend_only() {
    if ( ! is_admin() ) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

        add_filter( 'emoji_svg_url', '__return_false' );
    }
}
add_action( 'init', 'disable_wp_emojicons_frontend_only' );

// Remove WordPress version from head

remove_action( 'wp_head', 'wp_generator' );

// Remove REST API link tag

remove_action( 'wp_head', 'rest_output_link_wp_head' );

// Remove RSD link and disable XML-RPC.

remove_action( 'wp_head', 'rsd_link' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable the Gutenberg block editor for all post types

add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

// Let Yoast handle canonical tags

remove_action( 'wp_head', 'rel_canonical' );

// Clean up unused WordPress features

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );

// Register menus

function theme_register_menus() {
    register_nav_menus([
        'desktop-navigation' => __('Desktop Navigation', 'raymondlawpc'),
        'primary-menu'       => __('Primary Menu', 'raymondlawpc'),
        'practice_subnav' => __('Practice Area Sub-Navigation', 'raymondlawpc'),
        'helpful_links_subnav' => __('Helpful Links Sub-Navigation', 'raymondlawpc'),
        'footer-menu' => __('Footer Menu', 'raymondlawpc'),
    ]);
}
add_action('after_setup_theme', 'theme_register_menus');

// Insert ACF hreflang tags

// function insert_acf_hreflang_tags() {
//     if (!is_singular()) return;

//     $settings = get_field('language_settings');
//     if (!$settings) return;

//     $language = isset($settings['language']) ? $settings['language'] : 'en';
//     $alternate_slug = isset($settings['alternate_link']) ? trim($settings['alternate_link'], '/') : '';

//     // Skip if no alternate slug provided
//     if (!$alternate_slug) return;

//     // Build full URL from slug
//     $alternate_url = home_url("/{$alternate_slug}/");

//     // Map to hreflang format
//     $current_url = get_permalink();
//     $hreflang = ($language === 'es') ? 'es-US' : 'en-US';
//     $alt_hreflang = ($language === 'es') ? 'en-US' : 'es-US';

//     // Output hreflang tags
//     echo '<link rel="alternate" hreflang="' . esc_attr($hreflang) . '" href="' . esc_url($current_url) . '">' . "\n";
//     echo '<link rel="alternate" hreflang="' . esc_attr($alt_hreflang) . '" href="' . esc_url($alternate_url) . '">' . "\n";
// }
// add_action('wp_head', 'insert_acf_hreflang_tags');

// Remove Yoast schema and add custom schema output

add_filter( 'wpseo_json_ld_output', '__return_false' );

add_action( 'wp_head', 'custom_schema_output', 99 );

function custom_schema_output() {
    if ( ! is_singular() ) return;

    $post_id = get_queried_object_id();
    $language_settings = get_field( 'language_settings', $post_id );
    $acf_lang = $language_settings['language'] ?? 'en';
    $lang_code = $acf_lang === 'es' ? 'es-US' : 'en-US';

    $site_url = get_home_url();
    $page_url = get_permalink( $post_id );
    $site_name = get_bloginfo( 'name' );
    $page_title = get_the_title( $post_id );
    $org_logo = get_theme_file_uri( '/assets/images/logo.svg' );

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebPage',
                '@id' => $page_url,
                'url' => $page_url,
                'name' => $page_title,
                'isPartOf' => [ '@id' => $site_url . '/#website' ],
                'inLanguage' => $lang_code,
            ],
            [
                '@type' => 'WebSite',
                '@id' => $site_url . '/#website',
                'url' => $site_url,
                'name' => $site_name,
                'publisher' => [ '@id' => $site_url . '/#organization' ],
                'inLanguage' => $lang_code,
            ],
            [
                '@type' => 'Organization',
                '@id' => $site_url . '/#organization',
                'name' => $site_name,
                'url' => $site_url,
                'logo' => [
                    '@type' => 'ImageObject',
                    '@id' => $site_url . '/#/schema/logo/image/',
                    'url' => $org_logo,
                    'inLanguage' => $lang_code,
                ],
                'image' => [ '@id' => $site_url . '/#/schema/logo/image/' ],
            ],
        ]
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}

// Allow vCard uploads

function allow_vcard_upload($mimes) {
    $mimes['vcf'] = 'text/vcard';
    return $mimes;
}
add_filter('upload_mimes', 'allow_vcard_upload');