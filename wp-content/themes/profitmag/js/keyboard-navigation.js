/**
 * File keyboard-navigation.js.
 *
 * Handles to support keyboar navigation
 */
$ = jQuery
jQuery(document).ready(function () {

//keyboard navigation for mean menu
    var myEvents = {
        click: function(e) {
            if ( jQuery(this).hasClass('menu-item-has-children') ) {
                jQuery(this).find('.slicknav_arrow').addClass('mean-clicked').text('-');
            }
            jQuery(this).siblings('li').find('.slicknav_arrow').removeClass('mean-clicked').text('+');
            jQuery(this).children('.sub-menu').show().end().siblings('li').find('ul').hide();

        },

        keydown: function(e) {
            e.stopPropagation();

            if (e.keyCode == 9) {


                if (!e.shiftKey &&
                    ( jQuery('.slicknav_menu li').index( jQuery(this) ) == ( jQuery('.slicknav_menu li').length-1 ) ) ){
                    jQuery('.slicknav_open').trigger('click');
                }  else if( jQuery('.slicknav_menu li').index( jQuery(this) ) == 0 ) {
                    $('.slicknav_open').removeClass('onfocus');
                }
                else if (e.shiftKey && jQuery('.slicknav_menu li').index(jQuery(this)) === 0)
                    jQuery('.slicknav_menu ul:first > li:last').focus().blur();
            }
        },

        keyup: function(e) {
            e.stopPropagation();
            if (e.keyCode == 9) {
                if (myEvents.cancelKeyup) myEvents.cancelKeyup = false;
                else myEvents.click.apply(this, arguments);
            }
        }
    }

    jQuery(document)
        .on('click', 'li', myEvents.click)
        .on('keydown', 'li', myEvents.keydown)
        .on('keyup', 'li', myEvents.keyup);

    jQuery('.slicknav_menu li').each(function(i) { this.tabIndex = i; });


});
