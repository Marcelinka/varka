import {lockScroll, unlockScroll} from './lockScroll.js';

jQuery(document).ready(function($) {
	// Мобильное меню
    var $mobile_menu = $('.mobile-menu');
    var $menu_button = $('.menu__button');
    var $stripes = $menu_button.find('svg:first-child');
    var $cross = $menu_button.find('svg:last-child');

    // Сайдбар
    var $sidebar = $('.sidebar_tablets');
    var $sidebarButton = $('.catalog-filters-button');
    var $verticalDots = $sidebarButton.find('svg:first-child');
    var $horizontalDots = $sidebarButton.find('svg:last-child');

    $menu_button.click(function() {
        if( $mobile_menu.hasClass('mobile-menu_hidden') ) {
            $stripes.addClass('animate');
            $cross.addClass('animate');
            /*$stripes.hide();
            $cross.show();*/

            if( !$('.inf-modal').hasClass('inf-modal_hidden') ) {
                $('.inf-modal').addClass('inf-modal_hidden');
            }
            if( !$sidebar.hasClass('sidebar_tablets_hidden') ) {
                $sidebar.addClass('sidebar_tablets_hidden');
                $verticalDots.removeClass('animate');
                $horizontalDots.removeClass('animate');
            }

            $mobile_menu.removeClass('mobile-menu_hidden');
            lockScroll();
        }
        else {
            $cross.removeClass('animate');
            $stripes.removeClass('animate');
            /*$stripes.show();
            $cross.hide();*/

            $mobile_menu.addClass('mobile-menu_hidden');
            unlockScroll();
        }
    });
    
    $sidebarButton.click(function() {
        if($sidebar.hasClass('sidebar_tablets_hidden')) {
            $verticalDots.addClass('animate');
            $horizontalDots.addClass('animate');

            if( !$mobile_menu.hasClass('mobile-menu_hidden') ) {
                $mobile_menu.addClass('mobile-menu_hidden');
                $cross.removeClass('animate');
                $stripes.removeClass('animate');
                unlockScroll();
            }

            $sidebar.removeClass('sidebar_tablets_hidden');
        } else {
            $verticalDots.removeClass('animate');
            $horizontalDots.removeClass('animate');
            $sidebar.addClass('sidebar_tablets_hidden');
        }
    });
});