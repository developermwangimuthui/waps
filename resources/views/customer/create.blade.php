@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Create Customer</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"> Customer</li>
                            <li class="breadcrumb-item active"> Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Customer Details</h5>
                                </div>
                                <div class="card-body">
                                    <form class="theme-form" action="{{ route('customer.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="first_name">First Name</label>
                                                <input class="form-control" id="first_name" type="text"
                                                    placeholder="Enter First Name" name="first_name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="surname">Surname</label>
                                                <input class="form-control" id="surname" type="text"
                                                    placeholder="Enter Surname" name="surname">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="country">Country</label>
                                                <input class="form-control" id="country" type="text"
                                                    placeholder="Enter Country" name="country">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="county">County</label>
                                                <input class="form-control" id="county" type="text"
                                                    placeholder="Enter County" name="county">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="phone">Phone</label>
                                                <input class="form-control" id="phone" type="tel" placeholder="Enter Phone"
                                                    name="phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="phone2">Additional Phone</label>
                                                <input class="form-control" id="phone2" type="tel"
                                                    placeholder="Enter Additional Phone" name="contact_number2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label pt-0" for="exampleInputEmail1">Email
                                                    address</label>
                                                <input class="form-control" id="exampleInputEmail1" type="email"
                                                    aria-describedby="emailHelp" placeholder="Enter email" x name="email">
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
