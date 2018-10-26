// Custom scripts
(function($) {
    $(document).ready(function () {

//Diagram init
       function initDiagram( initName, initPercent, animationStatus ){

           if(typeof initPercent === "undefined"){
               initPercent = "";
               var coefficient = 0;
               var percentagesArray = [
                   {'percent': 0, 'color': '#FF1E7C' , 'text': 'bbbb2'}
               ];
           }else{
               var coefficient = 10;
               var percentagesArray = [
                   {'percent': initPercent * coefficient, 'color': '#00BFD1', 'text': 'bbbb' }, /*basic*/
                   {'percent': 0, 'color': '#FF1E7C' , 'text': 'bbbb2'}
               ];
           }
           $("#diagram").circliful({
               animation: animationStatus,
               animationStep: 10,
               foregroundBorderWidth: 10,
               backgroundBorderWidth: 10,
               textSize: 28,
               iconColor: 'transparent',
               textStyle: 'font-size: 14px;',
               textColor: '#fffdfe',
               multiPercentage: 1,
               percentages: percentagesArray,
               text: initName,
               textCustom: initPercent
           });
       }
       function drowDiagram(hoverName, hoverPercent, initName, initPercent){
           if(typeof initPercent == "undefined"){
               if(initName == ""){
                   initPercent = hoverPercent;
               }else{
                   initPercent = "";
               }

               var coefficient = 0;

               var percentagesArray = [
                   {'percent': hoverPercent*10, 'color': '#FF1E7C' }
               ];
           }else{
                var coefficient = 10;
                var percentagesArray = [
                   {'percent': initPercent*coefficient, 'color': '#00BFD1' }, /*basic*/
                   {'percent': hoverPercent*10, 'color': '#FF1E7C' }
               ];
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
               percentages: percentagesArray,
               text: initName,
               textCustom: initPercent
           });
       }
    //Close city-popup
        $('.wrapper').on('click', '.popup-close', function () {
            $('.city-popup-box').fadeOut(400);
            $('.navigation-city .active').removeClass('active');
            $('.navigation-sub').removeClass('sub-show');
            $('.navigation-item > a').removeClass('active-item');
            $('#diagram').find('svg').remove();
            $('.main-nav, .socials').addClass('shown');
        });

    //Show mobile menu
        $('.main-nav').on('click', '.menu-arrow', function () {
            $('.main-nav').toggleClass('mobile-show');
        });

//Diagram click
        $('.city-features').on('click','.navigation-item',function () {
           $('.navigation-item').removeClass('active-item');
           $(this).addClass('active-item');
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
            $('.navigation-item > a').removeClass('active-item');
            $(this).addClass('active-item');
            $('.navigation-city .active').removeClass('active');
            if($(this).next('.navigation-sub').hasClass("sub-show")){
                $('.navigation-sub').removeClass('sub-show');
            }else{
                $('.navigation-sub').removeClass('sub-show');
                $(this).next('.navigation-sub').addClass('sub-show');
            }
        });

//Info popup
        $('.info-popup-opener').on('click', function () {
            $('.info-popup-box').fadeIn(300);
        });

        $('.info-popup-box .popup-close').on('click', function () {
            $(this).closest('.info-popup-box').fadeOut(300);
        });

//City popup
        $('.wrapper').on('click', '.navigation-city a', function () {
            $('#diagram').find('svg').remove();
            var ww = $(window).width();
            if(ww < 891){
                $('.main-nav').removeClass('mobile-show');
                $('.main-nav, .socials').removeClass('shown');
                $('.city-popup-box').fadeIn(200);
            } else if(ww < 1270){
                $('.navigation-sub').removeClass('sub-show');
            }else {
                $(this).addClass('active');
                $('#diagram').find('svg').remove();
            }

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
                beforeSend: function(){
                    $('.preloader-wrapper').show();
                },
                complete:function(msg){
                    var response = msg.responseJSON;
                    var title         = response.title,
                    topContent    = response.topContent,
                    fetureContent = response.fetureContent,
                    description   = response.description,
                    startFeture   = response.startFeture,
                    startScore    = response.startScore,
                    lngVal    = response.lng,
                    latVal    = response.lat;
                    if (response.image_map !== null && response.image_map.sizes) {
                        var image_map = response.image_map.sizes.image_map;
                    }
                    $('.city-popup-box').fadeIn(200);
                    $("#mapInner").html('');
                    if (response.image_map !== null && image_map !== undefined && image_map !== false) {
                        $('#mapInner').css({
                            'background-image': 'url(' + image_map + ')',
                            'background-size': 'cover',
                            // 'margin-left': '126px',
                            'width': '420px',
                            'height': '250px'
                        });
                    } else {
                        initInnerMap( lngVal, latVal );
                    }
                    $(".popup-title").html(title);
                    $(".city-popup-data").html(topContent);
                    $(".city-features > ul").html(fetureContent);
                    $(".popup-text > div").html(description);
                    $("#basicFeature").attr("data-startFeture", startFeture);
                    $("#basicFeature").attr("data-startScore", startScore);
                    initDiagram( startFeture, startScore, 1 );
                    $('.preloader-wrapper').hide();
                    $('.city-popup .navigation-item:first').trigger('click');
                }
            });


        });

    });
})(jQuery);
function eventMapAjax( currentCity , $) {

    $('.navigation-sub').removeClass('sub-show');
    $('.main-nav').removeClass('mobile-show');
    $('.main-nav, .socials').removeClass('shown');

    $('#diagram').find('svg').remove();

    /* ajax query */
    var ajaxurl = myajax.url;
    var featureName = '';

    var ajaxdata = {
        action: "city-popup",
        cityId: currentCity,
        startFeture: featureName,
        nonce_code : myajax.nonce
    };

    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: ajaxdata,
        dataType : "json",
        beforeSend: function(){
            $('.preloader-wrapper').show();
        },
        complete:function(msg){
            var response = msg.responseJSON;
            var title         = response.title;
            var topContent    = response.topContent;
            var fetureContent = response.fetureContent;
            var description   = response.description;
            var startFeture   = response.startFeture;
            var startScore    = response.startScore;
            var lngVal    = response.lng;
            var latVal    = response.lat;
            if (response.image_map !== null && response.image_map.sizes) {
                var image_map = response.image_map.sizes.image_map;
            }
            $('.city-popup-box').fadeIn(200);
            $("#mapInner").html('');
            if (response.image_map !== null && image_map !== undefined && image_map !== false) {
                $('#mapInner').css({
                    'background-image': 'url(' + image_map + ')',
                    'background-size': 'cover',
                    'width': '420px',
                    'height': '250px'
                });
            } else {
                initInnerMap( lngVal, latVal );
            }
            $(".popup-title").html(title);
            $(".city-popup-data").html(topContent);
            $(".city-features > ul").html(fetureContent);
            $(".popup-text > div").html(description);
            $("#basicFeature").attr("data-startFeture", startFeture);
            $("#basicFeature").attr("data-startScore", startScore);
            initDiagramEvent( startFeture, startScore );
            $('.preloader-wrapper').hide();
            $('.city-popup .navigation-item:first').trigger('click');
        }
    });
}


//Diagram init
function initDiagramEvent( initName, initPercent ){
    jQuery("#diagram").circliful({
        animation: 1,
        animationStep: 10,
        foregroundBorderWidth: 10,
        backgroundBorderWidth: 10,
        textSize: 28,
        iconColor: 'transparent',
        textStyle: 'font-size: 14px;',
        textColor: '#fffdfe',
        multiPercentage: 1,
        percentages: [{'percent': 0, 'color': '#FF1E7C' , 'text': 'bbbb2'}],
        text: initName,
        textCustom: initPercent

    });
}

function initInnerMap( lngVal, latVal ){

    return new ol.Map({
        controls : ol.control.defaults({
            attribution : false,
            zoom : false
        }),
        layers: [mapImage],
        target: 'mapInner',
        view: new ol.View({
            center: ol.proj.fromLonLat([
                lngVal + 0.02,
                latVal
            ]),
            zoom: 6,
            maxResolution: 2800
        })
    });

}