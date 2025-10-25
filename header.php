<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package darbudnew-wp-theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!-- MailerLite Universal -->
    <script>
        (function(w, d, e, u, f, l, n) {
            w[f] = w[f] || function() {
                    (w[f].q = w[f].q || [])
                    .push(arguments);
                }, l = d.createElement(e), l.async = 1, l.src = u,
                n = d.getElementsByTagName(e)[0], n.parentNode.insertBefore(l, n);
        })
        (window, document, 'script', 'https://assets.mailerlite.com/js/universal.js', 'ml');
        ml('account', '1825051');
    </script>
    <!-- End MailerLite Universal -->
</head>

<body <?php body_class(); ?>>
    <header id="top-header" class="" role="banner">
        <!-- Top Toolbar -->
        <div class="toolbar-area d-none d-lg-block px-xl-4">
            <?php if (is_active_sidebar('top-toolbar')) : ?>
                <?php dynamic_sidebar('top-toolbar'); ?>
            <?php endif; ?>
        </div>
        <!-- Top header -->
        <div class="top-header-menu pb-lg-2">
            <div class="container top-header-menu--container position-relative">
                <nav class="navbar navbar-expand-xl navbar-theme py-lg-0">
                    <?php if (get_theme_mod('darbudnew_wp_theme_logo')) : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="navbar-brand align-items-center top-logo flex-column">
                            <img src="<?php echo esc_url(str_replace('https://', 'http://', get_theme_mod('darbudnew_wp_theme_logo'))); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        </a>
                    <?php endif; ?>
                    <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-end" id="main-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                            'depth' => 3,
                            'walker' => new bs5_Walker()
                        ));
                        ?>
                    </div>
                </nav>
            </div>
        </div>
    </header>