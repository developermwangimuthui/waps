@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Driver Information</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Drivers</li>
                            <li class="breadcrumb-item active">All Drivers </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row second-chart-list third-news-update">
                <div class="col-xl-12 xl-100 chart_data_left box-col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row m-0 chart-main">
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media align-items-center">
                                        <div class="avatars">
                                            <div class="avatar"><img class="img-100 rounded-circle"
                                                    src="../assets/images/user/1.jpg" alt="#">
                                                <div class="status-online"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>{{ $onlineDriverscount }}</h4><span>Online </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media align-items-center">
                                        <div class="avatars">
                                            <div class="avatar"><img class="img-100 rounded-circle"
                                                    src="../assets/images/user/1.jpg" alt="#">
                                                <div class="status-offline"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>{{ $offlineDriverscount }}</h4><span>Offline</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media align-items-center">
                                        <div class="avatars">
                                            <div class="avatar"><img class="img-100 rounded-circle"
                                                    src="../assets/images/user/1.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                            </div>
                                            <h4>{{ $allDriversCount }}</h4><span>Total Drivers</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media border-none align-items-center">
                                        <div class="avatars">
                                            <div class="avatar"><img class="img-100 rounded-circle"
                                                    src="../assets/images/user/1.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>{{ $newDriverRequestsCount }}</h4><span>New Driver Request</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 xl-50 chart_data_right second d-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <div class="media-body right-chart-content">
                                    <h4>$95,000<span class="new-box">New</span></h4><span>Product Order Value</span>
                                </div>
                                <div class="knob-block text-center">
                                    <input class="knob1" data-width="50" data-height="70" data-thickness=".3"
                                        data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 xl-50 appointment-sec box-col-6">
                    <div class="row">
                        <div class="col-xl-12 appointment">
                            <div class="card">
                                <div class="card-header card-no-border">
                                    <div class="header-top">
                                        <h5 class="m-0">New Drivers Request</h5>
                                        <div class="card-header-right-icon">

                                        </div>
                                    </div>
                                </div>

                    @include('layouts.alert')
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="display dataTable" id="basic-3">
                                            <thead>
                                                <tr>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Request Date</th>
                                                    <th>View Credentials</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($newDriverRequests as $driver)
                                                    <tr>
                                                        <td>
                                                            <div class="avatars">
                                                                <div class="avatar">
                                                                    @php
                                                                        $driver_id = $driver->drivers[0]->id;
                                                                        $image = \App\Models\DriverPhoto::where('driver_id', $driver_id)
                                                                            ->pluck('profile_pic_path')
                                                                            ->first();
                                                                    @endphp

                                                                    <img class="img-50 rounded-circle table-img"
                                                                        src="{{ URL::to('/') }}/DriverPhotos/{{ $image }}"
                                                                        alt="{{ $driver->first_name }}">
                                                                    <div
                                                                        class="{{ $driver->isOnline() ? 'status-online ' : 'status-offline' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="img-content-box"><span
                                                                class="d-block">{{ $driver->first_name }}
                                                                &nbsp;{{ $driver->surname }}
                                                        </td>
                                                        <td>
                                                            <p class="m-0 font-primary">
                                                                {{ $driver->created_at->format('d M, yy') }}</p>
                                                        </td>
                                                        <td class="text-end"><a
                                                                href="{{ route('driver.show', $driver->drivers[0]->id) }}"><i
                                                                    data-feather="eye"></i>Credentials</a>
                                                        <td class="text-end"><a
                                                                href="{{ route('driver.movements', $driver->drivers[0]->id) }}"><i
                                                                    data-feather="eye"></i>Movements</a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Drivers</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display dataTable" id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Contacts</th>
                                            <th>Vehicle</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($drivers as $driver)
                                            <tr>
                                                <td>
                                                    <div class="avatars">
                                                        <div class="avatar"><img class="img-50 rounded-circle table-img"
                                                                src="{{ URL::to('/') }}/DriverPhotos/{{ $driver->driverPhotos->pluck('profile_pic_path')->first() }}"
                                                                alt="{{ $driver->user->first_name }}">
                                                            <div
                                                                class="{{ $driver->user->isOnline() ? 'status-online ' : 'status-offline' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $driver->user->first_name }} &nbsp;{{ $driver->user->surname }}
                                                </td>
                                                <td>Email: &nbsp;{{ $driver->user->email }} <br> Phone:
                                                    &nbsp;{{ $driver->user->phone }}</td>
                                                <td>@if (empty($driver->vehicles[0]))
                                                    <p>Not Updated</p>
                                                    @else
                                                    {{ $driver->vehicles[0]->car_number_plate }}
                                                @endif</td>
                                                <td class="text-end"><a
                                                    href="{{ route('driver.show', $driver->id) }}"><i
                                                        data-feather="eye"></i>Credentials</a>
                                            <td class="text-end"><a
                                                    href="{{ route('driver.movements', $driver->id) }}"><i
                                                        data-feather="eye"></i>Movements</a>
                                            </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Contacts</th>
                                            <th>Vehicle</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
