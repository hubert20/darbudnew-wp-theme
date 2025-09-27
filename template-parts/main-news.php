<!-- News -->
<section class="main-news p-relative p-4 py-lg-5" style="background: #f8f8f8;">
    <h2 class="text-center mb-4 mb-lg-5 standard-title-4 text-magenta lobster-font">
        <span class="d-inline-block icon-text icon-text--white px-4">Blog Mariolahairstylist</span>
        <div class="text-center">
            <img src="https://mariolahairstylist.pl/wp-content/uploads/2025/06/flowers-200.png" class="flowers-heading-1" alt="">
        </div>
    </h2>
    <div class="swiper swiper-news">
        <div class="swiper-wrapper">
            <?php
            $query = new WP_Query(array('category_name' => 'blog', 'posts_per_page' => 10));
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="swiper-slide d-flex">
                        <div class="main-news__item d-flex flex-column">
                            <?php if (has_post_thumbnail($post->ID)) : ?>
                                <?php
                                $imgID  = get_post_thumbnail_id($post->ID);
                                $image  = wp_get_attachment_image_src($imgID, 'news-width', false, '');
                                $imgAlt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
                                ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="d-block">
                                    <img src="<?php echo $image[0]; ?>" alt="<?php echo $imgAlt; ?>" class="img-fluid main-news__img">
                                </a>
                            <?php endif; ?>
                            <div class="p-3 p-lg-4 main-news__item-cnt position-relative d-flex flex-grow-1 flex-column">
                                <?php if ('post' === get_post_type()) : ?>
                                    <span class="main-news__item-date py-1"><?php echo get_the_date(); ?></span>
                                <?php endif; ?>
                                <div class="main-news__item-box d-flex flex-column flex-grow-1">
                                    <p class="main-news__item-title-post playfair-petch-font fw-bold lh-12 flex-grow-1">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="text-dark">
                                            <?php echo wp_trim_words(get_the_title(), 15, ' [...]'); ?>
                                        </a>
                                    </p>
                                    <p class="text-right mb-0">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-double-border btn-style" title="<?php echo esc_attr(get_the_title()); ?>" style="border-radius: 3px;">
                                            <span class="btn-style-border--text fw-bold text-uppercase z-3 position-relative">Czytam <i class="fa fa-angle-right"></i></span>
                                            <span class="btn-style--border btn-style--first bg-white"></span>
                                            <span class="btn-style--border btn-style--second bg-white"></span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
    <div class="position-relative d-flex align-items-center justify-content-center">
        <div class="swiper-main-news__prev swiper-button-prev"></div>
        <div class="swiper-main-news__next swiper-button-next"></div>
    </div>
</section>