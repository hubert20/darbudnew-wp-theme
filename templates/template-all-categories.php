<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Wszystkie kategorie ofert */

get_header();

// Pobierz tło z Customizera lub ACF
$bg_header_image = get_field('background_image');
if (empty($bg_header_image)) {
    $bg_header_image = get_theme_mod('oferta_bg_image');
}

$hero_style = !empty($bg_header_image) ? "background-image: url('" . esc_url($bg_header_image) . "');" : "background-color: #333;";

?>
<!-- Hero top -->
<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="<?php echo $hero_style; ?>">
    <div class="container">
        <h1 class="playfair-petch-font standard-title-3 fw-bold text-center text-white header-def-title ls-2">
            <span class="d-inline-block icon-text icon-text--white px-4">
                Domy mobilne i budownictwo energooszczędne szkieletowe
            </span>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center dosis-font fw-light">', '</p>');
        }
        ?>
    </div>
</section>

<?php
while (have_posts()) : the_post();
    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbudnew-wp-theme'));
endwhile;
?>

<section class="py-lg-5 py-4 all-categories-wrap px-4 ruler-top">
    <div class="mt-3 mt-lg-5"></div>
    <div class="container">
        <div class="row g-4">
            <?php
            // Pobierz wszystkie kategorie oprócz "Bez kategorii"
            $exclude = [];
            if (($term_pl = get_category_by_slug('bez-kategorii')) && !is_wp_error($term_pl)) {
                $exclude[] = (int) $term_pl->term_id;
            }
            if (($term_en = get_category_by_slug('uncategorized')) && !is_wp_error($term_en)) {
                $exclude[] = (int) $term_en->term_id;
            }

            $categories = get_categories([
                'taxonomy'   => 'category',
                'hide_empty' => false, // pokazuj też puste kategorie
                'exclude'    => $exclude,
                'orderby'    => 'name',
                'order'      => 'ASC',
            ]);

            if (!empty($categories)) :
                foreach ($categories as $category) :
                    // Pobierz URL obrazka z wtyczki (jeśli jest)
                    $cat_img_url = (function_exists('z_taxonomy_image_url'))
                        ? z_taxonomy_image_url($category->term_id)
                        : '';
                    
                    // Alternatywnie: spróbuj pobrać z ACF
                    if (empty($cat_img_url) && function_exists('get_field')) {
                        $cat_img_url = get_field('kategoria_zdjecie', $category);
                    }
                    
                    // Liczba postów w kategorii
                    $post_count = $category->count;
            ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-card text-decoration-none d-flex position-relative overflow-hidden" title="<?php echo esc_attr($category->name); ?>">
                            <div class="category-card__image position-relative">
                                <?php if ($cat_img_url) : 
                                    $cat_img_id = attachment_url_to_postid($cat_img_url);
                                    if ($cat_img_id) {
                                        echo wp_get_attachment_image($cat_img_id, 'cat-width', false, [
                                            'class' => 'img-fluid w-100',
                                            'alt' => $category->name,
                                        ]);
                                    } else {
                                        echo '<img src="' . esc_url($cat_img_url) . '" alt="' . esc_attr($category->name) . '" class="img-fluid w-100">';
                                    }
                                ?>
                                <?php else : ?>
                                    <div class="category-card__placeholder bg-light d-flex align-items-center justify-content-center" style="height: 275px;">
                                        <i class="fa fa-folder-open text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="category-card__overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3">
                                    <span class="category-card__btn mb-2">
                                        <span>Zobacz ofertę <i class="fa fa-arrow-right ms-1"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="category-card__content p-3 bg-white border border-top-0">
                                <h3 class="category-card__title playfair-petch-font standard-title-5 mb-2 text-dark">
                                    <?php echo esc_html($category->name); ?>
                                </h3>
                                <?php if (!empty($category->description)) : ?>
                                    <p class="category-card__desc mb-0 text-muted small">
                                        <?php echo wp_trim_words(esc_html($category->description), 15); ?>
                                    </p>
                                <?php endif; ?>
                                <span class="category-card__count badge bg-light text-dark mt-2">
                                    <?php echo $post_count; ?> <?php echo _n('pozycja', 'pozycje', $post_count, 'darbudnew-wp-theme'); ?>
                                </span>
                            </div>
                        </a>
                    </div>
            <?php 
                endforeach;
            else :
            ?>
                <div class="col-12 text-center py-5">
                    <div class="no-categories-message p-5 bg-light rounded">
                        <i class="fa fa-folder-open text-muted mb-3" style="font-size: 4rem;"></i>
                        <h3 class="standard-title-5 mb-3">Brak dostępnych kategorii</h3>
                        <p class="text-muted mb-4">Wkrótce dodamy nowe kategorie ofert.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-4 py-lg-5 bg-black">
    <div class="container">
        <h2 class="subtitle playfair-petch-font text-center standard-title-4 fw-bolder mb-3 mb-lg-4 position-relative text-yellow">
            <span class="d-inline-block icon-text icon-text--yellow px-4">Zainteresowała Cię nasza oferta?</span>
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
