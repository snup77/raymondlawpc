<?php get_header(); ?>

<?php
// Manually set $post to the Blog Page to make ACF fields work
$blog_page_id = get_option('page_for_posts');
if ($blog_page_id) {
    global $post;
    $post = get_post($blog_page_id);
    setup_postdata($post);
}

get_template_part( 'hero-inner' );

wp_reset_postdata();
?>

<div class="blog-container client-reviews-wrapper">
    <div class="blog-layout interior-content">
        <div class="content">
            <h2 class="archive-title">Search Results for "<?php echo esc_html(get_search_query()); ?>"</h2>

            <?php get_template_part('template-parts/home-loop'); ?>
            
    </div>
</div>

<?php get_footer(); ?>