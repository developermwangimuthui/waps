@extends('layouts.app')
@section('content')
    @foreach ($driverusers as $user)

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            {{-- <h3>
                                Distance Covered :{{$driverDistanceCoveredInCampaign}}</h3><br>
                            <h3>
                                {{ $user->first_name }} &nbsp; &nbsp;{{ $user->surname }}</h3> --}}
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">

                                    <a href="{{ route('home') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item">Driver Campaign Movements</li>
                                <li class="breadcrumb-item active">{{ $user->first_name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body right-chart-content">

                                        <h4>Driver: {{ $user->first_name }}&nbsp;&nbsp;{{ $user->surname }}</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">

                                    <h4>Distance Covered :{{ $driverDistanceCoveredInCampaign }}</h4>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>{{ $campaign_name }} Heat map</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="DCheatMap"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $driver_id }}" id="driver_id">
                    <input type="hidden" value="{{ $campaign_id }}" id="campaign_id">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>{{ $campaign_name }} Route map</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="DCRouteMap"></div>
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
            var campaign_id;
            driver_id = $("#driver_id").val();
            campaign_id = $("#campaign_id").val();
            console.log("Hello ");

            function initMap() {
                heatMap();

            }



            function heatMap() {

                $.ajax({
                    url: "/drivercampaignMapMarker/" + driver_id + "/" + campaign_id,
                    success: function(data) {
                        if (data != null) {

                            var heatmapData = [];
                            for (var i = 0; i < data.length; i++) {
                                heatmapData.push(new google.maps.LatLng(data[i].lat, data[i].lng));

                            }
                            var map = new google.maps.Map(
                                document.getElementById('DCheatMap'), {

                                    center: new google.maps.LatLng(data[0].lat, data[0].lng),
                                    zoom: 12,
                                    mapTypeId: 'hybrid'
                                });
                            var heatmap = new google.maps.visualization.HeatmapLayer({
                                data: heatmapData
                            });
                            heatmap.setMap(map);

                        } else {
                            $('#DCheatMap').append("<p>No data found </p>")

                        }

                    }
                });


            }

        </script>

    @endforeach
@endsection
