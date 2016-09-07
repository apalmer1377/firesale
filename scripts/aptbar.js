var autocomplete;
var lat;
var lng;
var first = false; 

function initAutocomplete() {
  var inp = /** @type {!HTMLInputElement} */(document.getElementById('locinput'));
  autocomplete = new google.maps.places.Autocomplete(inp);
  autocomplete.setTypes(['geocode']);
  google.maps.event.addListener(autocomplete,'place_changed',getpos);
  
  if (first === false) {
    first = true;
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
    }
  }
}

function getpos() {
    var searchplace = autocomplete.getPlace();
    var searchaddr = searchplace.formatted_address;
    var geodude = new google.maps.Geocoder();
    geodude.geocode({'address':searchaddr},function(results,status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var aress = results[0].geometry.location.toUrlValue();
      var apos = aress.split(',');
      lat = apos[0];
      lng = apos[1];
    }
    //document.getElementById('content').innerHTML = lat;
    });
}