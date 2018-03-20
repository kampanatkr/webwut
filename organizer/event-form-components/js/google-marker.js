// In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
var map;
var marker = undefined;

function initMap() {
    var ku = {lat: 13.850049, lng: 100.566596};

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: ku,
        mapTypeId: 'terrain'
    });

    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;
    var addressResult;

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function (event) {
        if (marker !== undefined) {
            marker.setMap(null);
        }
        addMarker(event.latLng);
        var latlng = {
            lat: parseFloat(event.latLng.lat()),
            lng: parseFloat(event.latLng.lng())
        };

        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    infowindow.setContent(results[0].formatted_address);
                    addressResult = results[0].formatted_address;
                    document.getElementById('location').value = addressResult;
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    });

    // Adds a marker at the center of the map.
    addMarker(ku);
}

// Adds a marker to the map.
function addMarker(location) {
    var m = new google.maps.Marker({
        position: location,
        map: map
    });
    marker = m;
}