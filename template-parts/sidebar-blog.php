    <aside class="sidebar">
        <div class="search-box">
            <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" placeholder="Blog Search" value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="post">
                <button type="submit">
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_429_74)">
                        <path d="M25.6497 27C25.3051 27 24.96 26.8688 24.6964 26.6059L18.5688 20.4965C16.5543 22.087 14.081 22.95 11.4748 22.95C8.40978 22.95 5.52822 21.7565 3.36067 19.5889C1.19353 17.4218 0 14.5398 0 11.4748C0 8.40978 1.19353 5.52822 3.36108 3.36108C5.52863 1.19393 8.40978 0 11.4748 0C14.5398 0 17.4214 1.19353 19.5889 3.36108C21.7561 5.52863 22.95 8.41019 22.95 11.4752C22.95 14.0903 22.0813 16.5713 20.4803 18.5898L26.6031 24.6943C27.1312 25.2208 27.1324 26.0754 26.6059 26.6035C26.3423 26.868 25.996 27.0004 25.6497 27.0004V27ZM11.4748 2.70012C9.13108 2.70012 6.92749 3.61299 5.26983 5.27024C3.61258 6.92749 2.69972 9.13108 2.69972 11.4752C2.69972 13.8193 3.61258 16.0225 5.26983 17.6802C6.92709 19.3374 9.13068 20.2503 11.4748 20.2503C13.8189 20.2503 16.0221 19.3374 17.6798 17.6802C19.337 16.0229 20.2499 13.8193 20.2499 11.4752C20.2499 9.13108 19.337 6.9279 17.6798 5.27024C16.0225 3.61299 13.8189 2.70012 11.4748 2.70012Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_429_74">
                        <rect width="27" height="27" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </button>
            </form>
        </div>
        <div class="subnav">
            <h2>Categories</h2>
            <ul>
                <?php
                $categories = get_categories([
                    'orderby' => 'name',
                    'order'   => 'ASC',
                    'hide_empty' => true, // Only show categories that have posts
                ]);

                foreach ($categories as $category) {
                    echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">'
                    . esc_html($category->name)
                    . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </aside>