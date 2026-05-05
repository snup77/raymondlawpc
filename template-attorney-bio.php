<?php
/*
Template Name: Attorney Bio
Template Post Type: page
Description: A custom template for displaying attorney biographies.
*/

?>

<?php get_header(); ?>

<?php $hero = get_field('attorney_bio_hero'); ?>

<section class="attorney-hero">
  <div class="attorney-hero-inner">
    <div class="attorney-hero-row">
      <div class="attorney-portrait-wrapper">
        <img
          class="attorney-portrait"
          src="<?php echo esc_url($hero['portrait_image']); ?>"
          alt="<?php echo esc_attr($hero['attorney_name']); ?>"
        >
      </div>

      <div class="attorney-hero-content">
        <h1><?php echo esc_html($hero['attorney_name']); ?></h1>
        <p class="attorney-title"><?php echo esc_html($hero['attorney_title']); ?></p>
        <hr aria-hidden="true">
        <p><a href="mailto:<?php echo esc_attr($hero['email_address']); ?>"><?php echo esc_html($hero['email_address']); ?></a></p>
        <p><a href="tel:<?php echo esc_attr($hero['phone_number']); ?>"><?php echo esc_html($hero['phone_number']); ?></a></p>
        <p><a href="<?php echo esc_url($hero['vcf']); ?>">Download vCard</a></p>
      </div>
    </div>
  </div>
</section>

<section class="attorney-content interior-section-container interior-content">

  <?php
  // Overview section
  $overview = get_field('attorney_overview');
  if ($overview) :
    $heading = $overview['heading'] ?? '';
    $text = $overview['overview'] ?? '';
    if ($heading || $text) :
  ?>
      <div class="attorney-section overview">
        <?php if ($heading) : ?>
          <h2><?php echo esc_html($heading); ?></h2>
          <hr aria-hidden="true">
        <?php endif; ?>

        <?php if ($text) : ?>
          <div class="attorney-overview-content">
            <?php echo wp_kses_post($text); ?>
          </div>
        <?php endif; ?>
      </div>
  <?php
    endif;
  endif;
  ?>

  <?php
// Credentials section
if (have_rows('attorney_credentials')) :
  while (have_rows('attorney_credentials')) : the_row();
    $cred_heading = get_sub_field('heading');
?>
    <div class="attorney-section credentials">
      <?php if ($cred_heading) : ?>
        <h2><?php echo esc_html($cred_heading); ?></h2>
        <hr>
      <?php endif; ?>

      <?php if (have_rows('list_items')) : ?>
        <ul class="attorney-credentials-list">
          <?php while (have_rows('list_items')) : the_row(); ?>
            <?php $item = get_sub_field('item'); ?>
            <?php if (!empty($item)) : ?>
              <li><?php echo esc_html($item); ?></li>
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
<?php
  endwhile;
endif;
?>

</section>


<?php get_footer(); ?>