// Custom scripts
(function($) {

    function initDiagram(){
        var o = {
            init: function(){
                this.diagram();
            },
            random: function(l, u){
                return Math.floor((Math.random()*(u-l+1))+l);
            },
            diagram: function(){
                var r = Raphael('diagram', 200, 200),
                    rad = 60,
                    defaultText = 'Handsome',
                    speed = 250;

                r.circle(100, 100, 85).attr({ stroke: 'none' });
                // r.circle(300, 300, 85).attr({ stroke: 'none', fill: '#f00' });

                var title = r.text(100, 100, defaultText).attr({
                    font: '20px Arial',
                    fill: '#fff'
                }).toFront();

                r.customAttributes.arc = function(value, color, rad){
                    var v = 3.6*value,
                        alpha = v == 360 ? 359.99 : v,
                        random = o.random(91, 240),
                        a = (random-alpha) * Math.PI/180,
                        b = random * Math.PI/180,
                        sx = 100 + rad * Math.cos(b),
                        sy = 100 - rad * Math.sin(b),
                        x = 100 + rad * Math.cos(a),
                        y = 100 - rad * Math.sin(a),
                        path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
                    return { path: path, stroke: color }
                };

                $('.get').find('.arc').each(function(i){
                    var t = $(this),
                        color = t.find('.color').val(),
                        value = t.find('.percent').val(),
                        text = t.find('.text').text();

                    rad += 10;
                    var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': 10 });

                    z.mouseover(function(){
                        this.animate({ 'stroke-width': 12, opacity: .75 }, 1000, 'elastic');
                        if(Raphael.type != 'VML') //solves IE problem
                            this.toFront();
                        title.stop().animate({ opacity: 0 }, speed, '>', function(){
                            this.attr({ text: text + '\n' + value + '%' }).animate({ opacity: 1 }, speed, '<');
                        });
                    }).mouseout(function(){
                        this.stop().animate({ 'stroke-width': 10, opacity: 1 }, speed*4, 'elastic');
                        title.stop().animate({ opacity: 0 }, speed, '>', function(){
                            title.attr({ text: defaultText }).animate({ opacity: 1 }, speed, '<');
                        });
                    });
                });
            }
        };
        $(function(){ o.init(); });
    }


    $(document).ready(function () {
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

/* ajax query */
            var ajaxurl = '/wp-admin/admin-ajax.php';
            var cityId = $(this).attr('data-id');

            var ajaxdata = {
                action: "city-popup",
                cityId: cityId
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: ajaxdata,
                complete: function(response) {
                    console.log(response.responseText);
                }
            });


        });
    });
})(jQuery);
