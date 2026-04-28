<?php get_header(); ?>

<?php get_template_part( 'hero-inner' ); ?>

<div class="blog-container client-reviews-wrapper">
    <div class="blog-layout interior-content">
        <div class="content">
            <h2 class="archive-title"><?php the_archive_title(); ?></h2>

            <?php get_template_part('template-parts/home-loop'); ?>
            
    </div>
</div>

<?php get_footer(); ?>