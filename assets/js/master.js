function initMap() {
    var evo = {lat: 45.499554, lng: -73.562558};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: evo
    });
    var marker = new google.maps.Marker({
        position: evo,
        map: map
    });
}