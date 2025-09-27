<?php
$bg_header_image = get_field('background_image');
?>

<section class="d-flex flex-column align-items-center justify-content-center header-image-defeault" style="background-image: url('<?php echo $bg_header_image; ?>')">
    <div class="container">
        <h1 class="playfair-display-600 standard-title-6 text-center text-white header-def-title">
            <?php the_title(); ?>
        </h1>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="mb-0 breadcrumbs text-center chakra-petch-font">', '</p>');
        }
        ?>
    </div>
</section>