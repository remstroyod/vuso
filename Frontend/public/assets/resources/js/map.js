
  
  let infowindow;
  
  let normalIcon;
  let activeIcon;


  if ( document.getElementById('casino-items-map') ) {
      let markers = [];
      let marker, i;

      let bounds = new google.maps.LatLngBounds();

      let locations = [
          ['1 title', 41.626734, 41.600175, 1],
          ['2 title', 43.740070, 7.426644, 2],
          ['3 title', 30.033333, 31.233334, 3],
          ['4 title', 25.276987, 55.296249, 4],
          ['5 title', 50.4547, 30.5238, 5]
      ];

      let map = new google.maps.Map(document.getElementById('casino-items-map'), {
          zoom: 1,
          center: new google.maps.LatLng(41.626734, 41.600175),
          styles: '' 
          // mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      infowindow = new google.maps.InfoWindow();


      for ( i = 0; i < locations.length; i++ ) {

          marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i][1], locations[i][2]),
              map: map,
              icon: normalIcon
          });

          markers.push(marker);

          bounds.extend(marker.position);

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {

                  for (let j = 0; j < markers.length; j++) {
                      markers[j].setIcon(normalIcon);
                  };

                  infowindow.setContent(locations[i][0]);
                  this.setIcon(activeIcon);
                  // infowindow.open(map, marker);

                  map.setZoom(15);
                  map.setCenter( marker.getPosition() );


                  $('.casino-items-list .casino-item[data-casino-id="' + i + '"]').addClass('active').siblings().removeClass('active');

              }
          })(marker, i));


          $('.casino-items-list .casino-item').each( function( index ) {
              $(this).attr('data-casino-id', index);
          });

          $('.casino-items-list .casino-item .map-link').on('click', function () {
              $(this).closest('.casino-items-list .casino-item').addClass('active').siblings().removeClass('active');
              google.maps.event.trigger(markers[$(this).closest('.casino-items-list .casino-item').attr('data-casino-id')], 'click');
          });

      };

      map.fitBounds(bounds);

      let listener = google.maps.event.addListener(map, 'idle', function () {
          // map.setZoom(3);
          // google.maps.event.removeListener(listener);
      });

  };
  // Страница карта
  
  