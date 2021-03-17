@extends('layouts.app')
@section('content')
    @foreach ($campaigns as $campaign)
        @php
            // Customers infromation
            $customer_id = $campaign->customer->id;
            $campaign_id = $campaign->id;
            $customer_user_id = \App\Models\Customer::where('id', $customer_id)
                ->pluck('user_id')
                ->first();
            $customers = \App\Models\User::where('id', $customer_user_id)->get();
            // $driver_image = \App\Models\DriverPhoto::where('driver_id', $driver_id)
            //     ->pluck('profile_pic_path')
            //     ->first();
            // Driver Information
            $campaign_drivers_id;
            $driver_user_id = [];
            foreach ($campaign_drivers_id as $campaign_driver_id) {
                $driver_user_id[] = \App\Models\Driver::where('id', $campaign_driver_id)
                    ->pluck('user_id')
                    ->first();
            }
            $drivers = [];
            foreach ($driver_user_id as $driver_user_id) {
                $drivers[] = \App\Models\User::where('id', $driver_user_id)->get();
            }

            // dd($drivers);
            // $driver_image = \App\Models\DriverPhoto::where('driver_id', $driver_id)
            //     ->pluck('profile_pic_path')
            //     ->first();
            $percentageDistanceCovered = ($distanceCovered / (int) $campaign->goal) * 100;

        @endphp

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>
                                {{ $campaign->name }}</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">

                                    <a href="{{ route('home') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item">Campaign</li>
                                <li class="breadcrumb-item active">{{ $campaign->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row size-column">
                    <div class="col-xl-12 box-col-12 xl-100">
                        <div class="row dash-chart">
                            <div class="col-xl-6 box-col-6 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-header card-no-border">
                                        <div class="card-header-right">

                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <p><span class="f-w-500 font-roboto">Campaign Distance Target</span><span
                                                        class="f-w-700 font-primary ms-2">100%</span></p>
                                                <h4 class="f-w-500 mb-0 f-26"><span
                                                        class="counter">{{ $campaign->goal }}</span>KM</h4>
                                            </div>
                                            <input type="hidden" id="campaign_id" value="{{ $campaign->id }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 box-col-6 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-header card-no-border">
                                        <div class="card-header-right">

                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <p><span class="f-w-500 font-roboto">Campaign Distance Achieved </span><span
                                                        class="f-w-700 font-primary ms-2">{{ $percentageDistanceCovered }}%</span>
                                                </p>
                                                <h4> <span
                                                        class="f-w-500 mb-0 f-26 counter">{{ $distanceCovered }}</span>KM
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="col-xl-6 col-md-12 box-col-12">
                                <div class="card">
                                  <div class="card-header">
                                    <h5> Daily Distance Line Graph</h5>
                                  </div>
                                  <div class="card-body chart-block">
                                    <canvas id="dailyCampaingDistanceChart"></canvas>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-6 col-md-12 box-col-12">
                                <div class="card">
                                  <div class="card-header">
                                    <h5>Monthly Distance Line Graph</h5>
                                  </div>
                                  <div class="card-body chart-block">
                                    <canvas id="monthlyCampaingDistanceChart"></canvas>
                                  </div>
                                </div>
                              </div>
                            <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-body">
                                        @foreach ($customers as $customer)


                                            <div class="ecommerce-widgets media">
                                                <div class="media-body">
                                                    <p class="f-w-500 font-roboto">Customer</p>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="avatars">
                                                                <div class="avatar">
                                                                    <img class="img-50 rounded-circle table-img"
                                                                        src="/assets/images/user/1.jpg"
                                                                        alt="{{ $customer->first_name }}">
                                                                    <div
                                                                        class="{{ $customer->isOnline() ? 'status-online ' : 'status-offline' }}">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="progress-box">
                                                                <h6 class="f-w-500 mb-0 f-18">
                                                                    <span>{{ $customer->first_name }}
                                                                        &nbsp;{{ $customer->surname }}</span></h4>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="progress-box">
                                                                <p>
                                                                    <span>Phone Number:{{ $customer->phone }}
                                                                        &nbsp; Email :{{ $customer->phone }}</span>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="f-w-500 font-roboto">Drivers</p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="display dataTable" id="basic-3">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Phone</th>
                                                                <th>Email</th>
                                                                <th>View</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($drivers as $driver)
                                                                    <tr>
                                                                        <td>{{ $driver[0]->first_name }}
                                                                            &nbsp;{{ $driver[0]->surname }}</td>
                                                                        <td>{{ $driver[0]->phone }}</td>
                                                                        <td>{{ $driver[0]->email }}</td>
                                                                        <td><a
                                                                                href="{{ route('driver.campaignmovements', ['driver_id' => $driver[0]->id, 'campaign_id' => $campaign->id]) }}"><i
                                                                                    data-feather="eye"></i></a></td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>

                                                                <th>Name</th>
                                                                <th>Phone</th>
                                                                <th>Email</th>
                                                            </tfoot>
                                                        </table>

                                                    </div>

                                                </div>


                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaing Heat map</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="CheatMap"></div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaing Line map </h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="CrouteMap"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaign Updates</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body new-update pt-0">
                                <div class="activity-timeline">
                                    <div class="media">
                                        <div class="activity-line"></div>
                                        <div class="activity-dot-secondary"></div>
                                        <div class="media-body"><span>Update Product</span>
                                            <p class="font-roboto">Quisque a consequat ante Sit amet magna at volutapt.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-primary"></div>
                                        <div class="media-body"><span>James liked Nike Shoes</span>
                                            <p class="font-roboto">Aenean sit amet magna vel magna fringilla ferme.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-secondary"></div>
                                        <div class="media-body"><span>john just buy your product<i
                                                    class="fa fa-circle circle-dot-secondary pull-right"></i></span>
                                            <p class="font-roboto">Vestibulum nec mi suscipit, dapibus purus.....</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-primary"></div>
                                        <div class="media-body"><span>Jihan Doe just save your product<i
                                                    class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                            <p class="font-roboto">Curabitur egestas consequat lorem.</p>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    @endforeach
    <script>
        // $(document).ready(function() {

        //     console.log(campaign_id);


        // });

        var coordinates;


        var map;
        var campaign_id;
        campaign_id = $("#campaign_id").val();
        console.log("Hello ");

        function initMap() {
            heatMap();
            routeMap();

        }



        function heatMap() {

            $.ajax({
                url: "/campaignMapMarker/" + campaign_id,
                success: function(data) {
                    if (data != null) {
                        var heatmapData = [];
                        for (var i = 0; i < data.length; i++) {
                            heatmapData.push(new google.maps.LatLng(data[i].lat, data[i].lng));

                        }
                        var map = new google.maps.Map(
                            document.getElementById('CheatMap'), {

                                center: new google.maps.LatLng(data[0].lat, data[0].lng),
                                zoom: 12,
                                mapTypeId: 'roadmap'
                            });
                        var heatmap = new google.maps.visualization.HeatmapLayer({
                            data: heatmapData
                        });
                        heatmap.setMap(map);

                        // console.log("Heatmap" + heatmapData);
                    } else {
                        $('#CheatMap').append("<p>No data found </p>")

                    }

                }
            });



        }


        function routeMap() {

            $.ajax({
                url: "/campaignMapMarker/" + campaign_id,
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

                        console.log("locations" + locations.length);

                        for (i = 0; i < locations.length; i++) {
                            if (i == 0) {
                                // Initialise the map
                                var map_options = {
                                    center: new google.maps.LatLng(locations[0][0], locations[0][1]),
                                    //position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                                    zoom: 10,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };

                                map = new google.maps.Map(document.getElementById('CrouteMap'), map_options);
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

@endsection
