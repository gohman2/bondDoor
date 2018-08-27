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


$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=London&sensor=false&language=ru');
$response = json_decode($response);

$lat = $response->results[0]->geometry->location->lat;
$lng = $response->results[0]->geometry->location->lng;
?>
<script>

    function initMap() {
        var styles = [
            {
                "stylers": [
                    {
                        "hue": "#2c3e50"
                    },
                    {
                        "saturation": 250
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "lightness": 50
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            }
        ];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 51.5073509, lng: -0.1277583}
        });
        map.setOptions({styles: styles});
        setMarkers(map);
    }

    // Data for the markers consisting of a name, a LatLng and a zIndex for the
    // order in which these markers should display on top of each other.
    var сities = [
        ['London', 51.5073509, -0.1277583],
        ['Bristol', 51.454513, -2.58791],
        ['Glasgow', 55.864237, -4.251806],
        ['Liverpool', 53.4083714, -2.9915726],
        ['Edinburgh', 55.953252, -3.188267]
    ];

    function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
            url: 'http://www.petstoretrading.com/images/billeder_af_tegn/color_6.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(20, 32),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 32)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: 'poly'
        };
        for (var i = 0; i < сities.length; i++) {
            var city = сities[i];
            var marker = new google.maps.Marker({
                position: {lat: city[1], lng: city[2]},
                map: map,
                icon: image,
                shape: shape,
                title: city[0],

            });
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0FE32AHtYYEuLcrnGFDan1_SJx8mkzss&callback=initMap"
        type="text/javascript"></script>
<?php wp_footer(); ?>

</body>
</html>
