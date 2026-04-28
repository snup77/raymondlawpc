</main>

<footer class="site-footer">

  <?php
  $contact_info = get_field('contact_info', 'option');

  $address       = $contact_info['address'];
  $phone_number  = $contact_info['phone_number'];
  $email         = $contact_info['email'];
  $footer_logo = $contact_info['footer_logo'] ?? null;
  ?>

  <!-- Top Row -->
  <div class="footer-top">
    <div class="container footer-top-grid">
      <div class="footer-logo">
        <?php
        if ($footer_logo) :
        ?>
          <img
            src="<?php echo esc_url($footer_logo['url']); ?>"
            alt="<?php echo esc_attr($footer_logo['alt'] ?: get_bloginfo('name')); ?>"
            width="<?php echo esc_attr($footer_logo['width']); ?>"
            height="<?php echo esc_attr($footer_logo['height']); ?>"
          >
        <?php endif; ?>
      </div>


      <div class="footer-contact-wrapper">
        <address class="footer-contact">
          <?php echo $address; ?><br>
        <a href="tel:<?php echo esc_attr(preg_replace('/\D+/', '', $phone_number)); ?>">
          <?php echo esc_html($phone_number); ?>
        </a><br>
        <a href="mailto:<?php echo antispambot($email); ?>">
          <?php echo antispambot($email); ?>
        </a>
        </address>
      </div>
    </div>
  </div>

  <!-- Bottom Row -->
  <div class="footer-bottom">
    <div class="container">
      <p class="footer-bottom-text">
        © <?php echo date('Y'); ?> Raymond Law PC
        <?php
          if (has_nav_menu('footer-menu')) {
            // Capture menu HTML into a variable
            $footer_menu = wp_nav_menu([
              'theme_location' => 'footer-menu',
              'container'      => false,
              'echo'           => false,
              'items_wrap'     => '%3$s',
              'depth'          => 1,
              'link_before'    => '',
              'link_after'     => '',
              'fallback_cb'    => false,
            ]);

            // Remove <li> wrappers and replace them with inline links with pipes
            $footer_menu = strip_tags($footer_menu, '<a>');
            $footer_menu = preg_replace('/<\/a>\s*/', '</a> | ', $footer_menu); // Add pipes after links
            $footer_menu = rtrim($footer_menu, ' | '); // Remove trailing pipe

            echo ' | ' . $footer_menu; // Add pipe only before the first link
          }
        ?>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>