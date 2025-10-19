<section class="main-products-slider main-products position-relative p-4 py-lg-5 overflow-hidden" id="main-products-offer-slider">
    <div class="container">
        <div class="slider-header">
            <h2 class="mb-4 text-green rajdhani-600 standard-title-4">
                Domy mobilne i budownictwo energooszczędne szkieletowe
            </h2>
            <div class="slider-nav">
                <div class="swiper-button-prev main-products-slider__prev"></div>
                <div class="swiper-button-next main-products-slider__next"></div>
            </div>
        </div>
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

        <div class="swiper my-slider">
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
                            <a class="main-products--item d-block text-decoration-none" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">

                                <?php
                                // Jeśli mamy ID — wyrenderuj rozmiar 302x275 (cat-width)
                                if ($cat_img_id) {
                                    echo wp_get_attachment_image(
                                        $cat_img_id,
                                        'cat-width',
                                        false,
                                        [
                                            'class'    => 'img-fluid w-100 d-block main-products--item-img',
                                            'alt'      => $category->name,
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                            'sizes'    => '(min-width:1200px) 20vw, (min-width:992px) 25vw, (min-width:768px) 33vw, (min-width:576px) 50vw, 100vw',
                                        ]
                                    );
                                } elseif (!empty($cat_img_url)) {
                                    // Jeśli mamy tylko URL — pokaż obraz bez wymuszonego rozmiaru
                                    echo '<img src="' . esc_url($cat_img_url) . '" alt="' . esc_attr($category->name) . '" class="main-products--item-img img-fluid w-100 d-block" loading="lazy" decoding="async">';
                                }
                                // Jeśli nie ma żadnego obrazka — nic nie renderujemy, ale kategoria i tak zostaje pokazana (tytuł/opis poniżej)
                                ?>
                                <div class="main-products--item-title p-3">
                                    <span class="main-products--item-corner">
                                        <svg class="arrow-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <?php if (!empty($category->name)) : ?>
                                        <p class="mb-0 text-green text0uppercase standard-title-6 rajdhani-600"><?php echo esc_html($category->name); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($category->description)) : ?>
                                        <p class="small text-dark mb-0 main-products--item-desc lh-13">
                                            <?php echo esc_html($category->description); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
        </div>
    </div>
</section>