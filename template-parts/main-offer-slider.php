<section class="main-products-slider position-relative p-4 py-lg-5 overflow-hidden" id="main-products-offer-slider">
    <h2 class="text-center mb-4 mb-lg-5 playfair-display-400">
        <span class="d-block icon-text icon-text--white text-magenta lobster-font mb-2"></span>
        <span class="d-block icon-text icon-text--white standard-title-5 mb-2"></span>
        <div class="text-center">
            <img src="" class="flowers-heading-1" alt="">
        </div>
    </h2>

    <?php
    // Wyklucz "bez-kategorii" (PL) i "uncategorized" (EN)
    $exclude = [];
    if (($term_pl = get_category_by_slug('bez-kategorii')) && !is_wp_error($term_pl)) {
        $exclude[] = (int) $term_pl->term_id;
    }
    if (($term_en = get_category_by_slug('uncategorized')) && !is_wp_error($term_en)) {
        $exclude[] = (int) $term_en->term_id;
    }

    // Pobierz kategorie (pokazujemy także puste, jeśli chcesz ustaw hide_empty => true)
    $categories = get_categories([
        'taxonomy'   => 'category',
        'hide_empty' => false,
        'exclude'    => $exclude,
        // 'orderby'  => 'name',
        // 'order'    => 'ASC',
    ]);
    ?>

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <?php
                    // Pobierz URL obrazka z wtyczki (jeśli jest)
                    $cat_img_url = (function_exists('z_taxonomy_image_url'))
                        ? z_taxonomy_image_url($category->term_id)
                        : '';
                    // Spróbuj znaleźć attachment ID po URL, żeby użyć 'cat-width'
                    $cat_img_id = $cat_img_url ? attachment_url_to_postid($cat_img_url) : 0;
                    ?>
                    <div class="swiper-slide">
                        <a class="d-block text-decoration-none" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">

                            <?php
                            // Jeśli mamy ID — wyrenderuj rozmiar 302x275 (cat-width)
                            if ($cat_img_id) {
                                echo wp_get_attachment_image(
                                    $cat_img_id,
                                    'cat-width',
                                    false,
                                    [
                                        'class'    => 'img-fluid w-100 d-block',
                                        'alt'      => $category->name,
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'sizes'    => '(min-width:1200px) 20vw, (min-width:992px) 25vw, (min-width:768px) 33vw, (min-width:576px) 50vw, 100vw',
                                    ]
                                );
                            } elseif (!empty($cat_img_url)) {
                                // Jeśli mamy tylko URL — pokaż obraz bez wymuszonego rozmiaru
                                echo '<img src="' . esc_url($cat_img_url) . '" alt="' . esc_attr($category->name) . '" class="img-fluid w-100 d-block" loading="lazy" decoding="async">';
                            }
                            // Jeśli nie ma żadnego obrazka — nic nie renderujemy, ale kategoria i tak zostaje pokazana (tytuł/opis poniżej)
                            ?>

                            <?php if (!empty($category->name)) : ?>
                                <h6 class="mb-1"><?php echo esc_html($category->name); ?></h6>
                            <?php endif; ?>

                            <?php if (!empty($category->description)) : ?>
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
