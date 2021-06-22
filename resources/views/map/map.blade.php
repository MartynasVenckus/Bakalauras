<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Žemėlapis</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
</head>
<style>
.custom-popup .leaflet-popup-content-wrapper {
  background:#2c3e50;
  color:#fff;
  font-size:16px;
  line-height:24px;
  }
  .custom-popup .leaflet-popup-tip {
    background:#2c3e50;
  }
</style>
<body>
    <div class="h-screen"> 

<div class="flex justify-between logo">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Žemėlapis</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>

<div id="mapid" class="custom-popup"></div>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
</script>

<script>

     var truck = <?php echo json_encode($data['truck']); ?>

    for(var i = 0; i < truck.length; i++){
            var model = truck[i].model;
            var brand = truck[i].brand;
            var trailer = truck[i].licensePlate;
    }   

    var mymap = L.map('mapid').setView([0, 0], 5); 

    var markerCurrent = L.marker([0, 0]).addTo(mymap);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFydHZlbiIsImEiOiJja28zNXBtbmgxNmFsMnZrNHVuYmY2ZnFtIn0.M0dbvt_5B9Mu8zU9Ek6ASw'
    }).addTo(mymap);

    const gps_url = 'http://127.0.0.1:8000/zemelapis/gps';

    var firstTime = true; 
    var firstTimePoli = true;
    var lat_before;
    var lng_before;

   

    async function getGPS(){
       
        const response = await fetch(gps_url);
        const data = await response.json();
        const { latitude, longitude } = data;

        markerCurrent.setLatLng([latitude, longitude]);

        if(firstTime){
            mymap.setView([latitude, longitude], 12);
            firstTime = false;
            lat_before = latitude;
            lng_before = longitude;
        }

        var latlngs = [[lat_before, lng_before],[latitude, longitude]];
        var line = L.polygon(latlngs).addTo(mymap);
        line.bindPopup("<h6>Modelis: "+ model+" </h6> <br> <h6>Markė: "+brand+" </h6> <br> <h6>Valstybiniai numeriai: "+trailer+"</h6>" + '<br/><button type="button" class="btn btn-info ">Transporto priemonės kelionės duomenys</button>');
        lat_before = latitude;
        lng_before = longitude;
        
    }
    markerCurrent.bindPopup("<h6>Modelis: "+ model+" </h6> <br> <h6>Markė: "+brand+" </h6> <br> <h6>Valstybiniai numeriai: "+trailer+"</h6>" + '<br/><button type="button" class="btn btn-info ">Transporto priemonės kelionės duomenys</button>');

    getGPS();

    setInterval(getGPS, 1000);

</script>

</div>
</body>



</html>