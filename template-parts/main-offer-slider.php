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
    $categories = get_categories(array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ));
    ?>

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php if (! empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="swiper-slide">
                        <a class="d-block text-decoration-none"
                            href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <h6 class="mb-1"><?php echo esc_html($category->name); ?></h6>
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