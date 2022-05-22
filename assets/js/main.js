// Initiate map and set coordinate
const COORDINATES_LAMBUNG_MANGKURAT = [-3.2978639, 114.5813023, 17];
const ZOOM_LEVEL = 11;
const map = L.map('map').setView(COORDINATES_LAMBUNG_MANGKURAT, ZOOM_LEVEL);

// Set map layer from openstreet
L.tileLayer(
  'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}',
  {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken:
      'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
  }
).addTo(map);

// Add marker
const markerOptions = {
  title: 'Universitas Lambung Mangkurat - Kampus I Banjarmasin',
};
const marker = L.marker(COORDINATES_LAMBUNG_MANGKURAT, markerOptions).addTo(
  map
);

// Position of zoom control
const zoomPosition = ['verticalcenter', 'left'];
// Create additional Control placeholders
function addControlPlaceholders(map) {
  var corners = map._controlCorners,
    l = 'leaflet-',
    container = map._controlContainer;

  function createCorner(vSide, hSide) {
    var className = l + vSide + ' ' + l + hSide;

    corners[vSide + hSide] = L.DomUtil.create('div', className, container);
  }

  createCorner(...zoomPosition);
}
addControlPlaceholders(map);

// Change the position of the Zoom Control to a newly created placeholder.
map.zoomControl.setPosition(zoomPosition.join(''));

// Add popup 'ULM Banjarmasin' to marker
marker
  .bindPopup(
    '<b>ULM Banjarmasin!</b><br>Universitas Lambung Mangkurat - Kampus I Banjarmasin.'
  )
  .openPopup();
