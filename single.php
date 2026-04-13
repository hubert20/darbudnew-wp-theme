<?php
if (!defined('ABSPATH')) exit;

/**
 * Szablon pojedynczego wpisu
 * Sprawdza czy to dom (mobilny/modułowy) i wyświetla odpowiedni layout
 */

// Sprawdź czy post jest w kategorii domów
$categories = get_the_category();
$is_house = false;

if ($categories) {
    foreach ($categories as $category) {
        if ($category->slug === 'domy-mobilne' || $category->slug === 'domy-modulowe') {
            $is_house = true;
            break;
        }
    }
}

// Jeśli to dom - użyj layoutu z single-dom.php
if ($is_house) {
    // Użyj locate_template zamiast include - lepsza kompatybilność z WordPressem
    $template = locate_template('single-dom.php', false, false);
    if ($template) {
        require $template;
        exit; // Zatrzymaj dalsze wykonywanie
    }
}

// Standardowy layout dla zwykłych postów (blog) lub fallback
get_header();
?>

<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-color: #333;">
    <div class="container">
        <h1 class="playfair-petch-font standard-title-3 fw-bold text-center text-white header-def-title ls-2">
            <span class="d-inline-block icon-text icon-text--white px-4">
                <?php the_title(); ?>
            </span>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center dosis-font fw-light">', '</p>');
        }
        ?>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                while (have_posts()) : the_post();
                    if (has_post_thumbnail()) :
                        the_post_thumbnail('large', ['class' => 'img-fluid mb-4']);
                    endif;
                    ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
