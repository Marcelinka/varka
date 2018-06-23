<?php

    // Создаем тип постов `services`
    add_action('init', 'register_stock_post_type');
    add_action('init', 'create_taxonomy_stock');

    function register_stock_post_type() {
        register_post_type('stock', array(
            'label'  => null,
            'labels' => array(
                'name'               => 'Акции', // основное название для типа записи
                'singular_name'      => 'Акция', // название для одной записи этого типа
                'add_new'            => 'Добавить акцию', // для добавления новой записи
                'add_new_item'       => 'Добавление акции', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Редактирование акции', // для редактирования типа записи
                'new_item'           => 'Новая акция', // текст новой записи
                'view_item'          => 'Смотреть акцию', // для просмотра записи этого типа.
                'search_items'       => 'Искать акцию', // для поиска по этим типам записи
                'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Акции', // название меню
            ),
            'description'         => '',
            'public'              => true,
            'show_in_menu'        => true, // показывать ли в меню адмнки
            'show_in_nav_menus'   => true,
            'menu_position'       => 6,
            'menu_icon'           => 'dashicons-cart', 
            'hierarchical'        => false,
            'supports'            => array('title','custom-fields'),
            'has_archive'         => true,
            'rewrite'             => true,
            'query_var'           => true,
        ) );
    }

    function create_taxonomy_stock() {
        register_taxonomy('stock_type', array('stock'), array(
            'label'                 => '', // определяется параметром $labels->name
            'labels'                => array(
                'name'              => 'Типы акций',
                'singular_name'     => 'Тип акции',
                'search_items'      => 'Искать типы акций',
                'all_items'         => 'Все типы акций',
                'view_item '        => 'Посмотреть тип акции',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактирование типа акции',
                'update_item'       => 'Обновление типа акции',
                'add_new_item'      => 'Добавить новый тип акции',
                'new_item_name'     => 'Новый тип акции',
                'menu_name'         => 'Типы акций',
            ),
            'description'           => '', // описание таксономии
            'public'                => true,
            'publicly_queryable'    => null, // равен аргументу public
            'show_in_nav_menus'     => true, // равен аргументу public
            'show_ui'               => true, // равен аргументу public
            'show_tagcloud'         => true, // равен аргументу show_ui
            'show_in_rest'          => null, // добавить в REST API
            'rest_base'             => null, // $taxonomy
            'hierarchical'          => true,
            'update_count_callback' => '',
            'rewrite'               => true,
            //'query_var'             => $taxonomy, // название параметра запроса
            'capabilities'          => array(),
            'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
            'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
            '_builtin'              => false,
            'show_in_quick_edit'    => null, // по умолчанию значение show_ui
        ) );
    }
    
?>