<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bondTheme
 */

?>
<?php
if( !is_404() ) {


    $getCityLocation = getCity();
    echo "<pre>";
        print_r($getCityLocation);
    echo "</pre>";
    $jsonLocation    = json_encode($getCityLocation);
?>
<script  type="text/javascript" charset="UTF-8" >

    var jsonLocation = <?php echo $jsonLocation; ?>;
    /**
     * Adds markers to the map highlighting the locations of the captials of
     * France, Italy, Germany, Spain and the United Kingdom.
     *
     * @param  {H.Map} map      A HERE Map instance within the application
     */
    function addMarkersToMap(map) {
        var svgMarkup = '<svg id="Слой_1" data-name="Слой 1" width="28" height="28" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 29.52 29.76"><defs><style>.cls-1{fill:#ee337c;fill-rule:evenodd;}.cls-2{fill:#ef5799;}</style></defs><title>point</title><image width="123" height="124" transform="scale(0.24)" xlink:href="data:image/png;base64,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"/><path class="cls-1" d="M27.82,33.7A6.17,6.17,0,1,1,34,27.54,6.17,6.17,0,0,1,27.82,33.7Zm0-10.48a4.32,4.32,0,1,0,4.32,4.32A4.32,4.32,0,0,0,27.82,23.22Z" transform="translate(-12.21 -13.5)"/><circle class="cls-2" cx="15.61" cy="14.04" r="3.39"/></svg>';

        var mapIcon = new H.map.Icon( svgMarkup );

        for (var i in jsonLocation){
            Marker = new H.map.Marker(
                {lat:jsonLocation[i]['lat'], lng:jsonLocation[i]['lng'] },
                {icon: mapIcon}
            );
            Marker.setData(jsonLocation[i]['city']+'/'+jsonLocation[i]['cityID']);
            map.addObject(Marker);
        }

    }
    /**
     * Boilerplate map initialization code starts below:
     */
//Step 1: initialize communication with the platform
    var platform = new H.service.Platform({
        app_id: 'KngCq2F5ZiDAoC5mHcOf',
        app_code: 'B9eBCS_ZNlw3uV-F8JilqQ',
        useHTTPS: false
    });
    var pixelRatio = window.devicePixelRatio || 1;
    var defaultLayers = platform.createDefaultLayers({
        tileSize: pixelRatio === 1 ? 256 : 512,
        ppi: pixelRatio === 1 ? undefined : 320
    });

    var mapTileService = platform.getMapTileService({ 'type': 'base' });

    // Create a tile layer which requests map tiles with an additional 'style'
    // URL parameter set to 'fleet':




    var fleetStyleLayer = mapTileService.createTileLayer(
        'maptile',
        'pedestrian.night',
        256,
        'png8',

        { 'style': 'mini' });

    // Set the new fleet style layer as a base layer on the map:

    //Step 2: initialize a map - this map is centered over Europe
    var map = new H.Map(document.getElementById('map'),
        defaultLayers.normal.map,{
            center: {lat:52.3555177, lng:-1.1743197},
            zoom: 6,
            pixelRatio: pixelRatio,


        });







    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    // Create the default UI components
    // var ui = H.ui.UI.createDefault(map, defaultLayers);
    // Now use the map as required...
    // addMarkersToMap( map.setBaseLayer(fleetStyleLayer));
    var mapEvents =   addMarkersToMap( map.setBaseLayer(fleetStyleLayer));
    // Add event listeners:
    map.addEventListener('tap', function(evt) {
        // Log 'tap' and 'mouse' events:
        // console.log(evt.type, evt.currentPointer.type, evt.target.getData());
        map.getElement().style.cursor = (evt.target === map) ? '' : 'pointer';
        if( evt.target !== map  ){
            var currentCity = evt.target.getData();
            eventMapAjax( currentCity , jQuery);
        }


    });
    map.addEventListener('pointermove', function(evt) {
        // Log 'tap' and 'mouse' events:
        // console.log(evt.type, evt.currentPointer.type, evt.target.getData());
        map.getElement().style.cursor = (evt.target === map) ? '' : 'pointer';
       /* if(evt.target !== map){
            var bubble =  new H.ui.InfoBubble(evt.target.getPosition(), {
                // read custom data
                content: evt.target.getData()
            });
            // show info bubble

            // ui.addBubble(bubble);

        }else{
            ui.removeBubble(bubble);
        }*/




    });

    </script>
    <?php
}

wp_footer(); ?>
</body>
</html>
