@extends('layouts.app')
@section('content')
@foreach ($customers as $customer)
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Edit Customer</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Customer </li>
              <li class="breadcrumb-item active"> Edit Customer</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="edit-profile">
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title mb-0">Customer Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#"
                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
              </div>
              <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-auto"><img class="img-70 rounded-circle" alt=""
                        src="/assets/images/user/7.jpg"></div>
                    <div class="col">
                      <h3 class="mb-1">{{$customer->user->first_name}}&nbsp;&nbsp;{{$customer->user->surname}}</h3>
                      <p class="mb-4">Customer</p>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email-Address</label>: <br>
                    <p>{{$customer->user->email}}</p>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Phone</label>:
                    <p> {{$customer->user->phone}}</p>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Country</label>:
                    <p> {{$customer->user->country}}</p>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">County</label>:
                    <p> {{$customer->user->county}}</p>
                  </div>


              </div>
            </div>
          </div>
          <div class="col-xl-8">
            <form class="card" action="{{route('customer.update',$customer->user->id)}}" method="POST">
                @csrf
              <div class="card-header">
                <h4 class="card-title mb-0">Edit Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#"
                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="mb-3">
                      <label class="form-label">First Name</label>
                      <input class="form-control" type="text" name="first_name" value="{{$customer->user->first_name}}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-3">
                    <div class="mb-3">
                      <label class="form-label">Surname</label>
                      <input class="form-control" type="text" name="surname" value="{{$customer->user->surname}}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Email address</label>
                      <input class="form-control" type="email" name="email" value="{{$customer->user->email}}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Phone</label>
                      <input class="form-control" type="text" name="phone" value="{{$customer->user->phone}}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Country</label>
                      <input class="form-control" type="text" name="country" value="{{$customer->user->country}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label class="form-label">County</label>
                      <input class="form-control" type="text" name="county" value="{{$customer->user->county}}">
                    </div>
                  </div>



                </div>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Update Profile</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
@endforeach
@endsection
