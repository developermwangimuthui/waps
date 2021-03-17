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
                                <li class="breadcrumb-item">

                                    <a href="{{ route('home') }}"><i data-feather="home"></i></a>
                                </li>
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
                            <div class="card-header card-no-border">
                                <h5>Driver Heat map</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="DheatMap"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $driver->id }}" id="driver_id">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Driver Route map</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="DMrouteMap"></div>
                                </div>

                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>

        <script>
            var coordinates;
            var driver_id;
            driver_id = $("#driver_id").val();
            console.log("Hello ");



            function initMap() {
                heatMap();
                routeMap();

            }



            function heatMap() {

                $.ajax({
                    url: "/driver/getmovements/" + driver_id,
                    success: function(data) {
                        if (data != null) {
                            var heatmapData = [];
                            for (var i = 0; i < data.length; i++) {
                                heatmapData.push(new google.maps.LatLng(data[i].lat, data[i].lng));

                            }
                            for (var i = 0; i < data.length; i++) {
                                var heatmapData = [
                                    new google.maps.LatLng(data[i].lat, data[i].lng)
                                ];

                            }
                            var map = new google.maps.Map(
                                document.getElementById('DheatMap'), {

                                    center: new google.maps.LatLng(data[0].lat, data[0].lng),
                                    zoom: 12,
                                    mapTypeId: 'roadmap'
                                });
                            var heatmap = new google.maps.visualization.HeatmapLayer({
                                data: heatmapData
                            });
                            heatmap.setMap(map);
                            console.log(heatmapData);

                        } else {
                            $('#DheatMap').append("<p>No data found </p>")

                        }

                    }
                });


            }


            function routeMap() {

                $.ajax({
                    url: "/driver/getmovements/" + driver_id,
                    success: function(data) {
                        if (data != null) {

                            var map;
                            var poly;
                            var path;
                            var locations = [];

                            // Put all locations into array
                            for (var i = 0; i < data.length; i++) {
                                locations.push([data[i].lat, data[i].lng]);

                            }


                            for (i = 0; i < locations.length; i++) {
                                if (i == 0) {
                                    // Initialise the map
                                    var map_options = {
                                        center: new google.maps.LatLng(locations[0][0], locations[0][1]),
                                        //position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                                        zoom: 10,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };

                                    map = new google.maps.Map(document.getElementById('DMrouteMap'),
                                    map_options);
                                    poly = new google.maps.Polyline({
                                        strokeColor: '#FFCCFF',
                                        strokeOpacity: 2.0,
                                        strokeWeight: 10,
                                        map: map
                                    });
                                    path = poly.getPath();
                                }

                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                                    //center:location,
                                    map: map,
                                    // icon: 'jeep.png'
                                    //animation:google.maps.Animation.BOUNCE
                                });

                                path.push(new google.maps.LatLng(locations[i][0], locations[i][1]));
                            }






                        } else {
                            $('#CheatMap').append("<p>No data found </p>")

                        }
                    }
                });

            }

        </script>

    @endforeach
@endsection
