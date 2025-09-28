<!-- Footer -->
<section class="footer-widgets">
    <div class="container-fluid py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-8 col-lg-3 text-center">
                <img src="" class="img-fluid mb-4 mb-lg-5 mx-auto">
            </div>
        </div>
        <div class="footer-widgets__logo mb-4 mb-lg-5"></div>
        <div class="row justify-content-center">
            <div class="col-lg-4 pe-lg-5 mb-4 mb-lg-0">
                <?php if (is_active_sidebar('social-bottom')) : ?>
                    <?php dynamic_sidebar('social-bottom'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 footer-widgets__bottom-desc mb-4 mb-lg-0">
                <?php if (is_active_sidebar('menu-about')) : ?>
                    <?php dynamic_sidebar('menu-about'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <?php if (is_active_sidebar('menu-services')) : ?>
                    <?php dynamic_sidebar('menu-services'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <?php if (is_active_sidebar('newsletter')) : ?>
                    <?php dynamic_sidebar('newsletter'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div class="copyright-box">
    <div class="container py-4">
        <p class="text-center text-gray-light mb-0"><small>darbud Copyright 2025</small></p>
    </div>
</div>

<!-- Float btn -->
<div class="float-btn">



</div>