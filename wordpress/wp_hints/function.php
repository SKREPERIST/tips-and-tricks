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

?>


<!--=============================== added logo #2=================-->
<a href="<?php echo get_home_url(); ?>" class="header__logo">
  <img src="
  <?php
  $custom_logo__url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
  // выводим
  echo $custom_logo__url[0];
  ?>" alt="Dreams" class="header__logo-img">
</a>
<!--=============================== added logo #2=================-->

<?php bloginfo('name');
echo " | ";
bloginfo('description') ?>

<!-- ================  Динамическое добавление поста ================================= -->
<!-- ================================================= -->
<?php // открываем пост
$posts = get_posts(array(
  'numberposts' => -1,
  'category_name' => 'slider',
  'orderby' => 'date',
  'order' => 'ASC',
  'post_type' => 'post',
  'suppress_filters' => true,
));

foreach ($posts as $post) {
  setup_postdata($post);
  ?>
  <!-- место для верстки  поста -->
  <li style="background-image: url('<?php the_field('slider_img'); ?>')" class="glide__slide">

    <!-- Здесь можно писать условие -->

    </div>
  </li>
  <!-- ////////////// Превьюха ////////////////// -->
  <!-- <?php the_post_thumbnail(); ?> -->
  <!-- //////////////////////////////// -->
<?php
}

wp_reset_postdata();
?>
<!-- закрываем пост -->
<!-- ================================================= -->
<!-- ================================================= -->



<!--=============================== хуки события =================-->
<?php
function hello($text, $name)
{
  echo 'hello ' . $text . ' ' . $name;
}
add_action('my_hook', 'hello', 10, 2);
do_action('my_hook', 'Dear', 'Sergey');
?>

<!--=============================== хуки фильтры =================-->
<?php
function myFilterFunction($str)
{
  return 'Hello ' . $str;
};
add_filter('myFilter', 'myFilterFunction');
echo apply_filters('myFilter', 'world');
// remove_filter('myFilter', 'myFilterFunction', 15) отмена фильтра
// echo apply_filters('myFilter', 'world');
?>


<!-- ===========  Вставляем превью с условием что она выбрана   ======== -->
<div class="toys__item" style="background-image: url(
 <?php
  if (has_post_thumbnail()) {
    the_post_thumbnail_url();
  } else {
    echo get_template_directory_uri() . '/assets/img/not-found.jpg';
  }
  ?>)">
</div>
<!-- ============================================================================= -->

<!-- =================================   УСЛОВИЕ №1   ========================================== -->
<h2 style=" 
<?php
$field = get_field('slider_color');
if ($field == 'white') { // Выбор цвета заголовка 
  ?>
color: #fff
<?php
}
?>

" class="slider__title"><?php the_title(); ?>
</h2>
<!-- =================================   УСЛОВИЕ №2   ========================================== -->
<?php
$field = get_field('slider_btn');
if ($field == 'on') {
  ?>
  <!-- Если выбрана кнопка, то она добавляется вместе с ссылкой -->
  <a href="<?php the_field('slider_link') ?>" class="button">Узнать больше</a>
<?php
}
?>
<!-- =========================================================================================== -->