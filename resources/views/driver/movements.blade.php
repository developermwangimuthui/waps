@extends('layouts.app')
@section('content')
    @foreach ($drivers as $driver)

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>
                                {{ $driver->user->name }}</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Driver Movements</li>
                                <li class="breadcrumb-item active">{{ $driver->user->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Driver Heat Map</h5>
                            </div>
                            <div class="card-body">
                                <div class="map-js-height" id="map12"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $driver->id }}" id="driver_id">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Driver Route Map</h5>
                            </div>
                            <div class="card-body">
                                <div class="map-js-height" id="map7"></div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        {{-- <script>

    var coordinates;
    var map;
    var driver_id;
    driver_id = $("#driver_id").val();
    console.log();
    function initialize() {
     initMap();
        initMap2();
        }
    function initMap() {

        $.ajax({
            url: "/driver/getmovements/" + driver_id,
            success: function(data) {

                console.log(data);
                console.log(data.length);
                map = new google.maps.Map(
                    document.getElementById('map'), {

                        center: new google.maps.LatLng(data[0].lat, data[0].lng),
                        zoom: 12
                    });


                // // Create markers.
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i].lat,data[i].lng);
                    var marker = new google.maps.Marker({
                        position: {lat:data[i].lat,lng:data[i].lng},
                        map: map
                    });
                }
            }
        });


    }
    function initMap2() {

        $.ajax({
            url: "/driver/getmovements/" + driver_id,
            success: function(data) {

                console.log(data);
                console.log(data.length);
                map = new google.maps.Map(
                    document.getElementById('map2'), {

                        center: new google.maps.LatLng(data[0].lat, data[0].lng),
                        zoom: 12
                    });


                // // Create markers.
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i].lat,data[i].lng);
                    var marker = new google.maps.Marker({
                        position: {lat:data[i].lat,lng:data[i].lng},
                        map: map
                    });
                }
            }
        });


    }

</script> --}}
        <script>
            // Common settings
            var platform = new H.service.Platform({
                app_id: 'devportal-demo-20180625',
                app_code: '9v2BkviRwi9Ot26kp2IysQ',
                useHTTPS: true
            });
            var pixelRatio = window.devicePixelRatio || 1;
            var defaultLayers = platform.createDefaultLayers({
                tileSize: pixelRatio === 1 ? 256 : 512,
                ppi: pixelRatio === 1 ? undefined : 320
            });

            var driver_id;
            driver_id = $("#driver_id").val();

            console.log(driver_id);
            // map7
            function useImperialMeasurements(map, defaultLayers) {
                var ui = H.ui.UI.createDefault(map, defaultLayers);
                ui.setUnitSystem(H.ui.UnitSystem.IMPERIAL);
            }
            var map = new H.Map(document.getElementById('map7'),
                defaultLayers.normal.map, {
                    center: {
                        lat: 1.2921,
                        lng:36.8219
                    },
                    zoom: 14,
                    pixelRatio: pixelRatio
                });
            var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            useImperialMeasurements(map, defaultLayers);



            // map12 Map Marker

            var map = new H.Map(document.getElementById('map12'),
                defaultLayers.normal.map, {
                    center: {
                        lat: 1.2921,
                        lng:36.8219
                    },
                    zoom: 4,
                    pixelRatio: pixelRatio
                });
            var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            var ui = H.ui.UI.createDefault(map, defaultLayers);
            addMarkersToMap(map);

            function addMarkersToMap(map) {


                $.ajax({
                    url: "/driver/getmovements/" + driver_id,
                    success: function(data) {

                        console.log("Markers" + data);
                        console.log(data.length);
                        // // Create markers.
                        for (var i = 0; i < data.length; i++) {


                            var marker = new H.map.Marker({
                                lat: data[i].lat,
                                    lng: data[i].lng
                            });
                            map.addObject(marker);


                            // console.log(data[i].lat, data[i].lng);
                            // var marker = new google.maps.Marker({
                            //     position: {
                            //         lat: data[i].lat,
                            //         lng: data[i].lng
                            //     },
                            //     map: map
                            // });
                        }
                    }
                });



            }

        </script>

    @endforeach
@endsection
