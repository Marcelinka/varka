<?php

// Регистрируем хук
add_action('wp_ajax_load_news', 'load_news'); // wp_ajax_request_name
add_action('wp_ajax_nopriv_load_news', 'load_news'); // wp_ajax_request_name

function load_news() {
    // Получаем аргументы
    $page = $_POST['page'];
    $query_string = $_POST['query'];

    // Создаем запрос
	$query = new WP_Query( $query_string . '&tag__not_in=73&paged=' . $page );

    // Создаем переменные ответа
	$total_pages = $query->max_num_pages;
    $html = '';

    // Цикл по 6 нужным новостям
	if ( $query->have_posts() ) :

		while ( $query->have_posts() ) : $query->the_post();
            /*
                Проверяем, что загружать в медиа-часть поста
                Если тип поста видео, то получаем кастомное поле post_video
                В ином случае это будет картинка
            */
            $category = get_the_category()[0]->slug;

            if( $category == 'video' ) {
                $media = get_field('post_video');
            } else {
                $media = make_img_html(
                    get_post_thumbnail_id(),
                    array(
                        '800' => 'mainStock_Phones',
                        '1440' => 'frontPost_720p',
                        '1920' => 'frontPost_1080p',
                        '2560' => 'frontPost_Retina',
                        '4000' => 'frontPost_4K'
                    ),
                    array(
                        '800' => '40vw',
                        '1440' => '40vw',
                        '1920' => '40vw',
                        '2560' => '40vw',
                        '4000' => '100vw'
                    ),
                    'wp',
                    'blog__image'
                );
            }

            // Формируем html
            $news_html = 
                '<div class="blog__item">
                    <a href="' . get_permalink() . '">
                        <div class="blog__media">' . $media . '</div>
                        <div class="blog__title">' . get_the_title() . '</div>
                        <div class="blog__preview">' . get_field('post_preview') . '</div>
                    </a>
                    <a class="btn btn_white blog__item-buttom hidden hidden_phones" href="<?= get_permalink() ?>">Подробнее</a>
                </div>';

            // Добавляем html 1 поста в ответ
            $html .= $news_html;

		endwhile;

    endif;

    // Формируем ответ
    $response = array(
        'totalPages' => $total_pages,
        'newsHtml'  => $html
    );

    echo json_encode($response);

	wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция

}

?>