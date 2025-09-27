<?php
if (!defined('ABSPATH')) exit;

/* 
Template Name: Template product details 
Template Post Type: post
*/

get_header();

$bg_header_image = get_field('background_product');
$image_config = get_field('konfiguracje');

?>
<!-- Hero top -->
<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-image: url('<?php echo $bg_header_image; ?>')">
    <div class="container">
        <h1 class="playfair-petch-font standard-title-3 fw-bold text-center text-white header-def-title ls-2">
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

<section class="bg-white py-4 py-lg-5 ruler-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mb-3 mb-lg-0">
                <!-- Gallery slider -->
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
            <div class="col-lg-5">
                <!-- Descriptions product-->
                <?php
                while (have_posts()) : the_post();
                    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'mariolahairstylist-wp-theme'));
                endwhile;
                ?>
                <div class="ps-lg-4">
                    <div class="row justify-content-center">
                        <div class="col-10 col-lg-7 d-grid mb-3">
                            <a data-category="form-details" data-bs-toggle="modal" data-bs-target="#offerformModal" class="btn btn btn--style-2">
                                ZŁÓŻ ZAMÓWIENIE <i class="fa fa-check-square-o"></i>
                            </a>
                        </div>
                        <div class="col-10 col-lg-7 d-grid">
                            <a href="/szafy-przesuwne/" class="btn btn--style-3"
                                title="Zobacz wszystkie systemy szaf przesuwnych SENATOR">
                                WSZYSTKIE SYSTEMY SENATOR <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- tabs profil -->
    <ul class="tabs-details-nav nav nav-tabs mt-1 mb-2 mt-lg-4 mb-lg-5 justify-content-center playfair-petch-font" id="pills-tab" role="tablist">
        <!-- Kolory profili nav-tabs -->
        <li class="nav-item p-1 p-lg-0 col">
            <a class="nav-link text-center active" id="color-profil-tab" data-bs-toggle="pill" href="#color-profil" role="tab" aria-controls="color-profil" aria-selected="true">Kolory profili</a>
        </li>
        <!-- Wypełnienia profili nav-tabs -->
        <li class="nav-item p-1 p-lg-0 col">
            <a class="nav-link text-center" id="filling-profil-tab" data-bs-toggle="pill" href="#filling-profil" role="tab" aria-controls="filling-profil" aria-selected="false">Wypełnienia profili</a>
        </li>
        <!-- Materiały do pobrania nav-tabs -->
        <li class="nav-item p-1 p-lg-0 col">
            <a class="nav-link text-center" id="materials-profil-tab" data-bs-toggle="pill" href="#materials-profil" role="tab" aria-controls="materials-profil" aria-selected="false">Materiały do pobrania</a>
        </li>
        <!-- Wybrane konfiguracje nav-tabs -->
        <li class="nav-item p-1 p-lg-0 col">
            <a class="nav-link text-center" id="config-profil-tab" data-bs-toggle="pill" href="#config-profil" role="tab" aria-controls="config-profil" aria-selected="false">Wybrane konfiguracje</a>
        </li>
    </ul>

    <!-- Tabcontent descriptions products -->
    <div class="tab-content form-helping mb-3 mb-lg-5" id="pills-tabContent">
        <!-- Kolory profili tab-content -->
        <div class="tab-pane fade active show color-profil" id="color-profil" role="tabpanel" aria-labelledby="color-profil-tab">
            <?php if (have_rows('kolory')) : ?>
                <div class="row">
                    <?php
                    while (have_rows('kolory')) : the_row();
                        $title_color = get_sub_field('title');
                        $image_color = get_sub_field('image');
                    ?>
                        <div class="col-6 col-md-2 text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-center mb-2">
                                    <div class="color-profil__item text-center mb-2 p-2 bg-white">
                                        <?php if ($image_color) : ?>
                                            <img src="<?php echo $image_color['url']; ?>" alt="<?php echo $image_color['alt']; ?>" class="img-fluid mx-auto mb-2">
                                        <?php endif; ?>
                                        <p class="mb-0 lh-13"><?php echo $title_color; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- Wypełnienia profili tab-content -->
        <div class="tab-pane fade filling-profil" id="filling-profil" role="tabpanel" aria-labelledby="filling-profil-tab">
            <?php if (have_rows('wypelnienia_profili')) : ?>
                <div class="row">
                    <?php
                    while (have_rows('wypelnienia_profili')) : the_row();
                        $title_filling = get_sub_field('title');
                        $image_filling = get_sub_field('image');
                    ?>
                        <div class="col-6 col-md-2 text-center d-flex">
                            <div class="row justify-content-center flex-grow-1 flex-column align-items-center">
                                <div class="col-lg-10 text-center mb-2 d-flex flex-grow-1 flex-column">
                                    <div class="filling-profil__item text-center mb-2 p-2 bg-white flex-grow-1">
                                        <?php if ($image_filling) : ?>
                                            <img src="<?php echo $image_filling['url']; ?>" alt="<?php echo $image_filling['alt']; ?>" class="img-fluid mx-auto mb-2">
                                        <?php endif; ?>
                                        <p class="mb-0 lh-12"><?php echo $title_filling; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- Materiały do pobrania tab-content -->
        <div class="tab-pane fade materials-profil" id="materials-profil" role="tabpanel" aria-labelledby="materials-profil-tab">
            <!-- Treści/pliki do pobrania -->
            <?php if (have_rows('materialy')) : ?>
                <div class="row justify-content-center">
                    <?php
                    while (have_rows('materialy')) : the_row();
                        $file = get_sub_field('plik_do_pobrania');
                        $titlefile = get_sub_field('tytul_pliku');
                    ?>
                        <?php if ($file) : ?>
                            <div class="col-lg-3 d-grid mb-3 mb-lg-0">
                                <a class="btn btn btn--style-2" href="<?php echo $file['url']; ?>" target="_blank" title="<?php echo $titlefile; ?>" download>
                                    <?php echo $titlefile; ?> <i class="fa fa-download"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- Konfiguracje tab-content -->
        <div class="tab-pane fade config-profil" id="config-profil" role="tabpanel" aria-labelledby="config-profil-tab">
            <!-- Wybrane konfiguracje -->
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <?php if ($image_config) : ?>
                        <img src="<?php echo $image_config['url']; ?>" alt="<?php echo $image_config['alt']; ?>" class="img-fluid mx-auto">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>