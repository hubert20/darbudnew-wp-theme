<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package darbudnew-wp-theme
 */
?>

<div class="modal fade videomodal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="modal-form">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

<?php wp_footer(); ?>
</body>

</html>