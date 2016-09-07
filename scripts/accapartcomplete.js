var autocomplete;
var placesearch;
var street_num;
var rout;
var city;
var zip;
var state;
var first = false; 

function initAutocomplete() {
  var inp = /** @type {!HTMLInputElement} */(document.getElementById('testadd'));
  autocomplete = new google.maps.places.Autocomplete(inp);
  autocomplete.setTypes(['geocode']);
  google.maps.event.addListener(autocomplete,'place_changed',fillform);
  
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

function fillform() {
  var place = autocomplete.getPlace();
  var addr = place.formatted_address;
  var geo = new google.maps.Geocoder();
  geo.geocode({'address':addr}, function(results,status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var ress = results[0].geometry.location.toUrlValue();
      var pos = ress.split(',');
      document.getElementById('testlat').value = pos[0];
      document.getElementById('testlng').value = pos[1];
    }
  });
  for (var i=0; i < place.address_components.length; i++) {
    switch(place.address_components[i].types[0]) {
      case 'street_number':
        street_num = place.address_components[i]['long_name'];
        break;
      case 'route':
        rout = place.address_components[i]['long_name'];
        break;
      case 'locality':
        city = place.address_components[i]['long_name'];
        break;
      case 'postal_code':
        zip = place.address_components[i]['short_name'];
        break;
      case 'administrative_area_level_1':
        state = place.address_components[i]['short_name'];
        break;
      default:
        break;
    }
  }
  
  document.getElementById('testadd').value = street_num + " " + rout;
  document.getElementById('testcit').value = city;
  document.getElementById('testz').value = zip;
  document.getElementById('testst').value = state;
  
}