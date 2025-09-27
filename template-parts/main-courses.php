<section class="py-5 main-kursy">
    <div class="container">
        <h2 class="mb-4 mb-lg-5 text-center playfair-display-600 standard-title-6 text-uppercase fw-bold">Kursy i szkolenia</h2>

        <div class="row">
            <?php
            // Uwaga: aby strony były filtrowane po kategorii, dodaj w functions.php:
            // add_action('init', fn() => register_taxonomy_for_object_type('category','page'));

            $args = [
                'post_type'      => ['product', 'page'], // produkty + strony
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
                'tax_query'      => [
                    'relation' => 'OR',
                    [
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => ['kursy'],          // produkty
                    ],
                    [
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => ['kursy-darmowe'],  // strony–dokumenty
                    ],
                ],
            ];

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();
                    $post_type = get_post_type();

                    // ====== PRODUKT ======
                    if ($post_type === 'product') :
                        $product    = wc_get_product(get_the_ID());
                        $is_free    = $product && (float) $product->get_price() === 0.0;
                        $price_html = $product ? $product->get_price_html() : '';
            ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['class' => 'card-img-top img-fluid', 'loading' => 'lazy']);
                                    else : ?><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" class="card-img-top" alt="Brak obrazka" loading="lazy"><?php endif; ?>
                                </a>

                                <div class="p-3 p-lg-4 d-flex flex-column" style="background: #fdf2f0;">
                                    <h5 class="mb-4 pb-3 playfair-display-600 main-kursy--title text-bronze">
                                        <?php the_title(); ?> <?php if ($is_free): ?><span class="badge bg-success ms-2">Darmowy</span><?php endif; ?>
                                    </h5>

                                    <?php if ($product) {
                                        $czas = $product->get_attribute('Czas kursu');
                                        if ($czas) echo '<p class="card-text"><i class="fa fa-clock-o"></i> ' . esc_html($czas) . '</p>';
                                    } ?>

                                    <div class="row g-2 align-items-end">
                                        <div class="col-lg-3">
                                            <p class="card-text mb-2 fw-bold"><?php echo $is_free ? '0&nbsp;zł' : wp_kses_post($price_html); ?></p>
                                        </div>
                                        <!-- <div class="col-lg-4 d-grid">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-light-beige">Zobacz kurs <i class="fa fa-search-plus"></i></a>
                                        </div> -->
                                        <div class="col-lg-5 d-grid">
                                            <?php if (!$is_free && $product): ?>
                                                <form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" class="mt-auto">
                                                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
                                                    <button type="submit" class="btn btn-light-rose w-100">Dodaj do koszyka <i class="fa fa-cart-plus"></i></button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php

                    // ====== STRONA (DOKUMENT PDF) ======
                    elseif ($post_type === 'page') :
                    ?>
                        <div class="col-md-6 mb-4 d-flex">
                            <div class="card h-100 d-flex" style="box-shadow: 0 0 12px #ccc;">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['class' => 'card-img-top img-fluid', 'loading' => 'lazy']);
                                    else : ?><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" class="card-img-top" alt="Brak obrazka" loading="lazy"><?php endif; ?>
                                </a>

                                <div class="p-3 p-lg-4 d-flex flex-column flex-grow-1">
                                    <h5 class="mb-4 pb-3 playfair-display-600 main-kursy--title text-bronze flex-grow-1">
                                        <?php the_title(); ?>
                                    </h5>

                                    <?php if (has_excerpt()) : ?><p class="mb-4"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>

                                    <div class="row justify-content-center justify-content-lg-between">
                                        <div class="col-6 col-lg-4 d-grid d-flex flex-column justify-content-center mb-3 mb-lg-0">
                                            <span class="badge bg-light-rose py-2 text-bronze">Darmowy poradnik</span>
                                        </div>
                                        <div class="col-12 col-lg-5 d-grid">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-light-beige">
                                                Zobacz poradnik <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php

                    // ====== Inne typy (ignorujemy na wszelki wypadek) ======
                    else :
                        continue;
                    endif;

                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center">Brak dostępnych kursów.</p>';
            endif;
            ?>
        </div>
    </div>
</section>