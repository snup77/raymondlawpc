<?php get_header(); ?>

  <div class="page-hero" style="background-image: url('<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/practice-area-hero.jpg' ) ); ?>');">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <h1>Page Not Found</h1>
    </div>
  </div>

  <div class="interior-content-wrapper">
  <div class="practice-area-content">
    <div class="content-column interior-content">
      <p>The page you’re looking for may have been moved, deleted, or never existed. Please check the URL or use the helpful links on this page to find what you need.</p>
    </div>

    <aside class="sidebar-column subnav">
      <h2 class="practice-subnav-heading">
        Helpful Links
      </h2>

      <?php
        wp_nav_menu([
          'theme_location'  => 'helpful_links_subnav',
          'container'       => 'nav',
          'container_class' => 'practice-subnav',
          'container_aria_label' => 'Helpful links',
          'menu_class'      => 'practice-subnav-list',
          'fallback_cb'     => false,
        ]);
      ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>

