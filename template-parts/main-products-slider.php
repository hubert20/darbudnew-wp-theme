<!-- Slider with products -->
<section class="main-products-slider position-relative p-4 py-lg-5 overflow-hidden" id="main-products-offer-slider">
    <h2 class="text-center mb-4 mb-lg-5 playfair-display-400">
        <span class="d-block icon-text icon-text--white text-magenta lobster-font mb-2"></span>
        <span class="d-block icon-text icon-text--white standard-title-5 mb-2"></span>
        <div class="text-center">
            <img src="" class="flowers-heading-1" alt="">
        </div>
    </h2>
    <div class="swiper swiper-main-products">
        <div class="swiper-wrapper">
            <?php
            $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
            ));

            if (!empty($categories) && !is_wp_error($categories)) : ?>
                <?php foreach ($categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_src = wp_get_attachment_image_src($thumbnail_id, 'medium_large');
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $category_link = get_term_link($category);
                ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($category_link); ?>" class="main-products-slider__item position-relative text-decoration-none d-block p-3" title="<?php echo esc_html($category->name); ?>">
                            <span class="btn btn-double-border btn-style main-products-slider__item--btn text-dark py-3" style="border-radius: 3px;">
                                <span class="btn-style-border--text fw-bold text-uppercase z-3">Zobacz produkty <i class="fa fa-angle-right"></i></span>
                                <span class="btn-style--border btn-style--first bg-white"></span>
                                <span class="btn-style--border btn-style--second bg-white"></span>
                            </span>
                            <?php if (!empty($image_src)) : ?>
                                <img src="<?php echo esc_url($image_src[0]); ?>" class="img-fluid mb-3" alt="<?php echo esc_attr($category->name); ?>">
                            <?php endif; ?>
                            <h3 class="main-products-slider__item--title text-decoration-none d-block text-dark lobster-font text-center mb-0 fw-light">
                                <?php echo esc_html($category->name); ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="position-relative d-flex align-items-center justify-content-center">
        <div class="swiper-main-products__prev swiper-button-prev"></div>
        <div class="swiper-main-products__next swiper-button-next"></div>
    </div>
</section>