var map;
jQuery(document).ready(function(){

    map = new GMaps({
        div: '#map',
        lat: -2.146559,
        lng: -79.967141
    });
    map.addMarker({
        lat: -2.146559,
        lng: -79.967141,
        title: 'ESPOL'
    });

});