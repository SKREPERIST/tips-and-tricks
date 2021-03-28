<?php
add_filter('show_admin_bar', '__return_false'); // admin panel top

remove_action('wp_head', 'print_emoji_detection_script', 7); //emoji
remove_action('admin_print_scripts', 'print_emoji_detection_script'); //emoji
remove_action('wp_print_styles', 'print_emoji_styles'); //emoji
remove_action('admin_print_styles', 'print_emoji_styles'); //emoji

remove_action('wp_head', 'wp_resource_hints', 2); // dns-prefetch
remove_action('wp_head', 'wp_generator'); // meta name="generator"
remove_action('wp_head', 'wlwmanifest_link'); // wiwmanifest
remove_action('wp_head', 'rsd_link'); // EditURI
remove_action('wp_head', 'rest_output_link_wp_head'); // https://api.w.org/
remove_action('wp_head', 'rel_canonical'); // canonical
remove_action('wp_head', 'wp_shortlink_wp_head'); // shortlink
remove_action('wp_head', 'wp_oembed_add_discovery_links'); // alternate


add_action('wp_enqueue_scripts', 'site_styles');
add_action('wp_enqueue_scripts', 'site_scripts');

/////////////////////////////// ADDED STYLES
function site_styles()
{
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:900%7CRoboto:300&display=swap&subset=cyrillic', array(), '0.0.0.0');
  wp_enqueue_style('main-styles', get_stylesheet_uri());
}

/////////////////////////////// ADDED SCRIPTS
function site_scripts()
{
  wp_dequeue_style('wp-block-library'); //remove block-library
  wp_deregister_script('wp-embed'); //remove wp-embed
  wp_enqueue_script('focus-visible', 'https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js', [], '0.0.0.0', true);
  wp_enqueue_script('lazy-load', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js', [], '0.0.0.0', true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], '0.0.0.0', true);

  wp_localize_script('main-js', 'WPJS', [
    'siteUrl' => get_template_directory_uri(),
  ]);
}


<!--=============================== added logo =================-->
<?php
add_theme_support('custom-logo'); // это в functions.php
// <div>
the_custom_logo();  // это вместо картинки
// </div>

//==========================     ADDED PREVIEW LOGO ===============
add_theme_support('post-thumbnails');
