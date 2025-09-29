<!-- Slider with offer -->
<section class="main-products-slider position-relative p-4 py-lg-5 overflow-hidden" id="main-products-offer-slider">
    <h2 class="text-center mb-4 mb-lg-5 playfair-display-400">
        <span class="d-block icon-text icon-text--white text-magenta lobster-font mb-2"></span>
        <span class="d-block icon-text icon-text--white standard-title-5 mb-2"></span>
        <div class="text-center">
            <img src="" class="flowers-heading-1" alt="">
        </div>
    </h2>

    <?php
    // Build exclude list for "bez-kategorii" (PL) and "uncategorized" (EN)
    $to_exclude = array();

    $term_pl = get_category_by_slug('bez-kategorii');
    if ($term_pl && ! is_wp_error($term_pl)) {
        $to_exclude[] = (int) $term_pl->term_id;
    }

    $term_en = get_category_by_slug('uncategorized');
    if ($term_en && ! is_wp_error($term_en)) {
        $to_exclude[] = (int) $term_en->term_id;
    }

    // Fetch categories (change taxonomy if you need a custom one)
    $categories = get_categories(array(
        'taxonomy'   => 'category',
        'hide_empty' => false,      // set to true if you want to hide empty categories
        'exclude'    => $to_exclude,
        // 'parent'   => 0,          // uncomment to show only top-level categories
        // 'orderby'  => 'name',
        // 'order'    => 'ASC',
    ));
    ?>

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php if (! empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="swiper-slide">
                        <a class="d-block text-decoration-none" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php
                            // Category thumbnail via term meta (e.g. from ACF or Woo/Custom)
                            $thumb_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            if ($thumb_id) {
                                echo wp_get_attachment_image(
                                    $thumb_id,
                                    'medium',
                                    false,
                                    array(
                                        'class'    => 'img-fluid w-100 d-block',
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'sizes'    => '(min-width:1200px) 20vw, (min-width:992px) 25vw, (min-width:768px) 33vw, (min-width:576px) 50vw, 100vw',
                                    )
                                );
                            }
                            ?>

                            <?php if (! empty($category->name)) : ?>
                                <h6 class="mb-1"><?php echo esc_html($category->name); ?></h6>
                            <?php endif; ?>

                            <?php if (! empty($category->description)) : ?>
                                <p class="small text-body-secondary mb-0">
                                    <?php echo esc_html($category->description); ?>
                                </p>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>