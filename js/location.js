var clientLat = 0;
var clientLong = 0;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            clientLat = position.coords.latitude;
            clientLong = position.coords.longitude;
        });
    } 
}

function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
    return deg * (Math.PI/180)
}

function prettyPrintDistance(lat, lng) {
    if (clientLat === 0 || clientLong === 0) {
        getLocation();
    }
    var distance = getDistanceFromLatLonInKm(clientLat, clientLong, lat, lng);

    if (distance < 1) {
        return (distance * 1000).toFixed(0) + "m";
    } else {
        return distance.toFixed(2) + "km";
    }
}

getLocation();

window.clientLat = clientLat;
window.clientLong = clientLong;
window.getDistanceInKm = (lat2, lon2) => {
    return prettyPrintDistance(lat2, lon2);
};