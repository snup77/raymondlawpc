<?php
/*
Template Name: Client Reviews
Template Post Type: page
Description: A custom template for displaying client reviews.
*/

?>

<?php get_header(); ?>

<?php get_template_part( 'hero-inner' ); ?>

<?php
$testimonial_group = get_field('testimonials', 'option');
$all_testimonials = $testimonial_group['testimonials'] ?? [];
?>
<div class="container client-reviews-wrapper">
<?php if (!empty($all_testimonials)): ?>
  <div class="client-reviews-masonry">
    <?php foreach ($all_testimonials as $index => $testimonial): ?>
      <div class="review">
        <blockquote><?php echo esc_html($testimonial['quote']); ?></blockquote>
        <cite><?php echo esc_html($testimonial['author_name']); ?></cite>
        <hr>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
<div>

<?php get_footer(); ?>