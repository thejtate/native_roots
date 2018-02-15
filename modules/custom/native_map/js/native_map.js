(function ($) {
    Drupal.behaviors.nativeMapLocations = {
      attach: function (context, settings) {

          $('#locations-map', context).once('map-processed', function () {
              addMap($(this));
          });
      }
    };

    function addMap($wrap) {

        var DEFAULT_LINK_TYPE = 'medicinal';

        var $typeFilters = $('.location-filters [name="type-sort"]')
            , $locationFilter = $('#location-select')
            , $locationsBlocks = $('.section-location .content-item')
            , typeFilter = 'all'
            , userGeoPosition
            , userMarker;

        initCurrentPosition();

        //fix back coming
        $typeFilters.filter('[value="all"]').prop('checked', true);
        $locationFilter.val('none').trigger('change');

        $typeFilters.change(typeFilterHandler);
        $locationFilter.change(locationFilterHandler);

        var mapSettings = {
            zoom: 8,
            center: new google.maps.LatLng(39, -104),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles :  Drupal.settings.native_map_styles || []
        };
        var map = new google.maps.Map(
            $wrap[0],
            mapSettings
        );
        var searchBox = initSearchBox();

        var infowindow = new google.maps.InfoWindow({
            content: ''
        });


        var pinImage = new google.maps.MarkerImage(
            Drupal.settings.native_map.marker_img,
            new google.maps.Size(22, 32),
            // Origin
            new google.maps.Point(0, 0),
            // Anchor
            new google.maps.Point((22 / 2), 11),
            // scaledSize
            new google.maps.Size(22, 32));


        var locations = Drupal.settings.native_map.locations;

        for(var i = 0; i < locations.length; i++) {
            var marker =  new google.maps.Marker({
                position: new google.maps.LatLng(locations[i].lat, locations[i].lon),
                map: map,
                icon: pinImage
            });

            locations[i].marker = marker;
            locations[i].marker.addListener('click', function() {

                for (var i = 0; i < locations.length; i++) {
                    if(locations[i].marker == this) {
                        showLocationPopup(locations[i]);
                        break;
                    }
                }

            });

        }

        google.maps.event.addListener(map, "click", function(event) {
            infowindow.close();
        });

        fitBounds();
        setLocationsBlocksVisibility();

        function initCurrentPosition() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {

                    setUserPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                    fitBounds();
                });
            } else {
                // Browser doesn't support Geolocation
            }
        }

        function initSearchBox() {
            var input = document.getElementById('location-search-input')
                ,search = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

            map.addListener('bounds_changed', function() {
                search.setBounds(map.getBounds());
            });

            search.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                //change bounds
                var bounds = new google.maps.LatLngBounds();
                var place = places[0];
                setUserPosition(place.geometry.location);
                fitBounds();
            });

            return search;
        }

        function setUserPosition(position) {
            userGeoPosition = position;

            if(!userMarker) {
                userMarker = new google.maps.Marker({
                    position: userGeoPosition,
                    map: map
                    //icon: pinImage
                });
            } else {
                userMarker.setPosition(userGeoPosition);
            }

        }

       function setLocationsBlocksVisibility() {

            if (typeFilter == 'all') {
                $locationsBlocks.show();
            } else {
                $locationsBlocks.each(function () {
                    var $this = $(this);
                        if($this.data(typeFilter)){
                            $this.show();
                        } else {
                            $this.hide();
                        }
               });
            }

        }

        function rebuildLocationSelect() {
            var options = '<option value="none">Select a Location</option>';
            for(var i = 0; i < locations.length; i++) {

                if(typeFilter == 'all' || locations[i].types[typeFilter]) {
                    options += '<option value="' + i + '">' + locations[i].name + '</option>';
                }
            }
            $locationFilter.html(options);
        }

        function fitBounds(ignoreUserPosition) {
            var bounds = new google.maps.LatLngBounds();

            for(var i = 0; i < locations.length; i++) {
                if(locations[i].marker.map != null) {
                    bounds.extend(locations[i].marker.position);
                }
            }

            if(!ignoreUserPosition && userGeoPosition) {
                bounds.extend(userGeoPosition);
            }

            map.fitBounds(bounds);
        }

        function typeFilterHandler() {
            infowindow.close();
            typeFilter = $(this).val();

            for(var i = 0; i < locations.length; i++) {
                if(typeFilter == 'all' || locations[i].types[typeFilter]) {
                    if(locations[i].marker.map == null) {
                        locations[i].marker.setMap(map);
                    }
                } else {
                    locations[i].marker.setMap(null);
                }

            }
            setLocationsBlocksVisibility();
            fitBounds();
            rebuildLocationSelect();
        }

        function locationFilterHandler() {
            var val = $(this).val();
            if(val != 'none') {
                window.location.href = locations[val].url;
            }
        }

        function showLocationPopup(loc) {
            infowindow.setContent(Drupal.theme('locationPopup', loc, loc.url ));
            infowindow.open(map, loc.marker);
        }

    }

    Drupal.theme.prototype.locationPopup = function (loc, url) {

        return '<div class="popup-info">' +
            '<h4>' + loc.name + '</h4>' +
            '<span class="arddress">' + loc.address + '</span>' +
            '<span class="phone">' + loc.phone + '</span>' +
            '<span class="opens">Open ' + loc.open + '</span>' +
            '<span class="link"><a href="' + url + '" classes="loc-link">Go to location</a></span>' +
            '</div>';
    }

})(jQuery);