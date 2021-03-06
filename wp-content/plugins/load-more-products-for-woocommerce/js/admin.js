(function ($){
    $(document).ready( function () {
        $(document).on('change', '.lmp_hide_element', function(){
            var value = $(this).val();
            var hide = $(this).data('hide');
            if( $(this).attr('type') == 'checkbox' ) {
                if( ! $(this).prop('checked')) {
                    value = 'false';
                }
            }
            var $hide = $(hide);
            $hide.each(function() {
                $(this).parents('tr').first().hide();
            });
            var $hide = $(hide+value);
            $hide.each(function() {
                $(this).parents('tr').first().show();
            })
        });
        $('.lmp_hide_element').trigger('change');
        $(document).on( 'click', '#lmp_use_mobile_show', function() {
            if( $(this).prop('checked') ) {
                $('.lmp_use_mobile').show();
            } else {
                $('.lmp_use_mobile').hide();
            }
        });
        $(document).on( 'click', '#lmp_use_mobile_hide', function() {
            if( $(this).prop('checked') ) {
                $('.hide_selectors').hide();
            } else {
                $('.hide_selectors').show();
            }
        });
        $(document).on( 'change', '.btn_border_color', function(){
            var $button = $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' );
            $button.css('border-color', $(this).parents('.framework-form-table').first().find('.btn_border_color').val());
        });
        
        $(document).on( 'change', '.framework-form-table .lmp_button_settings', function () {
            var $field = $(this).data('field');
            var $style = $(this).data('style');
            var $type = $(this).data('type');
            var $button = $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' );
            if($style != 'custom_css') {
                if ( $field == 'border' ) {
                    if($(this).val() == '' || $(this).val() == ' ')
                    {
                        var value = 0;
                    }
                    else
                    {
                        var value = $(this).val();
                    }
                    $button.css($style, value + 'px solid ' + $(this).parents('.framework-form-table').first().find('.btn_border_color').val());
                } else {
                    if($style == 'text') {
                        $button.text($(this).val());
                    } else {
                        if( $(this).val() == '' ) {
                            $button.css($style, $(this).val());
                        } else {
                            $button.css($style, $(this).val() + $type);
                        }
                    }
                }
            }
                   
        });
        $(document).on( 'change', '.bg_btn_color, .txt_btn_color', function() {
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('background-color', $(this).parents('.framework-form-table').first().find('.bg_btn_color').val());
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('color', $(this).parents('.framework-form-table').first().find('.txt_btn_color').val());
        });
        $(document).on( 'mouseenter', '.lmp_load_more_button .lmp_button', function () {
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('background-color', $(this).parents('.framework-form-table').first().find('.bg_btn_color_hover').val());
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('color', $(this).parents('.framework-form-table').first().find('.txt_btn_color_hover').val());
        });
        $(document).on( 'mouseleave', '.lmp_load_more_button .lmp_button', function () {
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('background-color', $(this).parents('.framework-form-table').first().find('.bg_btn_color').val());
            $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).css('color', $(this).parents('.framework-form-table').first().find('.txt_btn_color').val());
        });
        $(window).on('scroll', function () {
            if( $(window).scrollTop() > $('.btn-preview-td').offset().top + $('.btn-preview-td').outerHeight(true) ) {
                $('.btn-preview-td .btn-preview-block').addClass('btn-fixed-position');
            } else {
                $('.btn-preview-td .btn-preview-block').removeClass('btn-fixed-position');
            }
            if( $(window).scrollTop() > $('.btn-prev-preview-td').offset().top + $('.btn-prev-preview-td').outerHeight(true) ) {
                $('.btn-prev-preview-td .btn-preview-block').addClass('btn-fixed-position');
            } else {
                $('.btn-prev-preview-td .btn-preview-block').removeClass('btn-fixed-position');
            }
        });
        $(document).on( 'click', '.all_theme_default_lmp', function ( event ) {
            event.preventDefault();
            $( '.framework-form-table .lmp_button_settings, .framework-form-table .lmp_button_settings_hover' ).each( function ( i, o ) {
                $(o).val( $(o).data( 'default' ) ).trigger( 'change' );
            });
            $( '.framework-form-table .button-settings' ).trigger( 'change' );
            $('.br_colorpicker_default').click();            
        });
    });
})(jQuery);
