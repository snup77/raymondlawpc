  
    
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="post">
                <p class="date-category">
                    <?php echo get_the_date(); ?> |
                    <?php
                    $category = get_the_category();
                    if (!empty($category)) {
                    echo '<span>' . esc_html($category[0]->name) . '</span>';
                    }
                    ?>
                </p>

                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="image-wrapper">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
                    </a>
                    </div>
                <?php endif; ?>

                <p class="summary">
                    <?php echo get_the_excerpt(); ?>
                </p>

                <a class="read-more" href="<?php the_permalink(); ?>">
                Read More<svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
                </a>
                <hr />
            </article>
        <?php endwhile; ?>
        <?php else : ?>
        <p>No posts found.</p>
        <?php endif; ?>

        <div class="pagination">

        <!-- Full pagination (desktop only) -->
        <div class="pagination-desktop">
            <?php
            echo paginate_links([
            'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'    => '/page/%#%/',
            'current'   => max(1, get_query_var('paged')),
            'total'     => $wp_query->max_num_pages,
            'mid_size'  => 2,
            'prev_text' => '← Previous',
            'next_text' => 'Next →',
            'type'      => 'list',
            ]);
            ?>
        </div>

        <?php
        $paged = max(1, get_query_var('paged'));
        $total_pages = $wp_query->max_num_pages;
        $prev_link = get_previous_posts_link('← Prev');
        $next_link = get_next_posts_link('Next →');

        if ($total_pages > 1) :
        ?>
            <!-- Compact pagination (mobile only) -->
            <div class="pagination-mobile">
                <div class="pagination-controls">
                    <?php if ($prev_link) : ?>
                        <span class="pagination-prev"><?php previous_posts_link('← Prev'); ?></span>
                    <?php endif; ?>
                    <span class="pagination-status">Page <?php echo $paged; ?> of <?php echo $total_pages; ?></span>
                    <?php if ($next_link) : ?>
                        <span class="pagination-next"><?php next_posts_link('Next →'); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        </div>
    </div>

<?php get_template_part('template-parts/sidebar-blog'); ?>