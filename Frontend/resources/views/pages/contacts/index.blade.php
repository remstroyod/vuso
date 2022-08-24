@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    <!-- Locations -->
    <section class="locations">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- list -->
                <div class="col-4 locations__list">

                    @include( 'partials.page-title', [ 'class' => 'locations__list__title', 'after' => '' ] )

                    @if( $countries->count() )

                        <!-- selector -->
                        <div class="locations__list__selector">
                            <select id="city-selector" onchange="goToPage(this);">
                                <option
                                    value="0"
                                    data-url="{{ route( 'contacts.index' ) }}"
                                    data-href="{{ route( 'contacts.index' ) }}"
                                    disabled
                                    @if( ! request()->route('countries') )
                                        selected="selected"
                                    @endif
                                >
                                    {{ __( 'Выберите город' ) }}
                                </option>

                                @foreach( $countries as $country )
                                    {{--@if ( $country->name ) --}}
                                    <option
                                        {{--data-city-id="{{ $country->id }}"
                                        data-index="{{ $loop->index }}"
                                        --}}
                                        value="{{ $country->id }}"
                                        @if( request()->route('countries') )
                                            @if( request()->route('countries')->id === $country->id )
                                                selected="selected"
                                            @endif
                                        @endif
                                        data-url="{{ route( 'contacts.city', $country ) }}"
                                        data-href="{{ route( 'contacts.city', $country ) }}"
                                    >
                                        {{ $country->name }}
                                    </option>
                                    {{--@endif--}}
                                @endforeach
                            </select>
                        </div>
                        <!-- end selector -->

                    @endif

                    <div class="locations__list__cities">
                        @if( $offices->count() )
                            <div class="locations__list__city" data-city="{{request()->routeIs('contacts.city') ? request()->route('countries')->id : 0}}" style="display: block !important;">
                                <!-- swiper -->
                                <div class="locations__list__items swiper-container locations-slider-mobile">

                                    <!-- wrapper -->
                                    <div class="swiper-wrapper">

                                        @foreach( $offices as $office)

                                            {{--
                                            <div class="swiper-slide location-item @if( $loop->iteration === 1 ) selected @endif" data-city-office="{{ $loop->index }}">
                                            --}}

                                            {{--@if ( $office->name && $office->address )--}}
                                            @if ( $office->lat && $office->lng )
                                            <div class="swiper-slide location-item" data-city-office="{{ $loop->index }}">
                                                <!-- title -->
                                                <div class="location-item__address">
                                                    {{ $office->name }}
                                                </div>
                                                <!-- end title -->

                                                @if( $office->address )
                                                    <!-- address -->
                                                    <div class="location-item__office">
                                                        {{ $office->address }}
                                                    </div>
                                                    <!-- end address -->
                                                @endif

                                                @if( $office->time )
                                                    <!-- worktime -->
                                                    <div class="location-item__worktime">
                                                        {{ $office->time }}
                                                    </div>
                                                    <!-- end worktime -->
                                                @endif

                                                @if( $office->email )
                                                    <!-- email -->
                                                    <a href="mailto:{{ $office->email }}" class="location-item__mail">
                                                        {{ $office->email }}
                                                    </a>
                                                    <!-- end email -->
                                                @endif

                                                <!-- footer -->
                                                <div class="location-item__controls">

                                                    <!-- col -->
                                                    <a href="https://maps.google.com/maps?daddr={{ $office->lat }},{{ $office->lng }}" class="location-item__control location-item__route" target="_blank">
                                                        <span class="icon"></span>
                                                        <span>{{ __( 'Маршрут' ) }}</span>
                                                    </a>
                                                    <!-- end col -->

                                                    @if( $office->phone )
                                                        <!-- col -->
                                                        <a href="tel:{{ $office->phone }}" class="location-item__control location-item__phone">
                                                            <span class="icon"></span>
                                                            <span>{{ __( 'Позвонить' ) }}</span>
                                                        </a>
                                                        <!-- end col -->
                                                    @endif

                                                </div>
                                                <!-- end footer -->

                                            </div>
                                            @endif

                                        @endforeach

                                    </div>
                                    <!-- end wrapper -->

                                    <!-- pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- end pagination -->

                                </div>
                                <!-- end swiper -->
                            </div>
                        @endif
                    </div>

                </div>
                <!-- end list -->

                <div class="col-8 locations__map">
                    <div id="map"></div>
                </div>

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

        {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0xRjiJ8jopxJW_W-DT4VeA42_Ic5kgSY&callback=initMap" async defer></script>--}}
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBElcUyQmxT9mTH612iPKp9JN9v43nM5R0&callback=initMap" async defer></script>

        <script>
            function goToPage(obj) {
                window.location.href = obj.options[obj.selectedIndex].getAttribute('data-href');
            }

            let map;
            let markers = [];
            let marker, i;
            let bounds;

            let citySelector = document.getElementById('city-selector');
            let selectedCityIndex = citySelector.value;

            let citiesContainers = document.querySelectorAll('.locations__list__city');
            let citiesOffices = document.querySelectorAll('.location-item');
            const LocationItemLinks = document.querySelectorAll('.location-item__address');


            const officesList = [];
            @foreach( $offices as $office )
                @if ( $office->lat && $office->lng )
                    officesList.push([{{ $office->lat }}, {{ $office->lng }}]);
                @endif
            @endforeach

            const locations = {
            @php( $i=0 )
            @foreach( $countries as $country )
                {{ $country->id }}: {
                    @if( $country->offices->count() )
                        @foreach( $country->offices as $office )
                            {{ $i }}: [{{ $office->lat }}, {{ $office->lng }}],
                            @php( $i++ )
                        @endforeach
                    @endif
                },
            @endforeach
            };


            if ( ! selectedCityIndex ) {
                // disable select city options without offices
                Object.values(locations).map( (value, index) => {
                    Object.keys(value).length === 0 && citySelector[index].setAttribute('hidden', true);
                });

                [...LocationItemLinks].map( link => {
                    // ! link.parentElement.classList.contains('selected') && link.addEventListener('click', function() {
                    link.addEventListener('click', function() {
                        removeOfficeActivity();
                        link.parentElement.classList.add('selected');

                        const selectedCityIndex = link.closest('.locations__list__city').getAttribute('data-city');
                        // console.log(selectedCityIndex);

                        const currentCitySelectedOfficeIndex = link.closest('.location-item').getAttribute('data-city-office');
                        // console.log(currentCitySelectedOfficeIndex);

                        let officeMarkerPosition = {
                            lat: locations[selectedCityIndex][currentCitySelectedOfficeIndex][0],
                            lng: locations[selectedCityIndex][currentCitySelectedOfficeIndex][1]
                        }
                        marker = new google.maps.Marker({
                            position: officeMarkerPosition,
                            map: map,
                            // icon: icon
                        });
                        map.setZoom(16);
                        map.setCenter( marker.getPosition() );
                    });
                });

                // citySelector.addEventListener('change', function() {
                //     selectedCityIndex = this.value;
                //     // console.log(selectedCityIndex);
                //     selectCity();
                //     updateMap(selectedCityIndex);
                // });

                const selectCity = () => {
                    [...citiesContainers].map( (city, index) => {
                        // console.log(city[selectedCity]);

                        index == selectedCityIndex ? city.classList.add('is-selected') : city.classList.remove('is-selected');
                        // city.classList.remove('is-selected');
                        // city[selectedCity].classList.add('is-selected');
                        // city.findIndex(selectedCity).classList().add('is-selected');
                    });

                    // если нужен первый по умолчанию
                    selectDefaultCityOffice(selectedCityIndex);
                }

                // const removeOfficeActivity = () => {
                //     [...citiesOffices].map(office => {
                //         office.classList.remove('selected');
                //     });
                // }

                const selectDefaultCityOffice = cityIndex => {
                    // removeOfficeActivity();
                    let selectedCity = document.querySelector(`.locations__list__city[data-city="${cityIndex}"]`);

                    // add to first if one office in city
                    selectedCity.querySelectorAll('.location-item').length == 1 && selectedCity.querySelector('.location-item').classList.add('selected');
                }

                const cityOfficesMap = () => {
                    selectCity();
                    //
                }

                cityOfficesMap();

                let cityDefaultOffice = {
                    lat: locations[selectedCityIndex][0][0],
                    lng: locations[selectedCityIndex][0][1]
                };

                const cityOfficesMarkers = selectedCityIndex => {
                    // console.log(Object.keys(locations[selectedCityIndex]).length);

                    // console.log(locations[selectedCityIndex]);

                    for ( i = 0; i < Object.keys(locations[selectedCityIndex]).length; i++ ) {
                        markers = [];
                        let cityMarkerLatLng = {
                            lat: locations[selectedCityIndex][i][0],
                            lng: locations[selectedCityIndex][i][1]
                        };

                        marker = new google.maps.Marker({
                            position: cityMarkerLatLng,
                            map: map,
                            zoom: 12,
                            // icon: icon
                        });

                        markers.push(marker);
                        bounds.extend(marker.position);

                        // console.log(markers);

                    }
                    // map.fitBounds(bounds);
                    Object.keys(locations[selectedCityIndex]).length > 1 && map.fitBounds(bounds);
                };

                function initMap() {
                    bounds = new google.maps.LatLngBounds();

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: cityDefaultOffice,
                        zoom: 12,
                        // zoom: 16,
                    });

                    cityOfficesMarkers(selectedCityIndex);
                    // console.log(locations[selectedCityIndex]);

                }

                const updateMap = (selectedCityIndex) => {

                    cityDefaultOffice = {
                        lat: locations[selectedCityIndex][0][0],
                        lng: locations[selectedCityIndex][0][1]
                    };
                    cityOfficesMarkers(selectedCityIndex);
                    // markers = [];

                }
            }

            else {
                // console.log( officesList );

                function initMap() {
                    map = new google.maps.Map(document.getElementById("map"), {
                        // zoom: 8
                    });
                    bounds = new google.maps.LatLngBounds();

                    LocationItemLinks.forEach( office => {
                        let officeIndex = office.closest('.location-item').getAttribute('data-city-office');
                        // console.log('office index ' + officeIndex);
                        let officeMarkerPosition = new google.maps.LatLng(officesList[officeIndex][0], officesList[officeIndex][1]);

                        // console.log('office position' + officeMarkerPosition);

                        marker = new google.maps.Marker({
                            position: officeMarkerPosition,
                            map: map,
                        });

                        marker.addListener('click', function() {
                            removeOfficeActivity();
                            office.closest('.location-item').classList.add('selected');

                            document.querySelector('.locations__list__cities').scrollTop = office.closest('.location-item').offsetTop;

                            map.setZoom(16);
                            map.setCenter(markers[officeIndex].getPosition());

                        })

                        markers.push(marker);
                        bounds.extend(marker.position);


                        office.addEventListener('click', function() {
                            removeOfficeActivity();
                            office.parentElement.classList.add('selected');

                            map.setZoom(16);
                            map.setCenter(markers[officeIndex].getPosition());

                        });

                        map.fitBounds(bounds);
                    });

                }

            }

            const removeOfficeActivity = () => {
                [...citiesOffices].map(office => {
                    office.classList.remove('selected');
                });
            }
        </script>


    </section>
    <!-- End Locations -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection