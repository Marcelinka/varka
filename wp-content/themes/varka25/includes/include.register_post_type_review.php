<?php

// Создаем тип постов `services`
add_action('init', 'register_review_post_type');

function register_review_post_type() {
    register_post_type('review', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Отзывы', // основное название для типа записи
            'singular_name'      => 'Отзыв', // название для одной записи этого типа
            'add_new'            => 'Добавить отзыв', // для добавления новой записи
            'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
            'new_item'           => 'Новый отзыв', // текст новой записи
            'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
            'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Отзывы', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_nav_menus'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-cart', 
        'hierarchical'        => false,
        'supports'            => array('title','custom-fields'),
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}