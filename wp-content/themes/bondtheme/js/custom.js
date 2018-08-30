// Custom scripts
(function($) {
//Close main popup
    $(document).ready(function () {
        $('.wrapper').on('click', '.main-popup', function () {
            $(this).fadeOut(400);
            $('.main-nav').addClass('shown');
        });

//Show submenu with cities
        $('.navigation').on('click', '.navigation-item > a', function (e) {
            e.preventDefault();
            $('.navigation-sub').fadeOut(150);
            if(($(this).next('.navigation-sub')).is(":hidden")){
                $(this).next('.navigation-sub').fadeIn(200);
            }
        });
//City popup
        $('.wrapper').on('click', '.navigation-city a', function () {
            $(this).fadeOut(400);
            $('.navigation-sub').fadeOut(150);
            $('.city-popup-wrapper').fadeIn(200);
        });
    });
})(jQuery);
