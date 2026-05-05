<?php
/*
Template Name: Contact Page
Template Post Type: page
Description: A custom template for displaying the contact page.
*/

?>

<?php get_header(); ?>
<?php get_template_part( 'hero-inner' ); ?>

<section class="contact-page">
  <div class="container interior-content-wrapper interior-content">
    <div class="contact-grid">

      <?php
      if (have_rows('contact_details')) :
        while (have_rows('contact_details')) : the_row();
          $intro = get_sub_field('intro_copy');
          $address_heading = get_sub_field('address_heading');
          $google_map = get_sub_field('google_maps');
        endwhile;
      endif;

      $address = get_field('contact_info_address', 'option');
      $phone   = get_field('contact_info_phone_number', 'option');
      $email   = get_field('contact_info_email', 'option');
      ?>

      <!-- Left column: Nested grid for intro, address, and map -->
      <div class="contact-left">
        <?php if ($intro) : ?>
          <div class="contact-intro">
            <p><?php echo wp_kses_post($intro); ?></p>
          </div>
        <?php endif; ?>

        <div class="contact-address">
          <?php if ($address_heading) : ?>
            <h2><?php echo esc_html($address_heading); ?></h2>
          <?php endif; ?>
          <address>
            <?php if ($address) : ?>
              <p><?php echo $address; ?></p>
            <?php endif; ?>
            <?php if ($phone) : ?>
              <p class="contact-page-phone"><?php echo esc_html($phone); ?></p>
            <?php endif; ?>
            <?php if ($email) : ?>
              <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
            <?php endif; ?>
          </address>
        </div>

        <?php if ($google_map) : ?>
          <div class="google-map-wrapper">
            <div class="responsive-map">
              <?php
              $google_map_titled = str_replace(
                '<iframe ',
                '<iframe title="Office location on Google Maps" ',
                $google_map
              );
              echo $google_map_titled;
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Right column: Contact form -->
      <div class="contact-form">
        <?php if (have_rows('contact_form')) :
          while (have_rows('contact_form')) : the_row();
            $form_heading = get_sub_field('heading');
            $form_shortcode = get_sub_field('form_shortcode');
        ?>
          <?php if ($form_shortcode) : ?>
            <?php echo do_shortcode($form_shortcode); ?>
          <?php endif; ?>
        <?php endwhile;
        endif; ?>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>