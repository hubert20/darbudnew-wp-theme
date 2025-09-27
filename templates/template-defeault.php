<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template defeault */

get_header();

get_template_part('template-parts/header-image');

//Banner shop
$banner_img_desktop = get_field('banner_shop_desktop', 16);
$banner_img_mobile = get_field('banner_shop_mobile', 16);

?>

<div class="container py-4 py-lg-5">
    <?php
    while (have_posts()) : the_post();
        the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbud-wp-theme'));
    endwhile;
    ?>
</div>

<section class="mb-4">
    <div class="container text-center">
        <!-- Banner desktop -->
        <?php if ($banner_img_desktop) : ?>
            <a href="/sklep/" title="" class="d-none d-lg-block">
                <img src="<?php echo $banner_img_desktop['url']; ?>" alt="<?php echo $banner_img_desktop['alt']; ?>" class="img-fluid mx-auto d-none d-lg-block">
            </a>
        <?php endif; ?>

        <!-- Banner mobile -->
        <?php if ($banner_img_mobile) : ?>
            <a href="/sklep/" title="" class="d-block d-lg-none">
                <img src="<?php echo $banner_img_mobile['url']; ?>" alt="<?php echo $banner_img_mobile['alt']; ?>" class="img-fluid mx-auto d-block d-lg-none">
            </a>
        <?php endif; ?>
    </div>
</section>


<?php get_footer(); ?>