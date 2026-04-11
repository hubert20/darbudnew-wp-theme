<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Domy mobilne - Listing */

get_header();

$bg_header_image = get_field('background_image');

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

<?php
while (have_posts()) : the_post();
    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbudnew-wp-theme'));
endwhile;
?>

<section class="py-lg-5 py-4 mobile-houses-wrap px-4">
    <div class="mt-3 mt-lg-5"></div>
    <div class="container">
        <div class="row g-4">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $query = new WP_Query(array(
                'category_name' => 'domy-mobilne',
                'posts_per_page' => 12,
                'paged' => $paged
            ));
            
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $house_specs = get_field('dom_specyfikacja');
            ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="mobile-house-card text-decoration-none d-block position-relative overflow-hidden" title="<?php echo esc_attr(get_the_title()); ?>">
                            <div class="mobile-house-card__image position-relative">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('cat-width', ['class' => 'img-fluid w-100']); ?>
                                <?php else : ?>
                                    <div class="mobile-house-card__placeholder bg-light d-flex align-items-center justify-content-center" style="height: 275px;">
                                        <i class="fa fa-home text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="mobile-house-card__overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3">
                                    <span class="mobile-house-card__btn d-inline-block mb-2">
                                        <span>Zobacz szczegóły <i class="fa fa-arrow-right ms-1"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="mobile-house-card__content p-3 bg-white border border-top-0">
                                <h3 class="mobile-house-card__title playfair-petch-font standard-title-5 mb-2 text-dark">
                                    <?php echo esc_html(get_the_title()); ?>
                                </h3>
                                <?php if ($house_specs && !empty($house_specs['powierzchnia'])) : ?>
                                    <p class="mobile-house-card__specs mb-0 text-muted">
                                        <i class="fa fa-expand me-1"></i>
                                        <?php echo esc_html($house_specs['powierzchnia']); ?> m²
                                    </p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
            <?php 
                endwhile;
                
                // Pagination
                if ($query->max_num_pages > 1) :
            ?>
                <div class="col-12 mt-4">
                    <nav class="pagination-wrap d-flex justify-content-center">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $query->max_num_pages,
                            'prev_text' => '<i class="fa fa-chevron-left"></i> Poprzednia',
                            'next_text' => 'Następna <i class="fa fa-chevron-right"></i>',
                            'mid_size' => 2,
                            'type' => 'list'
                        ));
                        ?>
                    </nav>
                </div>
            <?php
                endif;
                
                wp_reset_postdata();
            else :
            ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Brak dostępnych domków w tej kategorii.</p>
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
        <div class="row justify-content-center">
            <div class="col-10 col-lg-3 d-grid">
                <a data-category="form-mobile-houses" data-bs-toggle="modal" data-bs-target="#offerformModal" class="btn btn--style-2">
                    ZAPYTAJ O OFERTĘ <i class="fa fa-check-square-o"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
