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

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Customers</h5>
                        </div>

                    @include('layouts.alert')
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
                                                <td>@if (empty($customer->campaigns[0]))
                                                    <p>No Campaign</p>
                                                    @else
                                                    {{ $customer->campaigns[0]->name }}
                                                @endif</td>
                                                <td><a href="{{ route('customer.edit', $customer->id) }}"><i data-feather="edit"></i></i></a></td>
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
