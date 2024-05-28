@extends('layouts.user_type.auth')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
     <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        #carte {
            height: 80vh;
        }
        #infos{
            width: 80%;
            height: 30%;
            background-color:White;
            color: red;
            font-weight:bold;
            border-radius:8px;
            text-align: center;
        }
      
    </style>
</head>
<body>

   <div id="infos">
     <p> If your location is not correct, enter the name of your neighborhood
        or a known location close to your position in the first box of the bubble</p>
   </div>

    <br><div id="carte"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script>
        window.onload = function () {
            var carte = L.map('carte').setView([7.369722, 12.354722], 8);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 30,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(carte);

            var options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            };

            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                carte.setView([lat, lon], 13);
                L.marker([lat, lon]).addTo(carte).bindPopup('Vous êtes ici !').openPopup();

                // Utilisation du géocodeur pour obtenir les coordonnées de l'adresse de la pharmacie
                var geocoder = new L.Control.Geocoder.Nominatim();
                var location = '{{ $pharmacie_nom }}'; // Adresse de la pharmacie

                geocoder.geocode(location, function(results) {
                    var latLng = new L.LatLng(results[0].center.lat, results[0].center.lng);
                    var marker = new L.Marker(latLng).addTo(carte);
                    // Mettre à jour les waypoints pour inclure la destination de la pharmacie
                    L.Routing.control({
                        waypoints: [
                            L.latLng(lat, lon), // Point de départ : position de l'utilisateur
                            latLng // Point d'arrivée : coordonnées de la pharmacie
                        ],
                        routeWhileDragging: true,
                        geocoder: L.Control.Geocoder.nominatim()
                    }).addTo(carte);
                });
            }, function (error) {
                console.error('Erreur lors de l\'obtention de la position de l\'utilisateur :', error);
            }, options);
        };
    </script>
@endsection
