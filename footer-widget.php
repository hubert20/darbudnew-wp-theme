<!-- Footer -->
<section class="footer-widgets">
    <div class="container-fluid py-4 py-lg-5">
        <div class="row justify-content-evenly">
            <div class="col-lg-2 mb-4 mb-lg-0">
                <img src="http://darbud.com.pl/wp-content/uploads/2025/09/darbud-white.png" class="img-fluid mx-auto">
                <?php if (is_active_sidebar('social-bottom')) : ?>
                    <?php dynamic_sidebar('social-bottom'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 footer-widgets__bottom-desc mb-4 mb-lg-0">
                <?php if (is_active_sidebar('menu-services')) : ?>
                    <?php dynamic_sidebar('menu-services'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 footer-widgets__bottom-desc mb-4 mb-lg-0">
                <?php if (is_active_sidebar('menu-about')) : ?>
                    <?php dynamic_sidebar('menu-about'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-2">
                <?php if (is_active_sidebar('newsletter')) : ?>
                    <?php dynamic_sidebar('newsletter'); ?>
                <?php else : ?>
                    <div class="ml-embedded" data-form="OD79vF"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div class="copyright-box">
    <div class="container py-4">
        <p class="text-center text-gray-light mb-0"><small>Darbud Copyright 2025</small></p>
    </div>
</div>

<!-- Float btn -->
<div class="float-btn"></div>