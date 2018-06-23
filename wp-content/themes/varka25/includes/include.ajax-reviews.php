<?php

// Регистрируем хук
add_action('wp_ajax_load_reviews', 'load_reviews'); // wp_ajax_request_name
add_action('wp_ajax_nopriv_load_reviews', 'load_reviews'); // wp_ajax_request_name

function load_reviews() {
    // Запрос для получения всех отзывов
    $args = array(
        'post_type' => 'review',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);
    $html = '';
    $number_of_gallery = 0;

    // Цикл по каждому отзыву
    while($query->have_posts()) {
        $query->the_post();
        $number_of_gallery++;
        $name_of_gallery = 'review-'.$number_of_gallery;

        // html одного отзыва
        $review_html = 
        '<section class="one-review">
            <div class="one-review__gallery">
                <a class="one-review__button" href="'.get_field('review_main_photo')['url'].'" data-fancybox="'.$name_of_gallery.'">' .
                    make_img_html(
                        get_field('review_main_photo'),
                        array(
                            '800' => 'mainStock_Phones',
                            '1440' => 'frontPost_720p',
                            '1920' => 'frontPost_1080p',
                            '2560' => 'frontPost_Retina',
                            '4000' => 'frontPost_4K'
                        ),
                        array(
                            '800' => '100vw',
                            '1440' => '40vw',
                            '1920' => '40vw',
                            '2560' => '40vw',
                            '4000' => '40vw'
                        ),
                        'acf',
                        'all-image'
                    ) .
                '</a>

                <div class="one-review-gallery">';

        while( have_rows('review_gallery') ) : the_row();
            $review_html .= 
            '<a href="'.get_sub_field('review_photo')['url'].'" data-fancybox="'.$name_of_gallery.'">'.
                make_img_html(
                    get_sub_field('review_photo'),
                    array(
                        '800' => 'mainStock_Phones',
                        '1440' => 'frontPost_720p',
                        '1920' => 'frontPost_1080p',
                        '2560' => 'frontPost_Retina',
                        '4000' => 'frontPost_4K'
                    ),
                    array(
                        '800' => '100vw',
                        '1440' => '40vw',
                        '1920' => '40vw',
                        '2560' => '40vw',
                        '4000' => '40vw'
                    ),
                    'acf',
                    'all-image'
                ).
            '</a>';
        endwhile; 
        
        $review_html .=
                '</div>
            </div>

            <div class="one-review__information">
                <div class="one-review__date">' . get_the_date() . '</div>
                <div class="one-review__author">' . get_field('review_name') . '</div>
                <div class="one-review__text">' . get_field('review_text') . '</div>
                <div class="one-review__line"></div>
            </div>

        </section>';

        // Добавляем в общий html
        $html .= $review_html;
    }

    // Отправляем
    $response = array(
        'html' => $html
    );
    echo json_encode($response);

    wp_die();
}

?>