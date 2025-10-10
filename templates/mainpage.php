<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Mainpage */

get_header();

?>

<!-- Main hero -->
<?php get_template_part('template-parts/main-hero'); ?>

<!-- Main offer slider -->
<?php get_template_part('template-parts/main-offer-slider'); ?>

<!-- Main form -->
<?php get_template_part('template-parts/main-form'); ?>



<?php
while (have_posts()) : the_post();
    the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'darbudnew-wp-theme'));
endwhile;
?>

<?php get_footer(); ?>