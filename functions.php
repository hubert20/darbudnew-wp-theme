<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/**
 * Wczytywanie CSS/JS z dist/ (z wersjonowaniem po mtime)
 */
function wp_darbudnew_scripts()
{
  $theme_dir = get_stylesheet_directory();
  $theme_uri = get_stylesheet_directory_uri();

  // CSS (dist/style.css – ładowany tylko jeśli istnieje)
  $style_path = $theme_dir . '/dist/style.css';
  if (file_exists($style_path)) {
    wp_enqueue_style(
      'wp-darbudnew-css',
      $theme_uri . '/dist/style.css',
      [],
      filemtime($style_path),
      'all'
    );
  }

  // (opcjonalnie) Font Awesome 4 z CDN
  wp_enqueue_style(
    'font-awesome-4',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
    [],
    null
  );

  // JS (dist/main.bundle.js – ładowany tylko jeśli istnieje)
  $script_path = $theme_dir . '/dist/main.bundle.js';
  $script_path = $theme_dir . '/dist/main.bundle.js';
  if (file_exists($script_path)) {
    wp_enqueue_script(
      'wp-darbudnew-js',
      $theme_uri . '/dist/main.bundle.js',
      [], // 👈 pusta tablica, bez jQuery
      filemtime($script_path),
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'wp_darbudnew_scripts');


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * CSDev - Bootstrap 5 wp_nav_menu walker
 * Supports WP MultiLevel menus
 * Based on https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
 * Requires additional CSS fixes
 * CSS at https://gist.github.com/cdsaenz/d401330ba9705cfe7c18b19634c83004
 * CHANGE: removed custom display_element. Just call the menu with a $depth of 3 or more.
 */
class bs5_Walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  /**
   * Start Level
   */
  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach ($this->current_item->classes as $class) {
      if (in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    // CSDEV changed sub-menu  for dropdown-submenu
    $submenu = ($depth > 0) ? ' dropdown-submenu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
  }

  /**
   * Start Element
   */
  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    // CSDev added dropdown-menu-child-item & at_depth classes
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu-child-item dropdown-menu-end at_depth_' . $depth;
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class   = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';

    if ($args->walker->has_children) {
      // CSDEV added data-bs-auto-close
      $attributes .=  ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false"';
    } else {
      $attributes .=  ' class="' . $nav_link_class . $active_class . '"';
    }

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

// register a new menu
register_nav_menu('main-menu', 'Main menu');

/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
* provide it for us.
*/
add_theme_support('title-tag');

/*
* Enable support for Post Thumbnails on posts and pages.
*
* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
*/

add_theme_support('post-thumbnails');

// Then we'll add our custom images - 890px na 664px size
add_image_size('news-width', 890, 664, true);

// Rozmiar dla kategorii: 302x275, twarde kadrowanie
add_image_size('cat-width', 302, 275, true);

// Rozmiar dla galerii domków - główne zdjęcie
add_image_size('house-gallery', 800, 600, true);

// Rozmiar dla miniatur w galerii domków
add_image_size('house-thumb', 200, 150, true);

// And then we'll add the custom size that spans the width of the blog to the Gutenberg image dropdown
add_filter('image_size_names_choose', 'wpmudev_custom_image_sizes');
function wpmudev_custom_image_sizes($sizes)
{
  return array_merge($sizes, array(
    'news-width' => __('News Width'),
    'cat-width' => __('Cat Width'),
    'house-gallery' => __('Galeria domku - główne'),
    'house-thumb' => __('Galeria domku - miniatura'),
  ));
}

add_filter('body_class', 'add_category_to_single');
function add_category_to_single($classes)
{
  if (is_single()) {
    global $post;
    foreach ((get_the_category($post->ID)) as $category) {
      // add category slug to the $classes array
      $classes[] = 'cat-' . $category->category_nicename;
    }
  }
  return $classes;
}

add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  }
  return $title;
});

// Ccrossorigin Font-awsome 4
function add_font_awesome_4_cdn_attributes($html, $handle)
{
  if ('font-awesome-4' === $handle) {
    return str_replace("media='all'", "media='all' integrity='sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=' crossorigin='anonymous'", $html);
  }
  return $html;
}
add_filter('style_loader_tag', 'add_font_awesome_4_cdn_attributes', 10, 2);

add_filter('show_admin_bar', '__return_false');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_darbudnew_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html__('Top toolbar', 'darbudnew-wp-theme'),
    'id' => 'top-toolbar',
    'description' => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div>',
    'after_widget' => '</div>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Brand bottom', 'darbudnew-wp-theme'),
    'id'            => 'brand-bottom',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div id="%1$s" class=" widget %2$s">',
    'after_widget'  => '</div>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Social bottom', 'darbudnew-wp-theme'),
    'id'            => 'social-bottom',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div id="%1$s" class=" widget %2$s">',
    'after_widget'  => '</div>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Bottom menu about', 'darbudnew-wp-theme'),
    'id'            => 'menu-about',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div id="%1$s" class="bottom-nav-menu widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="bottom-nav-menu__title mb-3 mb-lg-4 text-green text-uppercase rajdhani-600">',
    'after_title'   => '</h5>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Bottom menu services', 'darbudnew-wp-theme'),
    'id'            => 'menu-services',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div id="%1$s" class="bottom-nav-menu widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="bottom-nav-menu__title mb-3 mb-lg-4 text-green text-uppercase rajdhani-600">',
    'after_title'   => '</h5>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Float btn', 'darbudnew-wp-theme'),
    'id'            => 'float-btn',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div>',
    'after_widget' => '</div>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Newsletter', 'darbudnew-wp-theme'),
    'id'            => 'newsletter',
    'description'   => esc_html__('Add widgets here.', 'darbudnew-wp-theme'),
    'before_widget' => '<div id="%1$s" class=" widget %2$s">',
    'after_widget'  => '</div>',
  ));
}
add_action('widgets_init', 'wp_darbudnew_widgets_init');
add_filter('widget_text', 'do_shortcode');

add_filter('wpseo_breadcrumb_links', 'custom_remove_category_base_from_breadcrumbs');
function custom_remove_category_base_from_breadcrumbs($links)
{
  foreach ($links as &$link) {
    if (strpos($link['url'], '/category/') !== false) {
      // Usuń fragment 'category' z URL
      $link['url'] = str_replace('/category/', '/', $link['url']);
    }
  }
  return $links;
}

// Pozwól używać kategorii na stronach
add_action('init', function () {
  register_taxonomy_for_object_type('category', 'page');
});

/**
 * Usuń /category/ z URL dla kategorii
 * Np. /category/domy-mobilne/ → /domy-mobilne/
 */
function remove_category_base_rewrite()
{
  global $wp_rewrite;

  // Usuń base "category" z permalinków kategorii
  $wp_rewrite->category_base = '';

  // Dodaj custom rewrite dla kategorii
  add_rewrite_rule(
    'domy-mobilne/?$',
    'index.php?category_name=domy-mobilne',
    'top'
  );

  add_rewrite_rule(
    'domy-mobilne/page/([0-9]{1,})/?$',
    'index.php?category_name=domy-mobilne&paged=$matches[1]',
    'top'
  );
}
add_action('init', 'remove_category_base_rewrite', 11);

/**
 * Automatyczne przekierowanie /category/domy-mobilne/ → /domy-mobilne/
 */
function redirect_category_to_clean_url()
{
  if (is_category() && strpos($_SERVER['REQUEST_URI'], '/category/') !== false) {
    $category = get_queried_object();
    $clean_url = home_url('/' . $category->slug . '/');
    wp_redirect($clean_url, 301);
    exit;
  }
}
add_action('template_redirect', 'redirect_category_to_clean_url', 1);

/**
 * Napraw linki do kategorii (usunie /category/ z output)
 */
function custom_category_link($link, $term_id)
{
  $category = get_category($term_id);
  if (!is_wp_error($category)) {
    $link = home_url('/' . $category->slug . '/');
  }
  return $link;
}
add_filter('category_link', 'custom_category_link', 10, 2);

/**
 * Przenieś automatycznie wstrzyknięty Cloudflare Turnstile
 * na dół formularza CF7 (przed [submit]).
 */
add_filter('wpcf7_form_elements', function ($form) {
  // 1) Znajdź DIV Turnstile (różne wtyczki generują podobny kontener)
  if (!preg_match('/<div[^>]*class=["\']?[^"\']*cf[-_ ]?turnstile[^"\']*["\']?[^>]*>.*?<\/div>/is', $form, $m)) {
    // nic nie znaleziono – zostaw jak jest
    return $form;
  }

  $turnstile = $m[0];

  // 2) Usuń go z obecnego miejsca
  $form = str_replace($turnstile, '', $form);

  // 3) Wstaw PRZED [submit]
  if (preg_match('/(\[submit[^\]]*\])/i', $form)) {
    $form = preg_replace('/(\[submit[^\]]*\])/i', $turnstile . "\n$1", $form, 1);
  } else {
    // awaryjnie – doklej na koniec formularza
    $form .= "\n" . $turnstile;
  }

  return $form;
});

// Remove <p> in block Contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Znajdź stronę na podstawie szablonu
 * 
 * @param string $template Nazwa pliku szablonu (np. 'template-domy-mobilne.php')
 * @return int|null ID strony lub null jeśli nie znaleziono
 */
function get_page_by_template($template)
{
  $pages = get_pages([
    'meta_key' => '_wp_page_template',
    'meta_value' => $template
  ]);

  return !empty($pages) ? $pages[0]->ID : null;
}

/**
 * Dodanie custom post type dla domków (opcjonalnie)
 * Jeśli wolisz używać kategorii w standardowych postach, możesz to usunąć
 */
function register_domy_post_type()
{
  $labels = [
    'name' => 'Domy',
    'singular_name' => 'Dom',
    'add_new' => 'Dodaj nowy',
    'add_new_item' => 'Dodaj nowy dom',
    'edit_item' => 'Edytuj dom',
    'new_item' => 'Nowy dom',
    'view_item' => 'Zobacz dom',
    'search_items' => 'Szukaj domów',
    'not_found' => 'Nie znaleziono domów',
    'not_found_in_trash' => 'Nie znaleziono domów w koszu',
    'parent_item_colon' => '',
    'menu_name' => 'Domy'
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => ['slug' => 'domy'],
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-home',
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
    'taxonomies' => ['category', 'post_tag']
  ];

  // Odkomentuj poniższą linię jeśli chcesz użyć custom post type zamiast kategorii
  // register_post_type('dom', $args);
}
add_action('init', 'register_domy_post_type', 0);

/**
 * Customizer - ustawienia dla kategorii (tło hero)
 */
function darbudnew_customize_register($wp_customize)
{
  // Sekcja: Tła kategorii
  $wp_customize->add_section('category_hero_settings', [
    'title' => __('Tła kategorii (Hero)', 'darbudnew-wp-theme'),
    'description' => __('Ustaw zdjęcia w tle dla archiwów kategorii.', 'darbudnew-wp-theme'),
    'priority' => 90,
  ]);

  // Domyślne tło dla wszystkich kategorii
  $wp_customize->add_setting('category_default_bg', [
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'category_default_bg', [
    'label' => __('Domyślne tło kategorii', 'darbudnew-wp-theme'),
    'description' => __('Tło wyświetlane gdy kategoria nie ma własnego zdjęcia.', 'darbudnew-wp-theme'),
    'section' => 'category_hero_settings',
    'settings' => 'category_default_bg',
  ]));

  // Separator
  $wp_customize->add_setting('separator_single_house', [
    'default' => '',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ]);

  $wp_customize->add_control('separator_single_house', [
    'label' => __('--- Pojedynczy domek ---', 'darbudnew-wp-theme'),
    'type' => 'hidden',
    'section' => 'category_hero_settings',
  ]);

  // Domyślne tło dla pojedynczych domków
  $wp_customize->add_setting('single_house_default_bg', [
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'single_house_default_bg', [
    'label' => __('Domyślne tło pojedynczego domku', 'darbudnew-wp-theme'),
    'description' => __('Tło wyświetlane gdy domek nie ma zdjęcia hero, galerii ani obrazka wyróżniającego.', 'darbudnew-wp-theme'),
    'section' => 'category_hero_settings',
    'settings' => 'single_house_default_bg',
  ]));

  // Separator
  $wp_customize->add_setting('separator_oferta', [
    'default' => '',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ]);

  $wp_customize->add_control('separator_oferta', [
    'label' => __('--- Strona /oferta/ ---', 'darbudnew-wp-theme'),
    'type' => 'hidden',
    'section' => 'category_hero_settings',
  ]);

  // Tło dla strony /oferta/
  $wp_customize->add_setting('oferta_bg_image', [
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'oferta_bg_image', [
    'label' => __('Tło strony /oferta/', 'darbudnew-wp-theme'),
    'description' => __('Zdjęcie w tle dla strony z listą wszystkich kategorii (darbud.com.pl/oferta/).', 'darbudnew-wp-theme'),
    'section' => 'category_hero_settings',
    'settings' => 'oferta_bg_image',
  ]));

  // Pobierz wszystkie kategorie
  $categories = get_categories(['hide_empty' => false]);

  // Dodaj ustawienie dla każdej kategorii
  foreach ($categories as $category) {
    $setting_id = "category_bg_{$category->slug}";

    $wp_customize->add_setting($setting_id, [
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $setting_id, [
      'label' => sprintf(__('Tło: %s', 'darbudnew-wp-theme'), $category->name),
      'description' => sprintf(__('Slug: %s', 'darbudnew-wp-theme'), $category->slug),
      'section' => 'category_hero_settings',
      'settings' => $setting_id,
    ]));
  }
}
add_action('customize_register', 'darbudnew_customize_register');

/**
 * Odśwież ustawienia Customizera po dodaniu nowej kategorii
 */
function darbudnew_refresh_customizer_on_category_change()
{
  // Usuń transients czy inne cache jeśli potrzeba
}
add_action('created_category', 'darbudnew_refresh_customizer_on_category_change');
add_action('edited_category', 'darbudnew_refresh_customizer_on_category_change');

/**
 * Automatyczne użycie szablonu single-dom.php dla postów w kategorii "domy-mobilne"
 */
function darbudnew_single_template($template)
{
  // Debug - zapisz do logu co się dzieje
  error_log('Darbudnew template filter running. Current template: ' . $template);

  if (is_single() && get_post_type() === 'post') {
    $post = get_post();
    if ($post) {
      $categories = get_the_category($post->ID);

      foreach ($categories as $category) {
        if ($category->slug === 'domy-mobilne') {
          $new_template = get_template_directory() . '/single-dom.php';
          if (file_exists($new_template)) {
            // error_log('Found domy-mobilne category. Using: ' . $new_template);
            return $new_template;
          }
        }
      }
    }
  }
  return $template;
}
// Wyższy priorytet (5) żeby zadziałał przed innymi filtrami
add_filter('single_template', 'darbudnew_single_template', 5);

/**
 * Alternatywna metoda przez template_include (bardziej niezawodna)
 */
function darbudnew_template_include($template)
{
  if (is_single() && get_post_type() === 'post') {
    $post = get_post();
    if ($post) {
      $categories = get_the_category($post->ID);

      foreach ($categories as $category) {
        if ($category->slug === 'domy-mobilne') {
          $new_template = get_template_directory() . '/single-dom.php';
          if (file_exists($new_template)) {
            return $new_template;
          }
        }
      }
    }
  }
  return $template;
}
add_filter('template_include', 'darbudnew_template_include', 99);

/**
 * Automatyczna strona /oferta/ z listą wszystkich kategorii
 */
function darbudnew_add_oferta_rewrite()
{
  add_rewrite_rule('^oferta/?$', 'index.php?darbud_oferta=1', 'top');
  add_rewrite_tag('%darbud_oferta%', '([^&]+)');
}
add_action('init', 'darbudnew_add_oferta_rewrite', 10);

/**
 * Użyj szablonu template-all-categories.php dla /oferta/
 */
function darbudnew_oferta_template($template)
{
  if (get_query_var('darbud_oferta')) {
    $oferta_template = get_template_directory() . '/templates/template-all-categories.php';
    if (file_exists($oferta_template)) {
      return $oferta_template;
    }
  }
  return $template;
}
add_filter('template_include', 'darbudnew_oferta_template', 100);


// Map footer
function leaflet_assets()
{
  wp_enqueue_style(
    'leaflet-css',
    'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'
  );

  wp_enqueue_script(
    'leaflet-js',
    'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
    [],
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'leaflet_assets');


/**
 * Współrzędne pinezki i widoku mapy (stopka, strona Kontakt).
 * Edytuj tutaj przy zmianie lokalizacji — link „Google Maps” w dymku użyje tych samych wartości.
 *
 * @return array{lat: float, lng: float, zoom: int}
 */
function biprotech_contact_map_coordinates(): array
{
  return [
    'lat' => 52.689785,
    'lng' => 21.1060919,
    'zoom' => 15,
  ];
}

/**
 * Domyślna treść dymka mapy (HTML). Nadpisz: add_filter( 'biprotech_contact_map_popup_html', 'twoja_funkcja' );
 */
function biprotech_contact_map_default_popup_html()
{
  $c = biprotech_contact_map_coordinates();
  $maps_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($c['lat'] . ',' . $c['lng']);

  return '<strong>DARBUD Dariusz Zaręba</strong><br>'
    . 'ul. Tartaczna 71, 06-100 Pułtusk<br>'
    . '<a href="' . esc_url($maps_url) . '" target="_blank" rel="noopener noreferrer">Wyznacz trasę w Google Maps</a>';
}

/**
 * Mapa Leaflet (stopka lub strona Kontakt).
 * Użycie: [contact_map] albo [contact_map id="contact-map-kontakt"] — id musi być unikalne na stronie.
 * Opcjonalnie krótki popup: [contact_map popup="&lt;strong&gt;Firma&lt;/strong&gt;&lt;br&gt;ul. …"] — na pełny adres lepiej filtr biprotech_contact_map_popup_html.
 */
function contact_map_shortcode($atts = [])
{
  $atts = shortcode_atts(
    [
      'id' => 'contact-map',
      'popup' => '',
    ],
    $atts,
    'contact_map'
  );

  $map_id = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $atts['id']);
  if ($map_id === '') {
    $map_id = 'contact-map';
  }

  if ($atts['popup'] !== '') {
    $popup_html = wp_kses_post(html_entity_decode((string) $atts['popup'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
  } else {
    $popup_html = apply_filters('biprotech_contact_map_popup_html', biprotech_contact_map_default_popup_html());
    $popup_html = wp_kses_post($popup_html);
  }

  $map_id_js = wp_json_encode($map_id);
  $popup_js = wp_json_encode($popup_html, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);

  $c = biprotech_contact_map_coordinates();
  $map_lat = (float) $c['lat'];
  $map_lng = (float) $c['lng'];
  $map_zoom = (int) $c['zoom'];
  $map_center_js = wp_json_encode([$map_lat, $map_lng], JSON_UNESCAPED_SLASHES);

  ob_start(); ?>

  <div id="<?php echo esc_attr($map_id); ?>" class="contact-map-leaflet"></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      if (typeof L === 'undefined') {
        console.error('Leaflet not loaded');
        return;
      }
      const mapId = <?php echo $map_id_js; ?>;
      const el = document.getElementById(mapId);
      if (!el || el.dataset.leafletReady === '1') {
        return;
      }
      el.dataset.leafletReady = '1';

      const map = L.map(mapId, {
        zoomControl: true,
        attributionControl: false,
        scrollWheelZoom: false,
        dragging: true,
        doubleClickZoom: true
      }).setView(<?php echo $map_center_js; ?>, <?php echo $map_zoom; ?>);

      L.tileLayer(
        'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png'
      ).addTo(map);

      const markerIcon = L.divIcon({
        className: 'marker-wrapper',
        html: `
    <div class="marker-combo marker-left">

      <!-- logo box -->
      <div class="marker-label">
        <img src="<?php echo esc_url(content_url('/uploads/2025/09/darbud-logo.png')); ?>" alt="Biprotech">
      </div>

      <!-- pinezka -->
      <svg
        class="marker-pin"
        width="36"
        height="54"
        viewBox="0 0 96 128"
        xmlns="http://www.w3.org/2000/svg">

        <!-- kształt pinezki -->
        <path
          d="M48 0
             C21.5 0 0 21.5 0 48
             C0 84 48 128 48 128
             C48 128 96 84 96 48
             C96 21.5 74.5 0 48 0Z"
          fill="#599f4f"/>

        <!-- PUSTE kółko (dziura) -->
        <circle cx="48" cy="44" r="22" fill="#f5f5f5"/>
      </svg>

    </div>
  `,
        iconSize: [180, 70],
        iconAnchor: [90, 70]
      });

      const popupHtml = <?php echo $popup_js; ?>;

      const marker = L.marker(<?php echo $map_center_js; ?>, {
        icon: markerIcon
      }).addTo(map);

      marker.bindPopup(popupHtml, {
        className: 'rs-contact-map-popup',
        maxWidth: 280,
        autoPan: true,
        autoPanPadding: [24, 24]
      });

      requestAnimationFrame(function() {
        map.invalidateSize();
      });
      setTimeout(function() {
        map.invalidateSize();
      }, 400);

    });
  </script>

<?php
  return ob_get_clean();
}
add_shortcode('contact_map', 'contact_map_shortcode');
