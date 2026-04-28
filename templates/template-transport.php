<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template Transport */

get_header();

// HERO - nowe pola ACF
$hero_tlo = get_field('hero_tlo');
$hero_tytul = get_field('hero_tytul') ?: get_the_title();

// Pobierz pozostałe pola ACF
$etapy_tytul = get_field('etapy_transportu_tytul') ?: 'Transport i dostawa';
$boxy = get_field('boxy');

// Ustaw tło hero
$hero_bg = '';
if ($hero_tlo) {
    $hero_bg = is_array($hero_tlo) ? $hero_tlo['url'] : $hero_tlo;
} elseif (has_post_thumbnail()) {
    $hero_bg = get_the_post_thumbnail_url(null, 'full');
}

?>

<!-- Hero Section - z tymi samymi klasami co header-image-defeault -->
<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" <?php if ($hero_bg) echo 'style="background-image: url(\'' . esc_url($hero_bg) . '\');"'; ?>>
    <div class="container">
        <h1 class="playfair-petch-font standard-title-3 fw-bold text-center text-white header-def-title ls-2">
            <?php echo esc_html($hero_tytul); ?>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center chakra-petch-font">', '</p>');
        }
        ?>
    </div>
</section>

<!-- Main Content Section -->
<section id="transport-content" class="transport-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Treść ogólna z edytora -->
                <div class="transport-content__text mb-5">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Tytuł etapów -->
                <?php if ($etapy_tytul) : ?>
                <h2 class="transport-section-title text-center mb-4"><?php echo esc_html($etapy_tytul); ?></h2>
                <?php endif; ?>

                <!-- Boxy z usługami - z ACF repeater -->
                <?php if ($boxy && is_array($boxy)) : ?>
                <div class="transport-boxes row g-4 mb-5">
                    <?php foreach ($boxy as $box) : 
                        $tytul = $box['tytul'] ?? '';
                        $opis = $box['opis'] ?? '';
                        $ikonka = $box['ikonka'] ?? '';
                    ?>
                    <div class="col-6 col-lg-3">
                        <div class="transport-box">
                            <div class="transport-box__icon">
                                <?php if ($ikonka) : ?>
                                    <?php if (is_array($ikonka)) : ?>
                                        <img src="<?php echo esc_url($ikonka['url']); ?>" alt="<?php echo esc_attr($tytul); ?>" class="transport-box__icon-img">
                                    <?php elseif (filter_var($ikonka, FILTER_VALIDATE_URL)) : ?>
                                        <img src="<?php echo esc_url($ikonka); ?>" alt="<?php echo esc_attr($tytul); ?>" class="transport-box__icon-img">
                                    <?php else : ?>
                                        <i class="fa <?php echo esc_attr($ikonka); ?>"></i>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <i class="fa fa-cube"></i>
                                <?php endif; ?>
                            </div>
                            <h3 class="transport-box__title"><?php echo esc_html($tytul); ?></h3>
                            <p class="transport-box__desc"><?php echo esc_html($opis); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                <!-- Domyślne boxy jeśli brak ACF -->
                <div class="transport-boxes row g-4 mb-5">
                    <div class="col-6 col-lg-3">
                        <div class="transport-box">
                            <div class="transport-box__icon"><i class="fa fa-box-open"></i></div>
                            <h3 class="transport-box__title">Przygotowanie</h3>
                            <p class="transport-box__desc">Odpowiednie zabezpieczenie konstrukcji do transportu.</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="transport-box">
                            <div class="transport-box__icon"><i class="fa fa-clipboard-check"></i></div>
                            <h3 class="transport-box__title">Logistyka</h3>
                            <p class="transport-box__desc">Dobór najlepszego rozwiązania transportowego w zależności od lokalizacji.</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="transport-box">
                            <div class="transport-box__icon"><i class="fa fa-truck"></i></div>
                            <h3 class="transport-box__title">Dostawa</h3>
                            <p class="transport-box__desc">Bezpieczny transport na miejsce inwestycji.</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="transport-box">
                            <div class="transport-box__icon"><i class="fa fa-truck-loading"></i></div>
                            <h3 class="transport-box__title">Montaż</h3>
                            <p class="transport-box__desc">Wsparcie przy rozładunku i ustawieniu konstrukcji.</p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Zielony box informacyjny - opcjonalnie z ACF -->
                <?php 
                $info_tytul = get_field('info_box_tytul') ?: 'Transport dopasowany do lokalizacji';
                $info_tekst = get_field('info_box_tekst') ?: 'Koszt i organizacja transportu zależą od odległości inwestycji. W przypadku dalszych realizacji korzystamy z firm transportowych działających lokalnie, co pozwala zoptymalizować koszty i usprawnić cały proces dostawy.';
                ?>
                <div class="transport-info-box">
                    <div class="transport-info-box__icon">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <div class="transport-info-box__content">
                        <h3 class="transport-info-box__title"><?php echo esc_html($info_tytul); ?></h3>
                        <p class="transport-info-box__text"><?php echo esc_html($info_tekst); ?></p>
                    </div>
                </div>

                <!-- Banner bottom - jeśli istnieje w ACF -->
                <?php 
                $banner = get_field('banner_bottom');
                if ($banner && is_array($banner)) : 
                    $banner_tytul = $banner['tytul'] ?? '';
                    $banner_tekst = $banner['tekst'] ?? '';
                    $banner_przycisk = $banner['przycisk'] ?? '';
                    $banner_link = $banner['link'] ?? '#';
                    $banner_obraz = $banner['obraz'] ?? '';
                    
                    if ($banner_obraz || $banner_tytul) :
                ?>
                <section class="transport-banner mt-5" <?php if ($banner_obraz) echo 'style="background-image: url(\'' . esc_url(is_array($banner_obraz) ? $banner_obraz['url'] : $banner_obraz) . '\');"'; ?>>
                    <div class="transport-banner__overlay"></div>
                    <div class="transport-banner__content">
                        <?php if ($banner_tytul) : ?>
                            <h2 class="transport-banner__title"><?php echo esc_html($banner_tytul); ?></h2>
                        <?php endif; ?>
                        <?php if ($banner_tekst) : ?>
                            <p class="transport-banner__text"><?php echo esc_html($banner_tekst); ?></p>
                        <?php endif; ?>
                        <?php if ($banner_przycisk) : ?>
                            <a href="<?php echo esc_url($banner_link); ?>" class="transport-banner__btn"><?php echo esc_html($banner_przycisk); ?> <i class="fa fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; endif; ?>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
