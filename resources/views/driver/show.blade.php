@extends('layouts.app')
@section('content')
    </head>
    @foreach ($drivers as $driver)
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Edit Driver</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html"> <i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Driver </li>
                                <li class="breadcrumb-item active"> Edit Driver</li>
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
                                    <h4 class="card-title mb-0">Driver Profile</h4>
                                    <div class="card-options"><a class="card-options-collapse" href="#"
                                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                class="fe fe-x"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-auto"><img class="img-80 rounded-circle" alt=""
                                                src="{{ URL::to('/') }}/DriverPhotos/{{ $driver->driverPhotos->pluck('profile_pic_path')->first() }}">
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">
                                                {{ $driver->user->first_name }}&nbsp;&nbsp;{{ $driver->user->surname }}
                                            </h6>
                                            <p class="mb-4">Driver</p>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email-Address</label>: <br>
                                        <p>{{ $driver->user->email }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>:
                                        <p> {{ $driver->user->phone }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>:
                                        <p> {{ $driver->user->country }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">County</label>:
                                        <p> {{ $driver->user->county }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Vehicle Registration</label>:
                                        <p> @if (empty($driver->vehicles[0]))
                                            <p>Not Updated</p>
                                            @else
                                            {{ $driver->vehicles[0]->car_number_plate }}
                                        @endif</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Car Model</label>:
                                        <p> @if (empty($driver->vehicles[0]))
                                            <p>Not Updated</p>
                                            @else
                                            {{ $driver->vehicles[0]->car_model }}
                                        @endif</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Car Year of Manufacture</label>:
                                        <p> @if (empty($driver->vehicles[0]))
                                            <p>Not Updated</p>
                                            @else
                                            {{ $driver->vehicles[0]->yom }}
                                        @endif</p>
                                    </div>
                                    @if ($driver->status == 0)

                                        <a href="{{ route('driver.approve', $driver->id) }}" class="btn btn-primary"
                                            type="submit">Approve Driver</a>
                                    @else

                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <form class="card" action="{{ route('driver.update', $driver->user->id) }}" method="POST">
                                @csrf
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Edit Profile</h4>
                                    <div class="card-options"><a class="card-options-collapse" href="#"
                                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                class="fe fe-x"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input class="form-control" type="text" name="first_name"
                                                    value="{{ $driver->user->first_name }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Surname</label>
                                                <input class="form-control" type="text" name="surname"
                                                    value="{{ $driver->user->surname }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email address</label>
                                                <input class="form-control" type="email" name="email"
                                                    value="{{ $driver->user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ $driver->user->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input class="form-control" type="text" name="country"
                                                    value="{{ $driver->user->country }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">County</label>
                                                <input class="form-control" type="text" name="county"
                                                    value="{{ $driver->user->county }}">
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    {{-- <button class="btn btn-primary" type="submit">Update Profile</button> --}}
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Driver Credentials</h5>
                                </div>
                                <div class="my-gallery card-body row gallery-with-description" itemscope="">
                                    <figure class="col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope=""><a
                                            href="{{ URL::to('/') }}/DriverFrontLicense/{{ $driver->driverLicenses->pluck('front_license')->first() }}"
                                            itemprop="contentUrl" data-size="1600x950"><img
                                                src="{{ URL::to('/') }}/DriverFrontLicense/{{ $driver->driverLicenses->pluck('front_license')->first() }}"
                                                itemprop="thumbnail" alt="Image description">
                                            <div class="caption">
                                                <h4>Driver Licence Front</h4>
                                            </div>
                                        </a>
                                        <figcaption itemprop="caption description">
                                            <h4>Driver Licence Front</h4>
                                        </figcaption>
                                    </figure>

                                    <figure class="col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope=""><a
                                            href="{{ URL::to('/') }}/DriverBackLicense/{{ $driver->driverLicenses->pluck('back_license')->first() }}"
                                            itemprop="contentUrl" data-size="1600x950"><img
                                                src="{{ URL::to('/') }}/DriverBackLicense/{{ $driver->driverLicenses->pluck('back_license')->first() }}"
                                                itemprop="thumbnail" alt="Image description">
                                            <div class="caption">
                                                <h4>Driver Licence Back</h4>
                                            </div>
                                        </a>
                                        <figcaption itemprop="caption description">
                                            <h4>Driver Licence Back</h4>
                                        </figcaption>
                                    </figure>


                                    <figure class="col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope=""><a
                                            href="{{ URL::to('/') }}/CarFrontPhotos/{{ $driver->vehiclePhotos->pluck('car_front')->first() }}"
                                            itemprop="contentUrl" data-size="1600x950"><img
                                                src="{{ URL::to('/') }}/CarFrontPhotos/{{ $driver->vehiclePhotos->pluck('car_front')->first() }}"
                                                itemprop="thumbnail" alt="Image description">
                                            <div class="caption">
                                                <h4>Car Front Photo</h4>
                                            </div>
                                        </a>
                                        <figcaption itemprop="caption description">
                                            <h4>Car Front Photo</h4>
                                        </figcaption>
                                    </figure>
                                    <figure class="col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope=""><a
                                            href="{{ URL::to('/') }}/CarBackPhotos/{{ $driver->vehiclePhotos->pluck('car_back')->first() }}"
                                            itemprop="contentUrl" data-size="1600x950"><img
                                                src="{{ URL::to('/') }}/CarBackPhotos/{{ $driver->vehiclePhotos->pluck('car_back')->first() }}"
                                                itemprop="thumbnail" alt="Image description">
                                            <div class="caption">
                                                <h4>Car Back Photo</h4>
                                            </div>
                                        </a>
                                        <figcaption itemprop="caption description">
                                            <h4>Car Back Photo</h4>
                                        </figcaption>
                                    </figure>


                                </div>
                                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                    <!--
                          Background of PhotoSwipe.
                          It's a separate element, as animating opacity is faster than rgba().
                          -->
                                    <div class="pswp__bg"></div>
                                    <!-- Slides wrapper with overflow:hidden.-->
                                    <div class="pswp__scroll-wrap">
                                        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                                        <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                                        <div class="pswp__container">
                                            <div class="pswp__item"></div>
                                            <div class="pswp__item"></div>
                                            <div class="pswp__item"></div>
                                        </div>
                                        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                                        <div class="pswp__ui pswp__ui--hidden">
                                            <div class="pswp__top-bar">
                                                <!-- Controls are self-explanatory. Order can be changed.-->
                                                <div class="pswp__counter"></div>
                                                <button class="pswp__button pswp__button--close"
                                                    title="Close (Esc)"></button>
                                                <button class="pswp__button pswp__button--share" title="Share"></button>
                                                <button class="pswp__button pswp__button--fs"
                                                    title="Toggle fullscreen"></button>
                                                <button class="pswp__button pswp__button--zoom"
                                                    title="Zoom in/out"></button>
                                                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                                                <!-- element will get class pswp__preloader--active when preloader is running-->
                                                <div class="pswp__preloader">
                                                    <div class="pswp__preloader__icn">
                                                        <div class="pswp__preloader__cut">
                                                            <div class="pswp__preloader__donut"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                <div class="pswp__share-tooltip"></div>
                                            </div>
                                            <button class="pswp__button pswp__button--arrow--left"
                                                title="Previous (arrow left)"></button>
                                            <button class="pswp__button pswp__button--arrow--right"
                                                title="Next (arrow right)"></button>
                                            <div class="pswp__caption">
                                                <div class="pswp__caption__center"></div>
                                            </div>
                                        </div>
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
