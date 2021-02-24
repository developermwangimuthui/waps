@extends('layouts.app')
@section('content')

    @foreach ($campaigns as $campaign)
        @php
            // Customers infromation
            $customer_id = $campaign->customer->id;

            $customer_user_id = \App\Models\Customer::where('id', $customer_id)
                ->pluck('user_id')
                ->first();
            $existing_customers = \App\Models\User::where('id', $customer_user_id)->get();
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

        @endphp
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Edit Campaign</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item"> Campaign</li>
                                <li class="breadcrumb-item active"> Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    @include('layouts.alert')
                    <div class="col-sm-12 col-xl-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Campaign Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="theme-form" action="{{ route('campaign.update',$campaign->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0" for="name">Campaign Name</label>
                                                <input class="form-control" id="name" type="text"
                                                    placeholder="Enter Campaign Name" name="name"
                                                    value="{{ $campaign->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0" for="goal">Campaign Goal</label>
                                                <input class="form-control" id="goal" type="text"
                                                    placeholder="Enter Campaign Goal" name="goal"
                                                    value="{{ $campaign->goal }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0" for="customer">Customer</label>
                                                <select name="customer_id" id="" class="form-control">
                                                    <option value="">Select a customer for this campaign</option>
                                                    @foreach ($existing_customers as $existing_customer)

                                                    <option selected="selected" value="{{ $customer_id }}">
                                                        {{ $existing_customer->first_name }}
                                                        &nbsp;{{ $existing_customer->surname }} </option>
                                                @endforeach
                                                    @foreach ($customers as $customer)

                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->user->first_name }}
                                                            &nbsp;{{ $customer->user->surname }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="mb-3">
                                                <label class="col-form-label pt-0" for="customer">Current Campaign Drivers</label>
                                                <ul>
                                                    @foreach ($drivers as $driver)
                                                        <li>   <input type="checkbox" name="driver_user_id[]"
                                                            value="{{ $driver[0]->id }}">
                                                        :{{ $driver[0]->first_name }}
                                                        &nbsp;{{ $driver[0]->surname }}
                                                        </li>


                                                    @endforeach
                                                </ul>

                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label pt-0" for="customer"> Assign new Drivers</label>
                                                <ul>
                                                    @foreach ($alldrivers as $driver)
                                                        <li>
                                                             <input type="checkbox" name="driver_id[]"
                                                            value="{{ $driver->id }}">
                                                        :{{ $driver->user->first_name }}
                                                        &nbsp;{{ $driver->user->surname }}
                                                        </li>


                                                    @endforeach
                                                </ul>

                                            </div>

                                            <div class="card-footer">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                                <button class="btn btn-secondary">Cancel</button>
                                            </div>
                                        </form>
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
@endsection
