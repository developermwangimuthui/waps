@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Customer Information</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Customer</li>
                            <li class="breadcrumb-item active">All Customers </li>
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
                                                <h4>{{ $allCustomerCount }}</h4><span>All Customers </span>
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
                                                {{-- <h4>{{ $offlineDriverscount }}</h4><span>Offline</span> --}}
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
                                            </div>
                                            {{-- <h4>{{ $allDriversCount }}</h4><span>Total Drivers</span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media border-none align-items-center">
                                        <div class="avatars">
                                            <div class="avatar"><img class="img-100 rounded-circle"
                                                    src="../assets/images/user/1.jpg" alt="#">
                                                <div class="status-offline"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                {{-- <h4>{{ $newDriverRequestsCount }}</h4><span>New Driver Request</span> --}}
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
                <div class="col-xl-4 xl-50 news box-col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-top">
                                <h5 class="m-0">News & Update</h5>
                                <div class="card-header-right-icon">
                                    <select class="button btn btn-primary">
                                        <option>Today</option>
                                        <option>Tomorrow</option>
                                        <option>Yesterday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="news-update">
                                <h6>36% off For pixel lights Couslations Types.</h6><span>Lorem Ipsum is simply
                                    dummy...</span>
                            </div>
                            <div class="news-update">
                                <h6>We are produce new product this</h6><span> Lorem Ipsum is simply text of the printing...
                                </span>
                            </div>
                            <div class="news-update">
                                <h6>50% off For COVID Couslations Types.</h6><span>Lorem Ipsum is simply dummy...</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="bottom-btn"><a href="#">More...</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 xl-50 appointment-sec box-col-6">
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
                                <div class="card-body pt-0">
                                    <div class="appointment-table table-responsive">
                                        <table class="table table-bordernone">
                                            {{-- <tbody>
                                                @foreach ($newDriverRequests as $customer)
                                                    <tr>
                                                        <td>
                                                            <div class="avatars">
                                                                <div class="avatar">
                                                                    @php
                                                                        $customer_id = $customer->drivers[0]->id;
                                                                        $image = \App\Models\DriverPhoto::where('driver_id', $customer_id)
                                                                            ->pluck('profile_pic_path')
                                                                            ->first();
                                                                    @endphp

                                                                    <img class="img-50 rounded-circle table-img"
                                                                        src="{{ URL::to('/') }}/DriverPhotos/{{ $image }}"
                                                                        alt="{{ $customer->first_name }}">
                                                                    <div
                                                                        class="{{ $customer->isOnline() ? 'status-online ' : 'status-offline' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="img-content-box"><span
                                                                class="d-block">{{ $customer->first_name }}
                                                                &nbsp;{{ $customer->surname }}
                                                        </td>
                                                        <td>
                                                            <p class="m-0 font-primary">
                                                                {{ $customer->created_at->format('d M, yy') }}</p>
                                                        </td>
                                                        <td class="text-end"><a
                                                                href="{{ route('driver.show', $customer->drivers[0]->id) }}"><i
                                                                    data-feather="eye">View</i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody> --}}
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 alert-sec">
                            <div class="card bg-img">
                                <div class="card-header">
                                    <div class="header-top">
                                        <h5 class="m-0">Alert </h5>
                                        <div class="dot-right-icon"><i class="fa fa-ellipsis-h"></i></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="body-bottom">
                                        <h6> 10% off For drama lights Couslations...</h6><span class="font-roboto">Lorem
                                            Ipsum is simply dummy...It is a long established fact that a reader will be
                                            distracted by </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 xl-50 notification box-col-6">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0">notification</h5>
                                <div class="card-header-right-icon">
                                    <select class="button btn btn-primary">
                                        <option>Today</option>
                                        <option>Tomorrow</option>
                                        <option>Yesterday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="media">
                                <div class="media-body">
                                    <p>20-04-2020 <span>10:10</span></p>
                                    <h6>Updated Product<span class="dot-notification"></span></h6><span>Quisque a consequat
                                        ante sit amet magna...</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <p>20-04-2020<span class="ps-1">Today</span><span
                                            class="badge badge-secondary">New</span></p>
                                    <h6>Tello just like your product<span class="dot-notification"></span></h6><span>Quisque
                                        a consequat ante sit amet magna... </span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div class="d-flex mb-3">
                                        <div class="inner-img"><img class="img-fluid"
                                                src="/assets/images/notification/1.jpg" alt="Product-1"></div>
                                        <div class="inner-img"><img class="img-fluid"
                                                src="/assets/images/notification/2.jpg" alt="Product-2"></div>
                                    </div><span class="mt-3">Quisque a consequat ante sit amet magna...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Customers</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display dataTable" id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contacts</th>
                                            <th>Campaign</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>

                                                <td>{{ $customer->user->first_name }} &nbsp;{{ $customer->user->surname }}
                                                </td>
                                                <td>Email: &nbsp;{{ $customer->user->email }} <br> Phone:
                                                    &nbsp;{{ $customer->user->phone }}</td>
                                                {{-- <td>{{ $customer->campaigns->name }}</td> --}}
                                                <td><a href="{{ route('customer.show', $customer->id) }}"><i
                                                            data-feather="eye">View</i></a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contacts</th>
                                            <th>Campaign</th>
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
