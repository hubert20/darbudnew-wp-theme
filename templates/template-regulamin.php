<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template regulamin */

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

<?php get_footer(); ?>