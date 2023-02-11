window.addEventListener('DOMContentLoaded', function(){
    $(function() {
    // Открытие / закрытие попапов
    //----- OPEN
    $('[data-popup-open]').on('click', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                
        

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close]').on('click', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

        e.preventDefault();
    });

    $('.popup__wrapper').on('click', function(event) {
        if( this == event.target) {
        $('.popup').fadeOut(350);
        }
    });
    });
});