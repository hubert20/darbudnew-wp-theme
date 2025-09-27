<?php
$banner_img_desktop = get_field('banner_shop_desktop');
$banner_img_mobile = get_field('banner_shop_mobile');
?>

<section class="py-4">
    <div class="container text-center">
        <!-- Banner desktop -->
        <?php if ($banner_img_desktop) : ?>
            <a href="/sklep/" title="Przechodzę do sklepu elektro-serwis" class="d-none d-lg-block">
                <img src="<?php echo $banner_img_desktop['url']; ?>" alt="<?php echo $banner_img_desktop['alt']; ?>" class="img-fluid mx-auto d-none d-lg-block">
            </a>
        <?php endif; ?>

        <!-- Banner mobile -->
        <?php if ($banner_img_mobile) : ?>
            <a href="/sklep/" title="Przechodzę do sklepu elektro-serwis" class="d-block d-lg-none">
                <img src="<?php echo $banner_img_mobile['url']; ?>" alt="<?php echo $banner_img_mobile['alt']; ?>" class="img-fluid mx-auto d-block d-lg-none">
            </a>
        <?php endif; ?>
    </div>
</section>