<?php
// Default to 'en-US'
$page_lang = 'en-US';

// Get language value from ACF group field
$language_settings = get_field('language_settings');
$language = isset($language_settings['language']) ? $language_settings['language'] : 'en';

// Map short code to region-specific code
if ($language === 'es') {
    $page_lang = 'es-US';
} elseif ($language === 'en') {
    $page_lang = 'en-US';
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>
<a href="#main-content" class="skip-link">Skip to main content</a>
<header class="site-header">
  <div class="container header-inner">
    <div class="site-branding">
      <?php
      if (function_exists('the_custom_logo') && has_custom_logo()) {
        the_custom_logo();
      } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="site-logo">YourLogo</a>';
      }
      ?>
    </div>

    <nav
      class="site-navigation"
      id="siteNavigation"
      aria-label="Primary navigation"
      aria-hidden="true"
    >
      <div class="site-navigation__inner">
        <div class="site-navigation__mobile-header">
          <button
            class="close-flyout circle-outline"
            aria-label="Close menu"
            type="button"
          >
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <line x1="5" y1="5" x2="19" y2="19" />
              <line x1="19" y1="5" x2="5" y2="19" />
            </svg>
          </button>
        </div>

        <?php
        wp_nav_menu([
          'theme_location' => 'primary-menu',
          'menu_class'     => 'primary-menu',
          'container'      => false,
          'depth'          => 2,
        ]);
        ?>
      </div>
    </nav>

    <div class="header-right">
      <button
        class="menu-toggle circle-outline"
        aria-label="Open menu"
        aria-controls="siteNavigation"
        aria-expanded="false"
        type="button"
      >
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <line x1="3" y1="6" x2="21" y2="6" />
          <line x1="3" y1="12" x2="21" y2="12" />
          <line x1="3" y1="18" x2="21" y2="18" />
        </svg>
      </button>
    </div>
  </div>

  <div class="flyout-overlay" id="flyoutOverlay"></div>
</header>

<main id="main-content">