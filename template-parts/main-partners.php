<!-- Nasi partnerzy -->
<?php if (have_rows('partnerzy')) : ?>
    <section class="partners-slider-section container my-5">
        <div class="swiper partners-slider">
            <div class="swiper-wrapper">
                <?php while (have_rows('partnerzy')) : the_row();
                    $logo = get_sub_field('partner_logo');
                ?>
                    <?php if ($logo) : ?>
                        <div class="swiper-slide text-center">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="img-fluid partners-slider__img">
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>

            <!-- Nawigacja -->
            <div class="swiper-button-prev partners-slider__prev"></div>
            <div class="swiper-button-next partners-slider__next"></div>

            <!-- Paginacja -->
            <div class="swiper-pagination partners-slider__pagination"></div>
        </div>
    </section>
<?php endif; ?>