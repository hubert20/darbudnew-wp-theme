<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mariolahairstylist-wp-theme
 */
?>


<!-- Contact form Modal -->
<div class="modal fade contactformModal" id="ContactformModal" tabindex="-1" aria-labelledby="ContactformModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0" id="modal-form">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-12 offerformModal__left-bg bg-white position-relative">
                        <div class="p-4">
                            <?php echo apply_shortcodes('[contact-form-7 id="f5ee6a9" title="Zapytanie"]'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-flex offerformModal__right-bg"></div>
                    <!-- Close btn -->
                    <button type="button" class="btn-close btn-close-mobile" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                    <span class="round-close d-none d-lg-inline-block"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter form Modal -->
<div class="modal fade contactformModal offerformModal newsletterformModal" id="NewsletterformModal" tabindex="-1" aria-labelledby="NewsletterformModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0" id="modal-form">
                <div class="d-flex flex-column" style="background: #f6f6f6;">
                    <div class="row justify-content-center">
                        <div class="col-3 col-lg-2 text-center">
                            <img src="https://mariolahairstylist.pl/wp-content/uploads/2025/06/flowers-200.png" class="img-fluid mb-2 mt-3  mx-auto">
                        </div>
                    </div>
                    <div class="col-lg-12 bg-white position-relative">
                        <!-- Newsletter mailer lite here -->
                        <div class="ml-embedded" data-form="68LKIi"></div>
                    </div>
                    <!-- Close btn -->
                    <button type="button" class="btn-close btn-close-mobile" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                    <span class="round-close d-none d-lg-inline-block"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Film -->
<div class="modal modal-video fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered align-items-center modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="modal-body">
                <button type="button" class="btn-close btn-close-white close-video" data-bs-dismiss="modal" aria-label="Close" title="Zamknij film"></button>
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="site-footer" role="contentinfo">
    <?php get_template_part('footer-widget'); ?>
</footer>

<div id="cookie-warn" class="cookie-warn">
    <div class="cookie-warn__box">
        <span class="cookie-warn__left-side">
            Użytkowanie oznacza akceptację regulaminu oraz Polityki prywatności, w tym zapisywania plików cookie.
        </span>
        <span class="cookie-warn__right-side">
            <a href="javascript:void(0);" id="close-cookie-warn" class="cookie-warn__close-cookie-info">OK</a>
        </span>
    </div>
</div>
<?php wp_footer(); ?>
</body>

</html>