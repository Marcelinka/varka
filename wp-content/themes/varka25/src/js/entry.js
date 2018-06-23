import {lockScroll, unlockScroll} from './lockScroll.js';
require('./wishlist.js');
require('./smoothScroll.js');
require('./carouselSetup.js');
require('./newsLoad.js');
require('./reviewsLoad.js');
require('./menu-and-sidebar-mobile.js');
require('./emailProcess.js');
require('./lazyLoadImg.js');

window.bodyScrollTop = null;
window.locked = false;

jQuery(document).ready(function($) {
    /*
        Модальное окно обратного звонка
    */
    $('.back-call-button').click(function() {
        $('.back-call').removeClass('back-call_hidden');
        lockScroll();
        $('.wpcf7-form-control').first().focus();
    });
    $('#back-call-close').click(function() {
        $('.back-call').addClass('back-call_hidden');
        unlockScroll();
    });
    $('.back-call__overlay').click(function() {
        $('.back-call').addClass('back-call_hidden');
        unlockScroll();
    });

    /*
        Модальное окно подарочного сертификата
    */
    $('.gift-button').click(function() {
        $('.gift').removeClass('gift_hidden');
        lockScroll();
        $('.wpcf7-form-control').first().focus();
    });
    $('#gift-close').click(function() {
        $('.gift').addClass('gift_hidden');
        unlockScroll();
    });
    $('.gift__overlay').click(function() {
        $('.gift').addClass('gift_hidden');
        unlockScroll();
    });

    /*
        Подгрузка Инстаграма
    */
    $.get( "https://api.instagram.com/v1/users/self/media/recent?access_token=1394200939.40e3dbc.2f76b2ef9a9a47dfb4095cb75908abb1", function(data) {
        //console.log(data.data);
        var photos = data.data;
        photos = photos.slice(0, 9);
        //console.log(photos);
        var src = photos.map((photo) => {
            //console.log(photo);
            return {
                url: photo.images.standard_resolution.url,
                link: photo.link
            };
        });
        //console.log(src);

        var $instaHtml = '';
        src.forEach(item => {
            //console.log(item);
            $instaHtml += '<a class="instagram__photo" href="' + item.link + '"><img src="' + item.url + '"></a>';
        });

        $('.instagram__photos').html($instaHtml);
    });

    /*
        Выпадающее меню с категориями
    */
    $(".dropdown-button").click(function() {
        var $menu = $(this).next(".dropdown-menu");
        if( $menu.hasClass('dropdown-menu_hidden') )
            $menu.removeClass('dropdown-menu_hidden');
        else
            $menu.addClass('dropdown-menu_hidden');
    });

    /*
        Отображение того, что файл загрузился
    */
    $('.form-review__photo').change(function() {
        $('.form-review__file-text').html('Загружено!');
    });

    // Change variations prices and images on click

      var data = jQuery('.variations_form').data('product_variations');

      jQuery('.variation-input-label').click(function(event) {

        // Prices

        var id = jQuery(this).data("id");
        var price = jQuery(this).data("price");

        /*for (var i = 0; i < data.length; i++) {
          if (data[i].id == jQuery(this).data("id")) {
            if( data[i].price_html !== '') {
              jQuery('.summary>.price').html(data[i].price_html)
            }
          }
        }*/

        jQuery('.summary>.price').html(price);

        var selectedVariation = jQuery(this).attr('for');
        var selectedVariationID = jQuery(this).data('id');

        jQuery('.value>select option[value=' + selectedVariation + ']').attr('selected', true).trigger('change'); // Set selected variation
        jQuery('.variation_id').attr('value',selectedVariationID) // Set varitation id to hidden input

      });

    /*
        Анимации на главной
    */
    $('.categories-block').viewportChecker({
        classToAdd: 'reveal'
    });
    $('.stocks').viewportChecker({
        classToAdd: 'reveal'
    });
    $('.video-advices-wrapper').viewportChecker({
        classToAdd: 'reveal'
    });
    $('.article-recipe-wrapper').viewportChecker({
        classToAdd: 'reveal'
    });
});