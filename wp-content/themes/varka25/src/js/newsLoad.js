jQuery(document).ready(function($) {
    /*
	    Подгрузка статей по нажатию на кнопку
	*/

    var $blogButton =  $(".blog__button");
    $blogButton.click(function() {
        var totalPages = $(this).data('total-pages');
        var currentPage = $(this).data('current-page');
        var nextPage = currentPage + 1;
        var queryString = $(this).data('query');

        //console.log(totalPages);
        //console.log(currentPage);
        //console.log(nextPage);

        var data = {
            action: 'load_news',
            page: nextPage,
            query: queryString
        };
        //console.log(data);

        $blogButton.text('Загрузка..').attr('disabled', 'disabled');

        jQuery.post( '/wp-admin/admin-ajax.php', data, function(response) {
            var response = JSON.parse(response);
            //console.log(response);
            var $html = jQuery(response.newsHtml);
            jQuery('.blog-items').append($html);

            $blogButton.attr('data-current-page', nextPage);
            $blogButton.data('current-page', nextPage);

            $blogButton.text('Показать ещё').removeAttr('disabled');

            if( $blogButton.data('current-page') == totalPages) {
                $blogButton.hide();
            }
        });
    });
});