// Custom scripts
(function($) {
    $(document).ready(function () {

        function initInnerMap( lngVal, latVal ){
            // Initialize the platform object:
            var platform = new H.service.Platform({
                app_id: 'KngCq2F5ZiDAoC5mHcOf',
                app_code: 'B9eBCS_ZNlw3uV-F8JilqQ',
            });

            // Obtain the default map types from the platform object
            var maptypes = platform.createDefaultLayers();

            // Instantiate (and display) a map object:
            var map = new H.Map(
                document.getElementById('mapInner'),
                maptypes.normal.map,
                {
                    zoom: 10,
                    center: { lng: lngVal, lat: latVal }
                });
        }
//Diagram init
       function initDiagram( initName, initPercent ){
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
                   {'percent': initPercent*10, 'color': '#00BFD1', 'text': 'bbbb' }, /*basic*/
                   {'percent': 0, 'color': '#FF1E7C' , 'text': 'bbbb2'},
               ],

               text: initName,
               textCustom: initPercent

           });
       }
       function drowDiagram(hoverName, hoverPercent, initName, initPercent){

           if(typeof initPercent == "undefined"){
               initPercent = hoverPercent;
                var coefficient = 0;
           }else{
                var coefficient = 10;
           }
           $('#diagram').find('svg').remove();
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
                   {'percent': initPercent*coefficient, 'color': '#00BFD1', 'text': 'bbbb' }, /*basic*/
                   {'percent': hoverPercent*10, 'color': '#FF1E7C' , 'text': 'bbbb2'},
               ],

               text: initName,
               textCustom: initPercent

           });
       }

//Diagram hover
        $('.city-features').on('hover','.navigation-item',function () {
           let hoverPercent = $(this).attr('data-percent');
           let hoverName    = '';
           let initName     = $("#basicFeature").attr("data-startFeture");
           let initPercent  = $("#basicFeature").attr("data-startScore");

            drowDiagram(hoverName, hoverPercent, initName, initPercent)
        });

//Close main popup
        $('.wrapper').on('click', '.main-popup', function () {
            $(this).fadeOut(400);
            $('.main-nav, .socials').addClass('shown');
        });

//Show submenu with cities
        $('.navigation').on('click', '.navigation-item > a', function (e) {
            e.preventDefault();
            // $('.navigation-sub').removeClass('sub-show');
            if($(this).next('.navigation-sub').hasClass("sub-show")){
                $('.navigation-sub').removeClass('sub-show');
            }else{
                $('.navigation-sub').removeClass('sub-show');
                $(this).next('.navigation-sub').addClass('sub-show');
            }
        });
//City popup
        $('.wrapper').on('click', '.navigation-city a', function () {

            $('.city-popup-box').fadeIn(200);
            $('#diagram').find('svg').remove();


/* ajax query */
            var ajaxurl = myajax.url;
            var cityId = $(this).attr('data-id');
            var featureName = $(this).closest('.navigation-item').children('a').text();

            var ajaxdata = {
                action: "city-popup",
                cityId: cityId,
                startFeture: featureName,
                nonce_code : myajax.nonce
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: ajaxdata,
                dataType : "json",
                complete:function(msg){
                    var title         = msg.responseJSON.title;
                    var topContent    = msg.responseJSON.topContent;
                    var fetureContent = msg.responseJSON.fetureContent;
                    var description   = msg.responseJSON.description;
                    var startFeture   = msg.responseJSON.startFeture;
                    var startScore    = msg.responseJSON.startScore;
                    var lngVal    = msg.responseJSON.lng;
                    var latVal    = msg.responseJSON.lat;
                    $("#mapInner").html('');
                    initInnerMap( lngVal, latVal );
                    $(".popup-title").html(title);
                    $(".city-popup-data").html(topContent);
                    $(".city-features > ul").html(fetureContent);
                    $(".popup-text > p").html(description);
                    $("#basicFeature").attr("data-startFeture", startFeture);
                    $("#basicFeature").attr("data-startScore", startScore);
                    initDiagram( startFeture, startScore );

                }
            });


        });
        $('.wrapper').on('click', '.popup-close', function () {
            $('.city-popup-box').fadeOut(400);
            $('#diagram').find('svg').remove();
        });
        
    //Show mobile menu
        $('.main-nav').on('click', '.menu-arrow', function () {
            $('.main-nav').toggleClass('mobile-show');
        })
    });
})(jQuery);
function eventMapAjax( currentCity , $) {
    $('.city-popup-box').fadeIn(200);
    $('#diagram').find('svg').remove();
    var eventCiryArray = currentCity.split("/");

    /* ajax query */
    var ajaxurl = myajax.url;
    var cityId = eventCiryArray[1];
    var featureName = '';

    var ajaxdata = {
        action: "city-popup",
        cityId: cityId,
        startFeture: featureName,
        nonce_code : myajax.nonce
    };

    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: ajaxdata,
        dataType : "json",
        complete:function(msg){
            var title         = msg.responseJSON.title;
            var topContent    = msg.responseJSON.topContent;
            var fetureContent = msg.responseJSON.fetureContent;
            var description   = msg.responseJSON.description;
            var startFeture   = msg.responseJSON.startFeture;
            var startScore    = msg.responseJSON.startScore;
            var lngVal    = msg.responseJSON.lng;
            var latVal    = msg.responseJSON.lat;
            $("#mapInner").html('');

                // initInnerMap( lngVal, latVal );
            var platform = new H.service.Platform({
                app_id: 'KngCq2F5ZiDAoC5mHcOf',
                app_code: 'B9eBCS_ZNlw3uV-F8JilqQ',
            });

            // Obtain the default map types from the platform object
            var maptypes = platform.createDefaultLayers();

            // Instantiate (and display) a map object:
            var map = new H.Map(
                document.getElementById('mapInner'),
                maptypes.normal.map,
                {
                    zoom: 10,
                    center: { lng: lngVal, lat: latVal }
                });

            $(".popup-title").html(title);
            $(".city-popup-data").html(topContent);
            $(".city-features > ul").html(fetureContent);
            $(".popup-text > p").html(description);
            $("#basicFeature").attr("data-startFeture", startFeture);
            $("#basicFeature").attr("data-startScore", startScore);
            initDiagramEvent( startFeture, startScore );

        }
    });
}


//Diagram init
function initDiagramEvent( initName, initPercent ){
    jQuery("#diagram").circliful({
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
            {'percent': initPercent*10, 'color': '#00BFD1', 'text': 'bbbb' }, /*basic*/
            {'percent': 0, 'color': '#FF1E7C' , 'text': 'bbbb2'},
        ],

        text: initName,
        textCustom: initPercent

    });
}
