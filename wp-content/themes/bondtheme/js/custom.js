// Custom scripts
(function($) {
    $(document).ready(function () {

//Diagram init
       function initDiagram( initPercent ){
           $("#diagram").circliful({
               animation: 1,
               animationStep: 5,
               foregroundBorderWidth: 10,
               backgroundBorderWidth: 10,
               textSize: 28,
               iconColor: 'transparent',
               textStyle: 'font-size: 14px;',
               textColor: '#fffdfe',
               multiPercentage: 1,
               percentages: [
                   {'percent': 40, 'color': '#00BFD1', 'text': 'bbbb' },
                   {'percent': 85, 'color': '#FF1E7C' , 'text': 'bbbb2'},
               ],
               replacePercentageByText: 'tretrtre',
               text: "Sense of humor",
               textCustom: "7.5"

           });
       }
       function drowDiagram(initPercent, percent){
           console.log(typeof percent);
           $('#diagram').find('svg').remove();
           $("#diagram").circliful({
               animation: 1,
               animationStep: 5,
               iconColor: 'transparent',
               foregroundBorderWidth: 10,
               backgroundBorderWidth: 10,
               textSize: 28,
               textStyle: 'font-size: 14px;',
               textColor: '#fffdfe',
               multiPercentage: 1,
               percentages: [
                   {'percent': 40, 'color': '#00BFD1' },
                   {'percent': percent, 'color': '#FF1E7C'},
               ],
               replacePercentageByText: '',
               text: initPercent,

           });
       }

//Diagram hover
        $('.city-features .navigation-item').hover(function () {
           let percent = $(this).attr('data-percent');
           drowDiagram('Handsome/5.5', percent);
        });

//Close main popup
        $('.wrapper').on('click', '.main-popup', function () {
            $(this).fadeOut(400);
            $('.main-nav, .socials').addClass('shown');
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
            // $(this).fadeOut(400);
            // $('.navigation-sub').fadeOut(150);

            $('.city-popup-box').fadeIn(200);
            $('#diagram').find('svg').remove();
            initDiagram('Handsome 5.5');

/* ajax query */
            var ajaxurl = '/wp-admin/admin-ajax.php';
            var cityId = $(this).attr('data-id');
            var featureName = $(this).closest('.navigation-item').children('a').text();

            var ajaxdata = {
                action: "city-popup",
                cityId: cityId
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: ajaxdata,
                complete: function(response) {
                    // console.log(response.responseText);
                }
            });


        });
        $('.wrapper').on('click', '.popup-close', function () {
            $('.city-popup-box').fadeOut(400);
            $('#diagram').find('svg').remove();
        });
    });
})(jQuery);
