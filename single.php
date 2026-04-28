<?php get_header(); ?>

<?php
/**
 * Hero section for single.php.
 * Pulls hero image and heading from the Posts page settings.
 */

$post_id = get_option('page_for_posts'); // ID of the blog index page
$hero = $post_id ? get_field('page_hero', $post_id) : null;

if ( $hero && !empty($hero['hero_image']) ) :
  $image_url = esc_url($hero['hero_image']['url']);
  $heading   = esc_html($hero['heading']);
?>
  <div class="page-hero" style="background-image: url('<?php echo $image_url; ?>');">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <p class="page-hero-caption"><?php echo $heading; ?></p>
    </div>
  </div>
<?php endif; ?>

<div class="blog-container client-reviews-wrapper">
    <div class="blog-layout interior-content">
        <div class="content single-post">

        <?php 
            while(have_posts()) {
                the_post(); ?>
                <div>
                    <h1><?php the_title(); ?></h1>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php }
        ?>
    </div>

    <?php get_template_part('template-parts/sidebar-blog'); ?>

    </div>
</div>

<?php get_footer(); ?>