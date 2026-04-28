<?php get_template_part('hero-inner'); ?>

<?php
$subnav_heading = get_query_var('subnav_heading');
$menu_location  = get_query_var('menu_location');
?>

<div class="interior-content-wrapper">
  <div class="practice-area-content">
    <div class="content-column interior-content">
      <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>

    <aside class="sidebar-column subnav">
      <h2 class="practice-subnav-heading">
        <?php echo esc_html($subnav_heading); ?>
      </h2>

      <?php
      if ($menu_location) {
        wp_nav_menu([
          'theme_location'  => $menu_location,
          'container'       => 'nav',
          'container_class' => 'practice-subnav',
          'menu_class'      => 'practice-subnav-list',
          'depth'           => 2,
          'fallback_cb'     => false,
        ]);
      }
      ?>
    </aside>
  </div>
</div>