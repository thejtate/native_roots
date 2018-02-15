var Drupal = Drupal || { 'settings': {}, 'behaviors': {}, 'locale': {} };

(function ($) {

    Drupal.settings.native_map_styles = [{
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [{"visibility": "simplified"}]
    }, {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [{"visibility": "simplified"}]
    }, {
        "featureType": "administrative.country",
        "elementType": "labels.text",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "administrative.province",
        "elementType": "labels.text",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]
    }, {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]
    }, {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
    }, {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]
    }, {
        "featureType": "road.local",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]
    }, {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
    }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]
    }, {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]
    }];

})(jQuery);
