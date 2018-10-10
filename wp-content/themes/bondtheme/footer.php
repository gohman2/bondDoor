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

if( !is_404() ) {

?>
    <script>

        var styleCache = {};
        var styleFunction = function(feature, resolution) {
            var radius = 5;
            var style = styleCache[radius];
            if (!style) {
                style = [new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: radius,
                        fill: new ol.style.Fill({
                            color: 'rgba(239, 87, 153, 0.7)',
                            cursor: 'pointer'
                        }),
                        stroke: new ol.style.Stroke({
                            color: 'rgba(239, 87, 153, 0.3)',
                            width: 10,
                        })
                    })
                })];
                styleCache[radius] = style;
            }
            return style;
        };

        var markers = <?php echo get_option( 'geojson' ) ?>;

        var iconFeatures=[];

        for ( var i in markers.features ) {
            markerCoordinates = new ol.geom.Point(ol.proj.transform(markers.features[i].coordinates, 'EPSG:4326', 'EPSG:3857'));
            markerItem = new ol.Feature({
                geometry: markerCoordinates,
                name: markers.features[i].name,
                id: markers.features[i].id
            });
            iconFeatures.push(markerItem);
        }

        var vectorSource = new ol.source.Vector({
            features: iconFeatures //add an array of features
        });
        var vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            style: styleFunction
        });

        var mapImage = new ol.layer.Tile({
            source: new ol.source.OSM()
        });
        
        var coordinates = [
            -6.2426,
            55.4808
        ];
        if (window.innerWidth <= 890) {
            coordinates = [-1.8904,52.4862];
        }

        var map = new ol.Map({
            controls : ol.control.defaults({
                attribution : false,
            }),
            layers: [
                mapImage,
                vectorLayer,
            ],
            target: 'map',
            view: new ol.View({
                center: ol.proj.fromLonLat(coordinates),
                zoom: 0,
                maxResolution: 2800
            })
        });

        var displayFeatureInfo = function(pixel) {
            var feature = map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                return feature;
            });
            if (feature) {
                eventMapAjax(feature.get('id'), jQuery);
            } else {
                return;
            }
        };

        map.on('click', function(evt) {
            displayFeatureInfo(evt.pixel);
        });
        map.on('pointermove', function (e) {
            if (e.dragging) return;
            var pixel = map.getEventPixel(e.originalEvent);
            var hit = map.hasFeatureAtPixel(pixel);
            map.getViewport().style.cursor = hit ? 'pointer' : '';
        });
    </script>
    <?php
}

wp_footer(); ?>
</body>
</html>
