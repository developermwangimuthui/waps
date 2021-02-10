@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Default</h3>
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
                                        <div class="hospital-small-chart">
                                            <div class="small-bar">
                                                <div class="small-chart flot-chart-container"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>1001</h4><span>purchase </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media align-items-center">
                                        <div class="hospital-small-chart">
                                            <div class="small-bar">
                                                <div class="small-chart1 flot-chart-container"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>1005</h4><span>Sales</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media align-items-center">
                                        <div class="hospital-small-chart">
                                            <div class="small-bar">
                                                <div class="small-chart2 flot-chart-container"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>100</h4><span>Sales return</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                                    <div class="media border-none align-items-center">
                                        <div class="hospital-small-chart">
                                            <div class="small-bar">
                                                <div class="small-chart3 flot-chart-container"></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="right-chart-content">
                                                <h4>101</h4><span>Purchase ret</span>
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
                                        <h5 class="m-0">appointment</h5>
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
                                    <div class="appointment-table table-responsive">
                                        <table class="table table-bordernone">
                                            <tbody>
                                                <tr>
                                                    <td><img class="img-fluid img-40 rounded-circle mb-3"
                                                            src="/assets/images/appointment/app-ent.jpg"
                                                            alt="Image description">
                                                        <div class="status-circle bg-primary"></div>
                                                    </td>
                                                    <td class="img-content-box"><span class="d-block">Venter
                                                            Loren</span><span class="font-roboto">Now</span></td>
                                                    <td>
                                                        <p class="m-0 font-primary">28 Sept</p>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="button btn btn-primary">Done<i
                                                                class="fa fa-check-circle ms-2"></i></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="img-fluid img-40 rounded-circle"
                                                            src="/assets/images/appointment/app-ent.jpg"
                                                            alt="Image description">
                                                        <div class="status-circle bg-primary"></div>
                                                    </td>
                                                    <td class="img-content-box"><span class="d-block">John Loren</span><span
                                                            class="font-roboto">11:00</span></td>
                                                    <td>
                                                        <p class="m-0 font-primary">22 Sept</p>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="button btn btn-danger">Pending<i
                                                                class="fa fa-check-circle ms-2"></i></div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
{{-- table here --}}
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
