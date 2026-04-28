<?php get_header(); ?>

<?php
$hero = get_field('hero_section');

$pre_heading = $hero['pre_heading'] ?? '';
$main_heading = $hero['main_heading'] ?? '';
$sub_heading = $hero['sub_heading'] ?? '';
$hero_image = $hero['hero_image'] ?? null;
?>

<?php if ($hero_image || $pre_heading || $main_heading || $sub_heading): ?>
  <section class="home-hero">
    <?php if (!empty($hero_image)): ?>
      <div class="home-hero__image">
        <img
          src="<?php echo esc_url($hero_image['url']); ?>"
          alt="<?php echo esc_attr($hero_image['alt'] ?: $main_heading); ?>"
          width="<?php echo esc_attr($hero_image['width'] ?? ''); ?>"
          height="<?php echo esc_attr($hero_image['height'] ?? ''); ?>"
        >
      </div>
    <?php endif; ?>

    <div class="home-hero__shape home-hero__shape--desktop" aria-hidden="true">
      <svg width="943" height="761" viewBox="0 0 943 761" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <g clip-path="url(#paint0_angular_14_26_clip_path)" data-figma-skip-parse="true">
          <g transform="matrix(-0.333398 0.932313 -1.15528 -0.370582 767.234 -171.313)">
            <foreignObject x="-1135.18" y="-1135.18" width="2270.35" height="2270.35">
              <div xmlns="http://www.w3.org/1999/xhtml" style="background:conic-gradient(from 90deg,rgba(60, 103, 172, 1) 0deg,rgba(16, 59, 128, 1) 360deg);height:100%;width:100%;opacity:1"></div>
            </foreignObject>
          </g>
        </g>
        <path d="M943 0L431.596 761H0V0H943Z"/>
        <defs>
          <clipPath id="paint0_angular_14_26_clip_path">
            <path d="M943 0L431.596 761H0V0H943Z"/>
          </clipPath>
        </defs>
      </svg>
    </div>

    <div class="home-hero__shape home-hero__shape--mobile" aria-hidden="true">
      <svg width="428" height="496" viewBox="0 0 428 496" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <g clip-path="url(#paint0_angular_188_15_clip_path)" data-figma-skip-parse="true">
          <g transform="matrix(0.5165 0.162726 -0.194669 0.598983 -88.5 105.085)">
            <foreignObject x="-1132.58" y="-1132.58" width="2265.15" height="2265.15">
              <div xmlns="http://www.w3.org/1999/xhtml" style="background:conic-gradient(from 90deg,rgba(60, 103, 172, 1) 0deg,rgba(16, 59, 128, 1) 360deg);height:100%;width:100%;opacity:1"></div>
            </foreignObject>
          </g>
        </g>
        <path d="M0 3.05176e-05L428 268.989L428 496L2.16808e-05 496L0 3.05176e-05Z"/>
        <defs>
          <clipPath id="paint0_angular_188_15_clip_path">
            <path d="M0 3.05176e-05L428 268.989L428 496L2.16808e-05 496L0 3.05176e-05Z"/>
          </clipPath>
        </defs>
      </svg>
    </div>

    <div class="home-hero__content">
      <div class="container">
        <div class="home-hero__text">
          <?php if (!empty($pre_heading)): ?>
            <p class="home-hero__pre-heading"><?php echo esc_html($pre_heading); ?></p>
          <?php endif; ?>

          <?php if (!empty($main_heading)): ?>
            <h1 class="home-hero__heading"><?php echo esc_html($main_heading); ?></h1>
          <?php endif; ?>

          <div class="home-hero__divider"></div>

          <?php if (!empty($sub_heading)): ?>
            <div class="home-hero__sub-heading">
              <?php echo wpautop(esc_html($sub_heading)); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
$group = get_field('practice_areas');

$heading     = $group['heading'] ?? '';
$description = $group['description'] ?? '';
$image       = $group['image'] ?? null;
$button_text = $group['button_label'] ?? '';
$button_url  = $group['button_url'] ?? '';

$image_id = $image['ID'] ?? 0;

$locations = get_nav_menu_locations();
$menu_id   = $locations['practice_subnav'] ?? 0;
$items     = $menu_id ? wp_get_nav_menu_items($menu_id) : [];

$slug = 'practice-areas';

$section_id = 'practice-spotlight-' . sanitize_title($heading);
?>

<section
    class="homepage-section practice-spotlight practice-spotlight--<?php echo esc_attr(sanitize_title($slug)); ?> practice-spotlight-container"
    aria-labelledby="<?php echo esc_attr($section_id); ?>"
>
    <div class="container practice-spotlight__grid">
        <figure class="practice-spotlight__media practice-spotlight-image">
            <?php
            if ($image_id) {
                echo wp_get_attachment_image(
                    $image_id,
                    'large',
                    false,
                    [
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                        'alt'      => $image['alt'] ?? ''
                    ]
                );
            }
            ?>
        </figure>
        <div class="practice-spotlight__content">
            <?php if ($heading) : ?>
                <h2
                    id="<?php echo esc_attr($section_id); ?>"
                    class="practice-spotlight__title"
                >
                    <?php echo esc_html($heading); ?>
                </h2>
            <?php endif; ?>
            <?php if ($description) : ?>
                <p class="practice-spotlight__description section-copy">
                    <?php echo esc_html($description); ?>
                </p>
            <?php endif; ?>
            <?php if ($items) : ?>
                <nav aria-label="<?php echo esc_attr($heading); ?> links">
                    <ul class="practice-spotlight__list">
                        <?php foreach ($items as $item) : ?>
                            <li class="practice-spotlight__item">
                                <a
                                    class="practice-spotlight__link"
                                    href="<?php echo esc_url($item->url); ?>"
                                >
                                    <span class="practice-spotlight__link-text">
                                        <?php echo esc_html($item->title); ?>
                                    </span>
                                    <svg
                                        class="practice-spotlight__icon"
                                        viewBox="0 0 24 24"
                                        width="22"
                                        height="22"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M9 6l6 6-6 6"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <?php if ($button_text && $button_url) : ?>
                <div class="practice-spotlight__cta">
                    <a
                        class="practice-spotlight__button section-button"
                        href="<?php echo esc_url(home_url($button_url)); ?>"
                    >
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
$profile = get_field('attorney_profile');
$heading = $profile['heading'];
$copy = $profile['copy'];
$button_label = $profile['button_label'];
$button_url = home_url($profile['button_url']);
$image = $profile['image'];
?>

<section class="homepage-section attorney-profile-bg">
  <div class="homepage-container">
    <div class="attorney-profile-grid">
      <div class="attorney-profile-content">
        <h2><?php echo esc_html($heading); ?></h2>
        <p class="section-copy">
          <?php echo wp_kses_post($copy); ?>
        </p>
        <a href="<?php echo esc_url($button_url); ?>" class="section-button">
          <?php echo esc_html($button_label); ?>
        </a>
      </div>
      <div class="attorney-profile-image">
        <img 
          src="<?php echo esc_url($image['url']); ?>" 
          alt="<?php echo esc_attr($image['alt']); ?>" 
          width="560" height="610"
          loading="lazy"
        >
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>