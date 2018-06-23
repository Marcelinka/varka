<?php

/* Создаем глобальные настройки */
function ea_acf_options_page() {
  if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
      'page_title'  => 'Основные настройки',
      'menu_title' => 'Основные настройки',
      'menu_slug'  => 'global-options',
      'capability' => 'edit_posts',
      'redirect'  => false
    ) );
  }
}
add_action( 'init', 'ea_acf_options_page' );

/* —------------------------------------------------------------------------
 * Отключаем Emojii
 * —------------------------------------------------------------------------ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
remove_action('welcome_panel', 'wp_welcome_panel');
add_filter('xmlrpc_enabled', '__return_false');

function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
// Удаляем код meta name="generator"
remove_action( 'wp_head', 'wp_generator' );
// Удаляем вывод /feed/
remove_action( 'wp_head', 'feed_links', 2 );
// Удаляем вывод /feed/ для записей, категорий, тегов и подобного
remove_action( 'wp_head', 'feed_links_extra', 3 );

function remove_admin_bar() {
   show_admin_bar(false);
 }

 add_action('after_setup_theme', 'remove_admin_bar');