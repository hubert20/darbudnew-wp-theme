<?php
// Sprawdź, czy motyw jest poprawnie załadowany
defined( 'ABSPATH' ) || exit;

get_header(); // Załaduj nagłówek motywu

// Treść strony
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        the_content(); // Wyświetl treść wpisu/strony
    }
}

get_footer(); // Załaduj stopkę motywu
?>