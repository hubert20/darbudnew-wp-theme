<!-- Footer -->
<section class="footer-widgets">
    <div class="container py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-8 col-lg-3 text-center">
                <img src="https://mariolahairstylist.pl/wp-content/uploads/2025/06/flowers-200.png" class="img-fluid mb-4 mb-lg-5 mx-auto">
            </div>
        </div>
        <div class="footer-widgets__logo mb-4 mb-lg-5"></div>
        <div class="row justify-content-center">
            <div class="col-lg-4 footer-widgets__bottom-desc pe-lg-5 mb-4 mb-lg-0">
                <?php if (is_active_sidebar('menu-about')) : ?>
                    <?php dynamic_sidebar('menu-about'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 footer-widgets__bottom-desc mb-4 mb-lg-0">
                <?php if (is_active_sidebar('footer-start')) : ?>
                    <?php dynamic_sidebar('footer-start'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <?php if (is_active_sidebar('menu-services')) : ?>
                    <h5 class="text-yellow standard-title-6 mb-2 mb-lg-4 text-rose lobster-font">Informacje</h5>
                    <?php dynamic_sidebar('menu-services'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div class="copyright-box">
    <div class="container py-4">
        <p class="text-center text-gray-light mb-0"><small>mariolahairstylist Copyright 2025</small></p>
    </div>
</div>

<!-- Float btn -->
<div class="float-btn">



</div>