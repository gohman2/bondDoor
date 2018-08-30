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
    $getCityLocation = getCity();
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
        var svgMarkup = '<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 473.931 473.931">' +
            '<circle cx="236.966" cy="236.966" r="236.966" fill="red"/>' +
            '<g fill="#333">' +
            '<path d="M383.164 237.123c-1.332 80.699-65.514 144.873-146.213 146.206-80.702 1.332-144.907-67.52-146.206-146.206-.198-12.052-18.907-12.071-18.709 0 1.5 90.921 73.993 163.414 164.914 164.914 90.929 1.5 163.455-76.25 164.922-164.914.199-12.071-18.51-12.052-18.708 0z"/>' +
            '<circle cx="164.937" cy="155.227" r="37.216"/>' +
            '<circle cx="305.664" cy="155.227" r="37.216"/>' +
            '</g>' +
            '</svg>';

        var mapIcon = new H.map.Icon( svgMarkup );

        for (var i in jsonLocation){
            Marker = new H.map.Marker(
                {lat:jsonLocation[i]['lat'], lng:jsonLocation[i]['lng'] },
                {icon: mapIcon}
            );
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
        useHTTPS: true
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
        'normal.day.grey',
        256,
        'png8',
        { 'style': 'alps' });

    // Set the new fleet style layer as a base layer on the map:

    //Step 2: initialize a map - this map is centered over Europe
    var map = new H.Map(document.getElementById('map'),
        defaultLayers.normal.map,{
            center: {lat:50, lng:5},
            zoom: 5,
            pixelRatio: pixelRatio,


        });






    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    // Create the default UI components
    var ui = H.ui.UI.createDefault(map, defaultLayers);
    // Now use the map as required...
    // addMarkersToMap( map.setBaseLayer(fleetStyleLayer));
    addMarkersToMap( map.setBaseLayer(fleetStyleLayer));
</script>
<?php wp_footer(); ?>
</body>
</html>
