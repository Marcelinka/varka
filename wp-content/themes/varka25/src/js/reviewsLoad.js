jQuery(document).ready(function($) {
	/*
        Выгрузка всех отзывов на нажатие по кнопке
    */
    var $reviewButton = $('.all-review__button');
    $reviewButton.click(function() {
        var data = {
            action: 'load_reviews'
        };

        $reviewButton.text('Загрузка..').attr('disabled', 'disabled');

        $.post( '/wp-admin/admin-ajax.php', data, function(response) {
            var response = JSON.parse(response);
            var $html = $(response.html);
            $('.all-review__items').html($html);
            $reviewButton.hide();
        });
    });
});