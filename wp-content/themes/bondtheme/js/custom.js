// Custom scripts
(function($) {
    $(document).ready(function () {

//Diagram init
       function initDiagram(){
           $("#diagram").circliful({
               animation: 1,
               animationStep: 5,
               foregroundBorderWidth: 10,
               backgroundBorderWidth: 10,
               textSize: 28,
               textStyle: 'font-size: 12px;',
               textColor: '#fffdfe',
               multiPercentage: 1,
               percentages: [
                   {'percent': 40, 'color': '#00BFD1', 'title': 'Gryffindor' },
                   {'percent': 85, 'color': '#FF1E7C', 'title': 'Ravenclaw' },
               ],

           });
       }
       function drowDiagram(percent){
           $('#diagram').find('svg').remove();
           $("#diagram").circliful({
               animation: 1,
               animationStep: 5,
               foregroundBorderWidth: 10,
               backgroundBorderWidth: 10,
               textSize: 28,
               textStyle: 'font-size: 12px;',
               textColor: '#fffdfe',
               multiPercentage: 1,
               percentages: [
                   {'percent': 40, 'color': '#00BFD1', 'title': 'Gryffindor' },
                   {'percent': percent, 'color': '#FF1E7C', 'title': 'Ravenclaw' },
               ],
           });
       }

//Diagram hover
        $('.city-features .navigation-item').hover(function () {
           let percent = $(this).attr('data-percent');
           drowDiagram(percent);
        });

//Close main popup
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
            $('.city-popup-box').fadeIn(200);
            initDiagram();
        });
        $('.wrapper').on('click', '.popup-close', function () {
            $('.city-popup-box').fadeOut(400);
            $('#diagram').find('svg').remove();
        });
    });
})(jQuery);
