<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template About */

get_header();

$bg_header_image = get_field('background_image');

?>

<?php if ($bg_header_image) : ?>
    <!-- Hero top -->
    <section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-image: url('<?php echo $bg_header_image; ?>')">
        <div class="container">
            <h1 class="lobster-font standard-title-3 text-center text-white header-def-title ls-2">
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
<?php endif; ?>

<section class="py-4 py-lg-5 about-wrap bg-white position-relative mb-4">
    <?php
    while (have_posts()) : the_post();
        the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbud-wp-theme'));
    endwhile;
    ?>
</section>

<!-- Newsletter -->
<section class="main-newsletter p-relative">
    <div class="custom-shape-divider-bottom-1743325413 d-none d-xl-block">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
    </div>
    <div class="main-newsletter--box p-3 p-lg-4">
        <h2 class="text-center mb-3 mb-lg-4 standard-title-4 text-white lobster-font">
            <span class="d-inline-block icon-text px-4">Newsletter</span>
            <div class="text-center">
                <img src="https://darbud.pl/wp-content/uploads/2025/06/flowers-200.png" class="flowers-heading-1" alt="">
            </div>
        </h2>
        <p class="text-center text-white mb-3 mb-lg-4">
            Dołącz do naszego newslettera i bądź na bieżąco z nowościami, inspiracjami oraz wyjątkowymi promocjami. <br> Zapisz się już dziś i daj się oczarować magii rękodzieła!
        </p>
        <div class="row justify-content-center">
            <div class="col-lg-3 d-grid">
                <a data-bs-toggle="modal" data-bs-target="#NewsletterformModal" class="btn btn-double-border btn-style btn-style--large btn-style--outline-white" title="Zapisz się" style="border-radius: 3px;">
                    <span class="btn-style--border btn-style--border-white btn-style--first"></span>
                    <span class="btn-style--border btn-style--border-white btn-style--second"></span>
                    <span class="btn-style-border--text fw-bold text-uppercase">Zapisz się <i class="fa fa-envelope"></i> </span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>