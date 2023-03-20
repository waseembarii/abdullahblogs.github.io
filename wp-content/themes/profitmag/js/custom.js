jQuery(document).ready(function($) {
     
     // Latest post
     $('#js-latest').ticker({
       speed: 0.15,
       controls: false,
       titleText: '',       
     });
     
     // Sidebar Gallery Nivo LightBox
     $('.nivolight').nivoLightbox();
     
     $('.header-wrapper #site-navigation .menu-main-menu-container').addClass('clearfix');
     $(window).on('load',function(){
		$(".scroll-content").mCustomScrollbar({
    	axis:"x",
        mouseWheelPixels: "235",
        horizontalScroll: true,
            autoDraggerLength: true,
            //autoHideScrollbar: true,
            advanced:{
                autoScrollOnFocus: false,
                updateOnContentResize: true,
                updateOnBrowserResize: true
        }
    });
	});

	$('.fullPreview').click(function(){
		var fullImage = $(this).data('imageFull');
		$('#previewHolder').attr('src', fullImage);
	});
   
    //for scrollbar
    $('.header-wrapper .menu').slicknav({
        allowParentLinks :true,
        duration: 1000,
        prependTo: '.header-wrapper .responsive-slick-menu',
        'closedSymbol': '+',
        'openedSymbol': '-'
    });
     
     
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
    var isIe = /(trident|msie)/i.test( navigator.userAgent );

    if ( isIe && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var id = location.hash.substring( 1 ),
                element;

            if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                return;
            }

            element = document.getElementById( id );

            if ( element ) {
                if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false );
    }
} )();