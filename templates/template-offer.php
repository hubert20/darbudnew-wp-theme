<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template Offer */

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
    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbud-wp-theme'));
endwhile;
?>

<section class="py-lg-5 py-4 offer-wrap px-4 ruler-top">
    <div class="mt-3 mt-lg-5"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php
            $query = new WP_Query(array('category_name' => 'szafy-przesuwne', 'posts_per_page' => 10));
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $subtitle = get_field('wypelnienie_subtitle');
                    $type_system = get_field('rodzaj_systemu');
            ?>
                    <div class="col-lg-3 mb-3 overflow-hidden">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="main-products-slider__item position-relative text-decoration-none d-block" title="<?php echo esc_attr(get_the_title()); ?>">
                            <span class="main-products-slider__item--btn">
                                <span>Czytam opis ></span>
                            </span>
                            <span class="main-products-slider__item--statictitle playfair-petch-font fw-lighter mt-2 lh-11 text-center text-white">
                                <?php echo $type_system; ?>
                            </span>
                            <h3 class="main-products-slider__item--title text-decoration-none d-block text-white standard-title-5 text-center playfair-petch-font">
                                <?php echo esc_attr(get_the_title()); ?>
                                <span class="main-products-slider__item--subtitle text-yellow dosis-font fw-lighter"><?php echo $subtitle; ?></span>
                            </h3>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                            <?php endif; ?>
                        </a>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<section class="py-4 py-lg-5 bg-black">
    <div class="container">
        <h2 class="subtitle playfair-petch-font text-center standard-title-4 fw-bolder mb-3 mb-lg-4 position-relative text-yellow">
            <span class="d-inline-block icon-text icon-text--yellow px-4">Skorzystaj z formularza kontaktowego</span>
        </h2>
        <div class="row justify-content-center">
            <div class="col-10 col-lg-3 d-grid">
                <a data-category="form-basic" data-bs-toggle="modal" data-bs-target="#offerformModal" class="btn btn btn--style-2">WYŚLIJ ZAPYTANIE <i class="fa fa-check-square-o"></i></a>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>