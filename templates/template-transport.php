<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template Transport */

get_header();

// HERO - nowe pola ACF
$hero_tlo = get_field('hero_tlo');
$hero_tytul = get_field('hero_tytul') ?: get_the_title();
$hero_podtytul = get_field('hero_podtytul') ?: 'Bezpiecznie dostarczamy nasze realizacje na miejsce inwestycji';

// Pobierz pozostałe pola ACF
$etapy_tytul = get_field('etapy_transportu_tytul') ?: 'Transport i dostawa';
$boxy = get_field('boxy');

?>

<!-- Hero Section - z dedykowanymi polami ACF -->
<section class="page-hero" style="background-image: url('<?php 
    if ($hero_tlo) {
        echo esc_url(is_array($hero_tlo) ? $hero_tlo['url'] : $hero_tlo);
    } elseif (has_post_thumbnail()) {
        echo esc_url(get_the_post_thumbnail_url(null, 'full'));
    } else {
        echo get_stylesheet_directory_uri() . '/assets/images/transport-hero.jpg';
    }
?>');">
    <div class="page-hero__overlay"></div>
    <div class="page-hero__content">
        <div class="container">
            <h1 class="page-hero__title"><?php echo esc_html($hero_tytul); ?></h1>
            <?php if ($hero_podtytul) : ?>
            <p class="page-hero__subtitle"><?php echo nl2br(esc_html($hero_podtytul)); ?></p>
            <?php endif; ?>
            <a href="#transport-content" class="page-hero__btn">
                <i class="fa fa-arrow-down"></i>
            </a>
        </div>
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
