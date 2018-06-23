<?php
/**
 * varka25.ru functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package varka25.ru
 */

if ( ! function_exists( 'varka25_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function varka25_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on varka25.ru, use a find and replace
		 * to change 'varka25' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'varka25', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'left' => 'Левая половина',
			'right' => 'Правая половина',
			'footer' => 'Подвал'
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'varka25_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'varka25_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function varka25_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'varka25_content_width', 640 );
}
add_action( 'after_setup_theme', 'varka25_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function varka25_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'varka25' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'varka25' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'varka25_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function varka25_scripts() {
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css' ), false );
	wp_enqueue_style( 'carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', false );
	wp_enqueue_style( 'carousel_theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', false );
	wp_enqueue_script('maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', true);
	wp_enqueue_script( 'carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', false );
	wp_enqueue_script('fancybox-js', get_template_directory_uri() . '/js/jquery.fancybox.min.js', false);
	wp_enqueue_style('fancybox-css', get_template_directory_uri() . '/css/jquery.fancybox.min.css', false);
	wp_enqueue_script('vue', get_template_directory_uri() . '/js/vue.js', false);
	wp_enqueue_script('pdfmake', get_template_directory_uri() . '/js/pdfmake.min.js', false);
	wp_enqueue_script('pdfmake-fonts', get_template_directory_uri() . '/js/vfs_fonts.js', false);
	wp_enqueue_script('segment', get_template_directory_uri() . '/js/segment.min.js', false);
	wp_enqueue_script('view-scroll', get_template_directory_uri() . '/js/jquery.viewportchecker.min.js', true);
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', true);
	wp_enqueue_script('script', get_template_directory_uri() . '/js/bundle.js', array(), filemtime( get_template_directory() . '/js/bundle.js' ), true);
}
add_action( 'wp_enqueue_scripts', 'varka25_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Дополнительные файлы
include('includes/include.globals.php'); // Глобальные настройки
include('includes/include.image-sizes.php'); // Размеры картинок
include('includes/include.register_post_type_stock.php'); // Новый тип записи - Акция
include('includes/include.register_post_type_review.php'); // Новый тип записи - Отзыв
include('includes/include.filters.php'); // Фильтры для woocommerce
include('includes/include.ajax-news.php'); // Вывод новостей по 6
include('includes/include.order-mail.php'); // Отправка заказа на почту
include('includes/include.ajax-reviews.php'); // Выгрузка всех отзывов
include('includes/include.hooks-woocommerce.php'); // Удаление action hook и добавление новых
include('includes/include.wishlist-button-hook.php'); // Добавляем количество элементов в вишлисте