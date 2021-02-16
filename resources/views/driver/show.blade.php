@extends('layouts.app')
@section('content')
    <div class="page-body">
        @foreach ($drivers as $driver)
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Driver Details</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Users</li>
                                <li class="breadcrumb-item active">{{ $driver->user->first_name }} &nbsp;{{ $driver->user->surname }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-4 box-col-6">
                        <div class="card custom-card">
                            <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt="">
                            </div>
                            <div class="card-profile"><img class="rounded-circle"
                                    src="{{ URL::to('/') }}/DriverPhotos/{{ $driver->driverPhotos->pluck('profile_pic_path')->first() }}"
                                    alt="{{ $driver->user->first_name }}">
                            </div>

                            <div class="text-center profile-details">
                                <h4>{{ $driver->user->first_name }} &nbsp;{{ $driver->user->surname }}</h4>
                                <h6>{{ $driver->vehicles[0]->car_number_plate }}</h6>
                            </div>
                            <div class="card-footer row">
                                <div class="col-8 col-sm-8">
                                    <h6>Email</h6>
                                    <p class="counter">{{ $driver->user->email }}</p>
                                </div>
                                <div class="col-4 col-sm-4">
                                    <h6>Phone</h6>
                                    <p><span class="bold">{{ $driver->user->phone }}</span></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Container-fluid Ends-->
    </div>
    @endforeach
@endsection
