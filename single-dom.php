<?php
if (!defined('ABSPATH')) exit;

/**
 * Szablon pojedynczego domu/domku
 * Używaj dla postów w kategorii "domy-mobilne"
 */

get_header();

$dom_galeria = get_field('dom_galeria');
$dom_specyfikacja = get_field('dom_specyfikacja');
$dom_skład = get_field('dom_sklad_oferty');
$dom_cena = get_field('dom_cena');
$dom_wymiary = get_field('dom_wymiary');

// Pobierz zdjęcie tła dla hero - kolejność:
// 1. Dedykowane pole ACF dla hero
// 2. Pierwsze zdjęcie z galerii
// 3. Obrazek wyróżniający
// 4. Domyślne tło z Customizera

$hero_bg = '';

// Opcja 1: Dedykowane pole ACF dla tła hero
if (function_exists('get_field')) {
    $hero_bg = get_field('dom_hero_bg');
}

// Opcja 2: Pierwsze zdjęcie z galerii
if (empty($hero_bg) && $dom_galeria && !empty($dom_galeria[0])) {
    $hero_bg = $dom_galeria[0]['url'];
}

// Opcja 3: Obrazek wyróżniający
if (empty($hero_bg) && has_post_thumbnail()) {
    $hero_bg = get_the_post_thumbnail_url(null, 'full');
}

// Opcja 4: Domyślne tło z Customizera (jeśli dodasz takie ustawienie)
if (empty($hero_bg)) {
    $hero_bg = get_theme_mod('single_house_default_bg');
}

// Fallback - kolor tła jeśli brak zdjęcia
$hero_style = !empty($hero_bg) ? "background-image: url('" . esc_url($hero_bg) . "');" : "background-color: #333;";

?>

<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="<?php echo $hero_style; ?>">
    <div class="container">
        <h1 class="playfair-petch-font standard-title-3 fw-bold text-center text-white header-def-title ls-2">
            <span class="d-inline-block icon-text icon-text--white px-4">
                <?php echo esc_html(get_the_title()); ?>
            </span>
        </h1>

        <!-- Kategorie w hero -->
        <?php
        $categories = get_the_category();
        if (!empty($categories)) : ?>
            <div class="house-hero-categories text-center mb-2">
                <?php foreach ($categories as $cat) : ?>
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="badge bg-success text-white text-decoration-none mx-1">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center dosis-font fw-light">', '</p>');
        }
        ?>
    </div>
</section>

<section class="py-4 py-lg-5 single-house-wrap">
    <div class="container">
        <div class="row">
            <!-- Lewa kolumna - Galeria ze Swiperem -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <?php if ($dom_galeria && !empty($dom_galeria)) : ?>
                    <div class="gallery" data-swiper-gallery>
                        <!-- Główna galeria (duże zdjęcie) -->
                        <div class="swiper house-gallery-slider mb-2">
                            <div class="swiper-wrapper">
                                <?php foreach ($dom_galeria as $image) : ?>
                                    <div class="swiper-slide">
                                        <?php
                                        $main_img = !empty($image['sizes']['house-gallery']) ? $image['sizes']['house-gallery'] : $image['sizes']['large'];
                                        ?>
                                        <img src="<?php echo esc_url($main_img); ?>"
                                            alt="<?php echo esc_attr($image['alt'] ?? get_the_title()); ?>"
                                            class="img-fluid w-100 rounded"
                                            loading="eager"
                                            data-no-lazy="1">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-prev gallery-button__prev"></div>
                            <div class="swiper-button-next gallery-button__next"></div>
                        </div>

                        <!-- Miniatury - przewijane (thumbsSlider) -->
                        <?php if (count($dom_galeria) > 1) : ?>
                            <div thumbsSlider="" class="swiper house-gallery-thumbs position-relative">
                                <div class="swiper-wrapper">
                                    <?php foreach ($dom_galeria as $image) : ?>
                                        <div class="swiper-slide d-flex justify-content-center">
                                            <?php
                                            $thumb_img = !empty($image['sizes']['house-thumb']) ? $image['sizes']['house-thumb'] : $image['sizes']['thumbnail'];
                                            ?>
                                            <img src="<?php echo esc_url($thumb_img); ?>"
                                                alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                                                class="img-fluid mx-auto rounded"
                                                loading="eager"
                                                data-no-lazy="1">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-button-prev thumbs-button__prev"></div>
                                <div class="swiper-button-next thumbs-button__next"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php elseif (has_post_thumbnail()) : ?>
                    <div class="house-featured-image">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100 rounded']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Prawa kolumna - Szczegóły -->
            <div class="col-lg-5">
                <div class="house-details-card bg-light p-4 rounded">
                    <h2 class="house-details__title playfair-petch-font standard-title-4 mb-4 text-dark">
                        <?php echo esc_html(get_the_title()); ?>
                    </h2>

                    <!-- Specyfikacja -->
                    <?php if ($dom_specyfikacja) : ?>
                        <div class="house-specs mb-4">
                            <h3 class="house-specs__title standard-title-6 fw-bold mb-3 text-uppercase">Specyfikacja</h3>
                            <ul class="list-unstyled mb-0">
                                <?php if (!empty($dom_specyfikacja['powierzchnia'])) : ?>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fa fa-expand text-green me-2 w-20"></i>
                                        <span><strong>Powierzchnia:</strong> <?php echo esc_html($dom_specyfikacja['powierzchnia']); ?> m²</span>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty($dom_specyfikacja['pokoje'])) : ?>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fa fa-bed text-green me-2 w-20"></i>
                                        <span><strong>Liczba pokoi:</strong> <?php echo esc_html($dom_specyfikacja['pokoje']); ?></span>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty($dom_wymiary['szerokosc']) && !empty($dom_wymiary['dlugosc'])) : ?>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fa fa-arrows-alt text-green me-2 w-20"></i>
                                        <span><strong>Wymiary:</strong> <?php echo esc_html($dom_wymiary['szerokosc']); ?> x <?php echo esc_html($dom_wymiary['dlugosc']); ?> m</span>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty($dom_specyfikacja['rok_produkcji'])) : ?>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fa fa-calendar text-green me-2 w-20"></i>
                                        <span><strong>Rok produkcji:</strong> <?php echo esc_html($dom_specyfikacja['rok_produkcji']); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Cena -->
                    <?php if ($dom_cena) : ?>
                        <div class="house-price mb-4 p-3 bg-white rounded border">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Cena:</span>
                                <?php if (!empty($dom_cena['dodatkowe_info'])) : ?>
                                    <small class="text-muted d-block mt-1"><?php echo esc_html($dom_cena['dodatkowe_info']); ?></small>
                                <?php else: ?>
                                    <span class="house-price__value standard-title-4 fw-bold text-green">
                                        <?php if (!empty($dom_cena['cena_od'])) : ?>
                                            od <?php echo number_format($dom_cena['cena_od'], 0, ',', ' '); ?> zł
                                        <?php elseif (!empty($dom_cena['cena'])) : ?>
                                            <?php echo number_format($dom_cena['cena'], 0, ',', ' '); ?> zł
                                        <?php else : ?>
                                            Zapytaj o cenę
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- CTA -->
                    <div class="d-grid gap-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#offerformModal" data-house="<?php echo esc_attr(get_the_title()); ?>" class="btn btn-outline-dark">
                            ZAPYTAJ O OFERTĘ <i class="fa fa-envelope ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Opis -->
        <?php if (get_the_content()) : ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="house-description">
                        <h3 class="standard-title-5 fw-bold mb-3">Opis</h3>
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- W skład oferty wchodzi - Repeater -->
        <?php if ($dom_skład && !empty($dom_skład)) : ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="house-includes bg-light p-4 rounded">
                        <h3 class="standard-title-5 fw-bold mb-4 text-center">W skład oferty wchodzi</h3>
                        <div class="row g-3">
                            <?php foreach ($dom_skład as $item) :
                                $ikona = !empty($item['ikona']) ? $item['ikona'] : 'fa-check';
                                $tekst = $item['element'] ?? '';
                                if (empty($tekst)) continue;
                            ?>
                                <div class="col-md-6 col-lg-4 d-flex">
                                    <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm flex-grow-1">
                                        <i class="fa <?php echo esc_attr($ikona); ?> text-green me-3" style="font-size: 1.5rem;"></i>
                                        <span><?php echo esc_html($tekst); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="py-4 py-lg-5 bg-bottom-form">
    <div class="container">
        <h2 class="subtitle playfair-petch-font text-center standard-title-4 fw-bolder mb-3 mb-lg-4 position-relative text-yellow">
            <span class="text-white px-4">Masz pytania o ten domek?</span>
        </h2>
        <div class="row justify-content-center align-items-end">
            <div class="col-lg-5 ps-lg-0">
                <div class="p-4 bg-white contact-form-box">
                    <?php echo apply_shortcodes('[contact-form-7 id="3524678" title="Formularz kontaktowy"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>