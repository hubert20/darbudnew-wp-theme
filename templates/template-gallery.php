<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template gallery */

get_header();

$bg_header_image = get_field('background_image');

?>

<!-- Hero top -->
<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-image: url('<?php echo $bg_header_image; ?>')">
    <div class="container">
        <h1 class="lobster-font standard-title-3 text-center text-white header-def-title ls-2">
            <span class="d-inline-block icon-text icon-text--white px-4">
                <?php echo esc_html(get_the_title()); ?>
            </span>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center dosis-font fw-light">', '</p>');
        }
        ?>
    </div>
</section>

<!-- Gallery -->
<section class="gallery-handicrafts py-4 py-lg-5 position-relative">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4">
                <?php
                while (have_posts()) : the_post();
                    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'mariolahairstylist-wp-theme'));
                endwhile;
                ?>
            </div>
            <div class="col-lg-8">
                <?php if (have_rows('slider')) : ?>
                    <div class="gallery">
                        <!-- Główna galeria -->
                        <div class="swiper gallery-slider mb-2">
                            <div class="swiper-wrapper">
                                <?php
                                while (have_rows('slider')) : the_row();
                                    $image_slider = get_sub_field('image');
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo esc_url($image_slider['sizes']['large']); ?>" alt="<?php echo esc_attr($image_slider['alt']); ?>" class="img-fluid mx-auto">
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            <div class="swiper-button-prev gallery-button__prev"></div>
                            <div class="swiper-button-next gallery-button__next"></div>
                        </div>
                        <!-- Miniatury -->
                        <div thumbsSlider="" class="swiper gallery-thumbs">
                            <div class="swiper-wrapper">
                                <?php
                                while (have_rows('slider')) : the_row();
                                    $image_slider = get_sub_field('image');
                                ?>
                                    <div class="swiper-slide d-flex justify-content-center">
                                        <img src="<?php echo esc_url($image_slider['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image_slider['alt']); ?>" class="img-fluid mx-auto">
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>