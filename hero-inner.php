<?php
/**
 * Hero section that safely works across all templates.
 * Priority: Uses custom ACF field 'page_hero' from the current post
 * Fallback: Uses 'page_for_posts' (for home.php or archive views)
 */

$hero = null;
$post_id = null;

// 1. Try current global post (works for page.php, single.php, custom templates)
if ( isset( $post ) && is_a( $post, 'WP_Post' ) ) {
  $post_id = $post->ID;
}

// 2. If we're on the blog index or archive, use the "Posts page" ID
if ( is_home() || is_archive() || is_category() || is_tag() || is_date() ) {
  $post_id = get_option('page_for_posts');
}

// 3. Fallback: optional hardcoded post ID (if needed)
// $post_id = $post_id ?: 42;

if ( $post_id ) {
  $hero = get_field('page_hero', $post_id);
}

if ( $hero && !empty($hero['hero_image']) ) :
  $image_url = esc_url($hero['hero_image']['url']);
  $heading   = esc_html($hero['heading']);
  ?>
  <div class="page-hero" style="background-image: url('<?php echo $image_url; ?>');">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <h1><?php echo $heading; ?></h1>
    </div>
  </div>
<?php endif; ?>