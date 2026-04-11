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

?>

<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>')">
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

<section class="py-4 py-lg-5 single-house-wrap">
    <div class="container">
        <div class="row">
            <!-- Lewa kolumna - Galeria -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <?php if ($dom_galeria && !empty($dom_galeria)) : ?>
                    <!-- Główne zdjęcie -->
                    <div class="house-gallery-main mb-3 position-relative">
                        <a href="<?php echo esc_url($dom_galeria[0]['url']); ?>" data-fancybox="gallery" data-caption="<?php echo esc_attr($dom_galeria[0]['caption'] ?? get_the_title()); ?>">
                            <img src="<?php echo esc_url($dom_galeria[0]['sizes']['large']); ?>" 
                                 alt="<?php echo esc_attr($dom_galeria[0]['alt'] ?? get_the_title()); ?>" 
                                 class="img-fluid w-100 rounded">
                        </a>
                        <div class="house-gallery__zoom position-absolute top-50 start-50 translate-middle">
                            <i class="fa fa-search-plus text-white" style="font-size: 2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></i>
                        </div>
                    </div>
                    
                    <!-- Miniatury -->
                    <?php if (count($dom_galeria) > 1) : ?>
                    <div class="house-gallery-thumbs row g-2">
                        <?php foreach ($dom_galeria as $index => $image) : 
                            if ($index === 0) continue; // Pomijamy pierwsze (główne)
                        ?>
                            <div class="col-4 col-sm-3">
                                <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo esc_attr($image['caption'] ?? ''); ?>" class="d-block position-relative">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" 
                                         alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" 
                                         class="img-fluid w-100 rounded hover-opacity">
                                    <?php if ($index === 3 && count($dom_galeria) > 4) : ?>
                                        <div class="house-gallery__more position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 rounded d-flex align-items-center justify-content-center">
                                            <span class="text-white fw-bold">+<?php echo count($dom_galeria) - 4; ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php if ($index === 3) break; // Pokazujemy max 4 miniatury (bez pierwszego) ?>
                        <?php endforeach; ?>
                        
                        <!-- Ukryte linki do pozostałych zdjęć dla fancybox -->
                        <?php foreach ($dom_galeria as $index => $image) : 
                            if ($index <= 3) continue;
                        ?>
                            <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo esc_attr($image['caption'] ?? ''); ?>" class="d-none"></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
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
                            <span class="house-price__value standard-title-4 fw-bold text-green">
                                <?php if (!empty($dom_cena['cena_od'])) : ?>
                                    od <?php echo number_format($dom_cena['cena_od'], 0, ',', ' '); ?> zł
                                <?php elseif (!empty($dom_cena['cena'])) : ?>
                                    <?php echo number_format($dom_cena['cena'], 0, ',', ' '); ?> zł
                                <?php else : ?>
                                    Zapytaj o cenę
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if (!empty($dom_cena['dodatkowe_info'])) : ?>
                            <small class="text-muted d-block mt-1"><?php echo esc_html($dom_cena['dodatkowe_info']); ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- CTA -->
                    <div class="d-grid gap-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#offerformModal" data-house="<?php echo esc_attr(get_the_title()); ?>" class="btn btn--style-2">
                            ZAPYTAJ O OFERTĘ <i class="fa fa-envelope ms-1"></i>
                        </a>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_template('template-domy-mobilne.php'))); ?>" class="btn btn-outline-dark">
                            <i class="fa fa-arrow-left me-1"></i> POWRÓT DO LISTY
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
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
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

<section class="py-4 py-lg-5 bg-black">
    <div class="container">
        <h2 class="subtitle playfair-petch-font text-center standard-title-4 fw-bolder mb-3 mb-lg-4 position-relative text-yellow">
            <span class="d-inline-block icon-text icon-text--yellow px-4">Masz pytania o ten domek?</span>
        </h2>
        <div class="row justify-content-center">
            <div class="col-10 col-lg-3 d-grid">
                <a data-category="form-single-house" data-bs-toggle="modal" data-bs-target="#offerformModal" class="btn btn--style-2">
                    SKONTAKTUJ SIĘ Z NAMI <i class="fa fa-check-square-o"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
