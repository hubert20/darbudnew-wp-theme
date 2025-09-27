<?php
if (!defined('ABSPATH')) exit;

/* Template Name: Template News */

get_header();

$bg_header_image = get_field('background_image');

?>
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

<section class="py-lg-5 py-4 news-wrap">
    <div class="mt-3 mt-lg-5"></div>
    <div class="container">
        <div class="row justify-content-center">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('category_name' => 'blog', 'post_type' => 'post', 'posts_per_page' => 9, 'paged' => $paged);
            $wp_query = new WP_Query($args);
            $counter_news = 0;
            ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-4 d-flex mb-3 mb-lg-4 news-item news-item--<?php echo $counter_news; ?>">
                    <div class="list-news__item d-flex flex-column flex-grow-1">
                        <?php if (has_post_thumbnail($post->ID)) : ?>
                            <?php
                            $imgID  = get_post_thumbnail_id($post->ID);
                            $image  = wp_get_attachment_image_src($imgID, 'news-width', false, '');
                            $imgAlt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
                            ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="d-block">
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo $imgAlt; ?>" class="img-fluid main-news__img">
                            </a>
                        <?php endif; ?>
                        <div class="p-3 p-lg-4 main-news__item-cnt position-relative d-flex flex-grow-1 flex-column">
                            <?php if ('post' === get_post_type()) : ?>
                                <span class="main-news__item-date py-1"><?php echo get_the_date(); ?></span>
                            <?php endif; ?>
                            <div class="main-news__item-box d-flex flex-column flex-grow-1">
                                <p class="main-news__item-title-post playfair-petch-font fw-bold lh-12 flex-grow-1">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="text-dark">
                                        <?php echo wp_trim_words(get_the_title(), 15, ' [...]'); ?>
                                    </a>
                                </p>
                                <p class="text-right mb-0">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="text-dark bg-yellow py-1 px-2" title="<?php echo esc_attr(get_the_title()); ?>" style="border-radius: 3px;">
                                        Czytam <i class="fa fa-angle-right"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $counter_news++; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="container">
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total' => $wp_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'format' => '?paged=%#%',
                'show_all' => false,
                'type' => 'plain',
                'end_size' => 2,
                'mid_size' => 1,
                'prev_next' => true,
                'prev_text' => sprintf('<i></i> %1$s', __('< Nowsze', 'text-domain')),
                'next_text' => sprintf('%1$s <i></i>', __('Starsze >', 'text-domain')),
                'add_args' => false,
                'add_fragment' => '',
            ));
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>