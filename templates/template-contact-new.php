<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template contact */

get_header();

// HERO - nowe pola ACF
$hero_tlo = get_field('hero_tlo');
$hero_tytul = get_field('hero_tytul') ?: get_the_title();

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

<section class="py-lg-5 py-4 bg-white ruler-top">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbud-wp-theme'));
        endwhile;
        ?>
    </div>
</section>

<?php get_footer(); ?>