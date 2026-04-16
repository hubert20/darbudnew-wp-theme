<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template O Nas (About) */

get_header();

// HERO - nowe pola ACF
$hero_tlo = get_field('hero_tlo');
$hero_tytul = get_field('hero_tytul') ?: get_the_title();

// Pobierz pozostałe pola ACF
$boxy = get_field('boxy');
$zaufanie_title = get_field('zaufanie_title') ?: '';

// Banner bottom
$banner = get_field('banner_bottom');

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
        <h1 class="playfair-display-600 standard-title-6 text-center text-white header-def-title">
            <?php echo esc_html($hero_tytul); ?>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center chakra-petch-font">', '</p>');
        }
        ?>
    </div>
</section>

<!-- O Nas Section -->
<section id="o-nas-content" class="about-content py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-content__text">
                    <h2 class="about-content__title">Kim jesteśmy?</h2>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content__image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-3 shadow', 'alt' => get_the_title()]); ?>
                    <?php else : ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about-house.jpg" alt="O nas" class="img-fluid rounded-3 shadow">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Boxy z usługami - z ACF repeater -->
<section class="about-boxes py-5">
    <div class="container">
        <?php if ($zaufanie_title) : ?>
        <h2 class="text-center mb-5 about-boxes__main-title"><?php echo esc_html($zaufanie_title); ?></h2>
        <?php endif; ?>
        
        <?php if ($boxy && is_array($boxy)) : ?>
        <div class="row g-4">
            <?php foreach ($boxy as $box) : 
                $tytul = $box['tytul'] ?? '';
                $opis = $box['opis'] ?? '';
                $ikonka = $box['ikonka'] ?? '';
            ?>
            <div class="col-6 col-lg-3">
                <div class="about-box">
                    <div class="about-box__icon">
                        <?php if ($ikonka) : ?>
                            <?php if (is_array($ikonka)) : ?>
                                <img src="<?php echo esc_url($ikonka['url']); ?>" alt="<?php echo esc_attr($tytul); ?>" class="about-box__icon-img">
                            <?php elseif (filter_var($ikonka, FILTER_VALIDATE_URL)) : ?>
                                <img src="<?php echo esc_url($ikonka); ?>" alt="<?php echo esc_attr($tytul); ?>" class="about-box__icon-img">
                            <?php else : ?>
                                <i class="fa <?php echo esc_attr($ikonka); ?>"></i>
                            <?php endif; ?>
                        <?php else : ?>
                            <i class="fa fa-check-circle"></i>
                        <?php endif; ?>
                    </div>
                    <h3 class="about-box__title"><?php echo esc_html($tytul); ?></h3>
                    <p class="about-box__desc"><?php echo esc_html($opis); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <!-- Domyślne boxy -->
        <div class="row g-4">
            <div class="col-6 col-lg-3">
                <div class="about-box">
                    <div class="about-box__icon"><i class="fa fa-home"></i></div>
                    <h3 class="about-box__title">Projektowanie</h3>
                    <p class="about-box__desc">Tworzymy unikalne projekty dostosowane do Twoich potrzeb.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-box">
                    <div class="about-box__icon"><i class="fa fa-clipboard-list"></i></div>
                    <h3 class="about-box__title">Indywidualne podejście</h3>
                    <p class="about-box__desc">Każdemu klientowi poświęcamy pełną uwagę.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-box">
                    <div class="about-box__icon"><i class="fa fa-truck-moving"></i></div>
                    <h3 class="about-box__title">Sprawna realizacja</h3>
                    <p class="about-box__desc">Działamy szybko i profesjonalnie.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-box">
                    <div class="about-box__icon"><i class="fa fa-crane"></i></div>
                    <h3 class="about-box__title">Kompleksowa obsługa</h3>
                    <p class="about-box__desc">Od projektu po montaż.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section - Banner bottom z ACF -->
<?php if ($banner && is_array($banner)) : 
    $banner_tytul = $banner['tytul'] ?? 'Transport i dostawa';
    $banner_tekst = $banner['tekst'] ?? 'Budujemy nie tylko domy – dbamy o to, aby w Twoje ręce trafiły gotowe rozwiązania.';
    $banner_przycisk = $banner['przycisk'] ?? 'Dowiedz się więcej';
    $banner_link = $banner['link'] ?? '/transport/';
    $banner_obraz = $banner['obraz'] ?? '';
?>
<section class="about-cta" <?php if ($banner_obraz) echo 'style="background-image: url(\'' . esc_url(is_array($banner_obraz) ? $banner_obraz['url'] : $banner_obraz) . '\');"'; ?>>
    <div class="about-cta__overlay"></div>
    <div class="about-cta__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="about-cta__title"><?php echo esc_html($banner_tytul); ?></h2>
                    <p class="about-cta__text"><?php echo esc_html($banner_tekst); ?></p>
                    <a href="<?php echo esc_url($banner_link); ?>" class="about-cta__btn">
                        <?php echo esc_html($banner_przycisk); ?> <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else : ?>
<!-- Domyślna sekcja CTA -->
<section class="about-cta" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about-cta.jpg');">
    <div class="about-cta__overlay"></div>
    <div class="about-cta__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="about-cta__title">Transport i dostawa</h2>
                    <p class="about-cta__text">Budujemy nie tylko domy – dbamy o to, aby w Twoje ręce trafiły gotowe rozwiązania.</p>
                    <a href="/transport/" class="about-cta__btn">Dowiedz się więcej <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
