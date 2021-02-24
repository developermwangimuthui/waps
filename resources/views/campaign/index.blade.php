@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Campaign Information</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Campaign</li>
                            <li class="breadcrumb-item active">All Campaign </li>
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
                                                {{-- <div class="status-online"></div> --}}
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>{{ $allCampaignCount }}</h4><span>All Campaigns </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <h4>{{ $activeCampaignsCount }}</h4>
                                                <span>Active Campaigns</span>
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
                                            <h4>{{ $finishedCampaignsCount }}</h4>
                                            <span>Finished Campaigns</span>
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
                                                {{-- <h4>{{ $newDriverRequestsCount }}</h4> --}}
                                                <span>New Driver Request</span>
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
                            <h5>Campaigns</h5>
                        </div>

                    @include('layouts.alert')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display dataTable" id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Campaign Name</th>
                                            <th>Goal</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campaigns as $campaign)
                                            <tr>

                                                <td>{{ $campaign->name }}
                                                </td>
                                                <td>{{ $campaign->goal }} </td>
                                                @php
                                                    $customer_id = $campaign->customer->id;



                                                    $user_id = \App\Models\Customer::where('id', $customer_id)->pluck('user_id')->first();
                                                    $users = \App\Models\User::where('id', $user_id)->get();

                                                @endphp
                                                @foreach ($users as $user)

                                                    <td>{{ $user->first_name }} &nbsp; {{ $user->surname }} </td>
                                                @endforeach
                                                <td>{{ $campaign->status }}</td>
                                                <td><a href="{{ route('campaign.show', $campaign->id) }}"><i
                                                            data-feather="eye">View</i></a> &nbsp; &nbsp;<a href="{{ route('campaign.edit', $campaign->id) }}"><i data-feather="edit"></i></i></a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Campaign Name</th>
                                            <th>Goal</th>
                                            <th>Customer</th>
                                            <th>Status</th>
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
