@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Create Campaign</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"> Campaign</li>
                            <li class="breadcrumb-item active"> Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">

                @include('layouts.alert')
                <div class="col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Campaign Details</h5>
                                </div>
                                <div class="card-body">
                                    <form class="theme-form" action="{{ route('campaign.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="name">Campaign Name</label>
                                                <input class="form-control" id="name" type="text"
                                                    placeholder="Enter Campaign Name" name="name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="goal">Campaign Goal</label>
                                                <input class="form-control" id="goal" type="number"
                                                    placeholder="Enter Campaign Goal" name="goal">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="customer">Customer</label>
                                                <select name="customer_id" id="" class="form-control">
                                                    <option value="">Select a customer for this campaign</option>

                                                    @foreach ($customers as $customer)

                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->user->first_name }}
                                                            &nbsp;{{ $customer->user->surname }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="customer">Drivers</label>
                                                <ul>
                                                    @foreach ($drivers as $driver)
                                                        <li>
                                                             <input type="checkbox" name="driver_id[]"
                                                            value="{{ $driver->id }}">
                                                        :{{ $driver->user->first_name }}
                                                        &nbsp;{{ $driver->user->surname }}
                                                        </li>


                                                    @endforeach
                                                </ul>



                                            </div>
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
@endsection
