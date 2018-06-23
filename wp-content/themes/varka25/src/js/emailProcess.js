jQuery(document).ready(function($) {
	/*
        Обработка почтовых событий
    */

    jQuery('input.jquery-mask').mask( "+7 (999) 999-99-99" );

    var $form = $('.wpcf7');
    var $buttonText = '';

    $form.on( 'wpcf7spam', function(event) {
        let $button = $(event.currentTarget).find('.wpcf7-submit');
        //console.log('spam');
        $button.removeAttr('disabled').attr('value', $buttonText).css('opacity', '1');
    });
    $form.on( 'wpcf7invalid', function(event) {
        let $button = $(event.currentTarget).find('.wpcf7-submit');
        //console.log('invalid');
        $button.removeAttr('disabled').attr('value', $buttonText).css('opacity', '1');
    });
    $form.on( 'wpcf7mailsent', function(event) {
        let $button = $(event.currentTarget).find('.wpcf7-submit');
        //console.log('sent');
        $button.attr('disabled', 'disabled').attr('value', 'Отправлено!').css('opacity', '.5');
    });
    $form.on( 'wpcf7mailfailed', function() {
        alert('При отправке произошла ошибка! Попробуйте позже!');
    });
    $form.submit( function(event) {
        let $button = $(event.currentTarget).find('.wpcf7-submit');
        $buttonText = $button.attr('value');

        $button.attr('disabled', 'disabled').attr('value', 'Отправляю...').css('opacity', '.5');
        //console.log($(event.currentTarget).find('.wpcf7-submit'));
        if($(event.currentTarget).attr('id') == 'wpcf7-f8272-o1') {
            setTimeout(() => {
                $button.attr('disabled', 'disabled').attr('value', 'Отправлено!').css('opacity', '.5');
            }, 5000);
        }
    });
});