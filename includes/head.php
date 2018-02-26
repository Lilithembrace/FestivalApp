<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Festival application 1.0</title>
    <!--fontawesome-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2hHLAoKfSIAFB1nqBZtuvdECCPj5zJwU&callback=initialize" type="text/javascript"></script>
        <script>
            function initAuto(){
                var lat = document.getElementById('lat_1').value;
                var lng = document.getElementById('lng_1').value;
                var position = [lat, lng];
                var latlng = new google.maps.LatLng(position[0], position[1]);
                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("mapCanvas_edit"), myOptions);

                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Latitude:"+position[0]+" | Longitude:"+position[1]
                });

                google.maps.event.addListener(map, 'click', function(event) {
                    var result = [event.latLng.lat(), event.latLng.lng()];
                    transition(result);
                    var lat = result[0];
                    var lng = result[1];
                    $('#lat_1').val(lat);
                    $('#lng_1').val(lng);
                });
                
                var numDeltas = 100;
                var delay = 7;
                var i = 0;
                var deltaLat;
                var deltaLng;

                function transition(result){
                    i = 0;
                    deltaLat = (result[0] - position[0])/numDeltas;
                    deltaLng = (result[1] - position[1])/numDeltas;
                    moveMarker();
                }

                function moveMarker(){
                    position[0] += deltaLat;
                    position[1] += deltaLng;
                    var latlng = new google.maps.LatLng(position[0], position[1]);
                    marker.setTitle("Latitude:"+position[0]+" | Longitude:"+position[1]);
                    marker.setPosition(latlng);
                    if(i!==numDeltas){
                        i++;
                        setTimeout(moveMarker, delay);
                    }
                }
            }
            function initialize() { 
                var position = [45.265644, 19.832980];
                var latlng = new google.maps.LatLng(position[0], position[1]);
                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Latitude:"+position[0]+" | Longitude:"+position[1]
                });

                google.maps.event.addListener(map, 'click', function(event) {
                    var result = [event.latLng.lat(), event.latLng.lng()];
                    transition(result);
                    var lat = result[0];
                    var lng = result[1];
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                });
                
                var numDeltas = 100;
                var delay = 7;
                var i = 0;
                var deltaLat;
                var deltaLng;

                function transition(result){
                    i = 0;
                    deltaLat = (result[0] - position[0])/numDeltas;
                    deltaLng = (result[1] - position[1])/numDeltas;
                    moveMarker();
                }

                function moveMarker(){
                    position[0] += deltaLat;
                    position[1] += deltaLng;
                    var latlng = new google.maps.LatLng(position[0], position[1]);
                    marker.setTitle("Latitude:"+position[0]+" | Longitude:"+position[1]);
                    marker.setPosition(latlng);
                    if(i!==numDeltas){
                        i++;
                        setTimeout(moveMarker, delay);
                    }
                }
                initAuto();
            }
            </script>
    <style>
        #mapCanvas, #mapCanvas_edit, #mapCanvas_show{
            width: 100%;
            height: 400px;
            /*overflow: auto !important;*/
        }
    </style>
</head>
