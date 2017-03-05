function initMap() {
            // Create a map object and specify the DOM element for display.

            var myLatLng = {lat: 36.705027, lng: 3.172607};
            var contentString = '<p>Scientific Club of ESI (CSE)</p>';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });


            var map = new google.maps.Map(document.getElementById('mapi'), {
                center: myLatLng,
                scrollwheel: false,
                zoom: 13,
                zoomControl : true,
                zoomControlOpt: { style : 'SMALL', position: 'TOP_LEFT' },
                panControl : false
            });
            var marker = new google.maps.Marker({
                position : myLatLng,
                title: 'Club CSE'
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            marker.setMap(map);
        }