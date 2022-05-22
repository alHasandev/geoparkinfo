<?php


include "koneksi.php";



// include "fungsi.php";

// $geojson = query("SELECT * FROM tb_geojson");

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rridho</title>

  <!-- API STEFANI  -->

  <link href="js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />

  <!-- INI ADALAH STYLE CSS ICON  -->

  <link rel="stylesheet" href="icon.css" />
  <!-- INI ADALAH STYLE CSS ICON END -->


  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body align="center;">




  <div id="map" style="width: 100%; height: 400px;"></div>


  <script src="js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>


  <script src="js/leaflet.ajax.js"></script>

  <!-- INI ADALAH JS ICON -->
  <script src="js/bar.js"></script>
  <!-- END INI ADALAH JS ICON -->

  <script>
    var map = L.map('map').setView([-3.5705083, 114.7355407], 11);

    var LayerKita = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    });

    map.addLayer(LayerKita);





    function popUp(f, l) {
      var out = [];
      if (f.properties) {
        for (key in f.properties) {
          out.push(key + ": " + f.properties[key]);
        }
        l.bindPopup(out.join('<br>'));
      }
    }

    <?php
    $sql = $koneksi->query("SELECT * FROM tb_geojson");
    while ($key = $sql->fetch_assoc()) {

      echo "var $key[nama] = {
                'color': '$key[color]',
                'weight': 1,
                'opacity': 100
                };
               ";
    }
    ?>




    // legenda




    function iconByName(name) {
      return '<i class="icon icon-' + name + '"></i>';
    }



    function featureToMarker(feature, latlng) {
      return L.marker(latlng, {
        icon: L.divIcon({
          className: 'marker-' + feature.properties.amenity,
          html: iconByName(feature.properties.amenity),
          iconUrl: 'galeri/marker/' + feature.properties.amenity + '.png',
          iconSize: [38, 95],
          iconAnchor: [22, 94],
          popupAnchor: [-3, -76],
          shadowSize: [0, 0]
        })
      });
    }



    var baseLayers = [{
        name: "OpenStreetMap",
        layer: LayerKita
      },
      {
        name: "OpenCycleMap",
        layer: L.tileLayer('https://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')
      },
      {
        name: "Outdoors",
        layer: L.tileLayer('https://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
      }
    ];

    var overLayers = [


      <?php

      $sql = $koneksi->query("SELECT * FROM tb_geojson");
      while ($data = $sql->fetch_assoc()) {

        echo " {
     name: '$data[nama]',
    icon: iconByName('$data[nama]'),
    layer: new L.GeoJSON.AJAX(['galeri/$data[geojson]'],{onEachFeature:popUp,
    style:$data[nama],
    pointTolayer:featureToMarker}).addTo(map)  
  },";
      }
      ?>

      // {
      //   name: "Lab",
      //   icon: iconByName('lab'),
      //   layer: L.geoJson(Lab, {
      //     pointToLayer: featureToMarker
      //   }).addTo(map)
      // },



      // {
      //   name: "Bati Bati",
      //   icon: iconByName('BatiBati'),
      //   layer: new L.GeoJSON.AJAX(["galeri/Bati_Bati.geojson"],{onEachFeature:popUp,pointToLayer:featureToMarker}).addTo(map)  
      // },
      // {
      //   name: "Bar",
      //   icon: iconByName('bar'),
      //   layer: new L.GeoJSON.AJAX(["asset/Bati_Bati.geojson"],{onEachFeature:popUp,pointToLayer:featureToMarker}).addTo(map)  
      // },
      // {
      //   name: "Bar",
      //   icon: iconByName('bar'),
      //   layer: new L.GeoJSON.AJAX(["galeri/Bati_Bati.geojson"],{onEachFeature:popUp,pointToLayer:featureToMarker}).addTo(map)  
      // }
    ];

    var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers);

    map.addControl(panelLayers);


    // var latInput = document.querySelector("[name=latitude]");
    // var latInput = document.querySelector("[name=longitude]");

    // var curLocation = [51.505, -0.09];

    // map.attributionControl.setPrefix(false);

    //  var marker = new L.marker(curLocation, {

    //    draggable: 'true'
    //  });

    //  marker.on('dragend', function(event){
    //    var position = marker.getLatLng();
    //    marker.setLatLng(position,{
    //        draggable: 'true'

    //    }).bindPopup(position).update();

    //      $("#latitude").val(position.lat);
    // }     $("#longitude").val(position.lng);



    //  });

    //  map.addLayer(marker);
  </script>



  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.211029684979!2d114.58334081475763!3d-3.2978638975991577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4230963790c57%3A0x902859712cc02755!2sUniversitas%20Lambung%20Mangkurat%20-%20Kampus%20I%20Banjarmasin!5e0!3m2!1sid!2sid!4v1650550840288!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


</body>


</html>