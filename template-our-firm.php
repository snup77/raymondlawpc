<?php
/*
Template Name: Our Firm
Template Post Type: page
Description: A custom template for displaying the "Our Firm" page.
*/

?>

<?php get_header(); ?>
<?php get_template_part( 'hero-inner' ); ?>

<?php
$mission = get_field('mission_section');
$mission_heading = $mission['heading'];
$mission_content = $mission['content'];
?>

<?php if ($mission_heading || $mission_content) : ?>
<section class="homepage-section centered-section">
  <div class="container">
    <?php if ($mission_heading) : ?>
      <h2><?php echo esc_html($mission_heading); ?></h2>
    <?php endif; ?>

    <?php if ($mission_content) : ?>
      <p class="section-copy">
        <?php echo wp_kses_post($mission_content); ?>
      </p>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php
$legal_guidance = get_field('legal_guidance_section');
$heading = $legal_guidance['heading'];
$content = $legal_guidance['content'];
$button_label = $legal_guidance['button_label'];
$button_url = $legal_guidance['button_url'];
$image_url = $legal_guidance['image'];
?>

<?php if ($heading || $content || ($button_label && $button_url)) : ?>
<section class="homepage-section legal-guidance-section" style="background-image: url('<?php echo esc_url($image_url); ?>');">
  <div class="overlay"></div>
  <div class="container">
    <div class="legal-guidance-content">
      <?php if ($heading) : ?>
        <h2><?php echo esc_html($heading); ?></h2>
      <?php endif; ?>

      <?php if ($content) : ?>
        <p class="section-copy">
          <?php echo wp_kses_post($content); ?>
        </p>
      <?php endif; ?>

      <?php if ($button_label && $button_url) : ?>
        <a href="<?php echo esc_url($button_url); ?>" class="section-button">
          <?php echo esc_html($button_label); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$community = get_field('community_section');
$heading = $community['heading'];
$content = $community['content'];
$image_url = $community['image'];
?>

<?php if ($heading || $content || $image_url) : ?>
<section class="homepage-section community-section-bg">
  <div class="container">
    <div class="attorney-profile-grid">
      <div class="attorney-profile-image">
        <?php if ($image_url) : ?>
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="" 
            width="560" height="610"
            loading="lazy"
          >
        <?php endif; ?>
      </div>
      <div class="attorney-profile-content">
        <?php if ($heading) : ?>
          <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
          <p class="section-copy">
            <?php echo wp_kses_post($content); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$tranel = get_field('tranel_section');
$heading = $tranel['heading'];
$content = $tranel['content'];
$button_label = $tranel['button_label'];
$button_url = $tranel['button_url'];
$image_url = $tranel['image'];
?>

<?php if ($heading || $content || $button_label || $image_url) : ?>
<section class="homepage-section tranel-section-bg">
  <div class="container">
    <div class="attorney-profile-grid">
      <div class="attorney-profile-content">
        <?php if ($heading) : ?>
          <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
          <p class="section-copy">
            <?php echo wp_kses_post($content); ?>
          </p>
        <?php endif; ?>

        <?php if ($button_label && $button_url) : ?>
          <a href="<?php echo esc_url($button_url); ?>" class="section-button">
            <?php echo esc_html($button_label); ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="attorney-profile-image">
        <?php if ($image_url) : ?>
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="" 
            width="560" height="610"
            loading="lazy"
          >
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$smith = get_field('smith_section');
$heading = $smith['heading'];
$content = $smith['content'];
$image_url = $smith['image'];
?>

<?php if ($heading || $content || $image_url) : ?>
<section class="homepage-section smith-section-bg">
  <div class="container">
    <div class="attorney-profile-grid">
      <div class="attorney-profile-image">
        <?php if ($image_url) : ?>
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="" 
            width="560" height="610"
            loading="lazy"
          >
        <?php endif; ?>
      </div>
      <div class="attorney-profile-content">
        <?php if ($heading) : ?>
          <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
          <p class="section-copy">
            <?php echo wp_kses_post($content); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>