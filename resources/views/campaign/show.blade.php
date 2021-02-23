@extends('layouts.app')
@section('content')
    @foreach ($campaigns as $campaign)
        @php
            // Customers infromation
            $customer_id = $campaign->customer->id;

            $customer_user_id = \App\Models\Customer::where('id', $customer_id)
                ->pluck('user_id')
                ->first();
            $customers = \App\Models\User::where('id', $customer_user_id)->get();
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

            // dd($drivers);
            // $driver_image = \App\Models\DriverPhoto::where('driver_id', $driver_id)
            //     ->pluck('profile_pic_path')
            //     ->first();
            $percentageDistanceCovered = ($distanceCovered/(int)$campaign->goal) *100;

        @endphp

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>
                                {{ $campaign->name }}</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Campaign</li>
                                <li class="breadcrumb-item active">{{ $campaign->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row size-column">
                    <div class="col-xl-12 box-col-12 xl-100">
                        <div class="row dash-chart">
                            <div class="col-xl-6 box-col-6 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-header card-no-border">
                                        <div class="card-header-right">

                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <p><span class="f-w-500 font-roboto">Campaign Distance Target</span><span
                                                        class="f-w-700 font-primary ms-2">100%</span></p>
                                                <h4 class="f-w-500 mb-0 f-26"><span
                                                        class="counter">{{ $campaign->goal }}</span>KM</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="profit-card">
                                                    <div id="spaline-chart"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="code-box-copy">
                                            <button class="code-box-copy__btn btn-clipboard"
                                                data-clipboard-target="#example-head" title="Copy"><i
                                                    class="icofont icofont-copy-alt"></i></button>
                                            <pre><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
                                                        &lt;div class=&quot;card o-hidden&quot;&gt;
                                                        &lt;div class=&quot;card-header card-no-border&quot;&gt;
                                                        &lt;div class=&quot;card-header-right&quot;&gt;
                                                        &lt;ul class=&quot;list-unstyled card-option&quot;&gt;
                                                          &lt;li&gt;&lt;i class=&quot;fa fa-spin fa-cog&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;view-html fa fa-code&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-maximize full-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-minus minimize-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-refresh reload-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-error close-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                        &lt;/ul&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;media&quot;&gt;
                                                        &lt;div class=&quot;media-body&quot;&gt;
                                                          &lt;p&gt;&lt;span class=&quot;f-w-500 font-roboto&quot;&gt;Month Total sale&lt;/span&gt;&lt;span class=&quot;f-w-700 font-primary ml-2&quot;&gt;79.21%&lt;/span&gt;&lt;/p&gt;
                                                          &lt;h4 class=&quot;f-w-500 mb-0 f-26&quot;&gt;$&lt;span class=&quot;counter&quot;&gt;3465.56&lt;/span&gt;&lt;/h4&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;card-body p-0&quot;&gt;
                                                        &lt;div class=&quot;media&quot;&gt;
                                                        &lt;div class=&quot;media-body&quot;&gt;
                                                          &lt;div class=&quot;profit-card&quot;&gt;
                                                            &lt;div id=&quot;spaline-chart&quot;&gt;&lt;/div&gt;
                                                          &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;!-- Cod Box Copy end --&gt; </code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 box-col-6 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-header card-no-border">
                                        <div class="card-header-right">

                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <p><span class="f-w-500 font-roboto">Campaign Distance Achieved </span><span
                                                        class="f-w-700 font-primary ms-2">{{$percentageDistanceCovered}}%</span></p>
                                                <h4> <span  class="f-w-500 mb-0 f-26 counter">{{$distanceCovered}}</span>KM</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="monthly-visit">
                                            <div id="column-chart"></div>
                                        </div>
                                        <div class="code-box-copy">
                                            <button class="code-box-copy__btn btn-clipboard"
                                                data-clipboard-target="#example-head1" title="Copy"><i
                                                    class="icofont icofont-copy-alt"></i></button>
                                            <pre><code class="language-html" id="example-head1">&lt;!-- Cod Box Copy begin --&gt;
                                                        &lt;div class=&quot;card o-hidden&quot;&gt;
                                                        &lt;div class=&quot;card-header card-no-border&quot;&gt;
                                                        &lt;div class=&quot;card-header-right&quot;&gt;
                                                        &lt;ul class=&quot;list-unstyled card-option&quot;&gt;
                                                          &lt;li&gt;&lt;i class=&quot;fa fa-spin fa-cog&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;view-html fa fa-code&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-maximize full-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-minus minimize-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-refresh reload-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-error close-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                        &lt;/ul&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;media&quot;&gt;
                                                        &lt;div class=&quot;media-body&quot;&gt;
                                                          &lt;p&gt;&lt;span class=&quot;f-w-500 font-roboto&quot;&gt;Month Total visits&lt;/span&gt;&lt;span class=&quot;f-w-700 font-primary ml-2&quot;&gt;95.56%&lt;/span&gt;&lt;/p&gt;
                                                          &lt;h4 class=&quot;f-w-500 mb-0 f-26&quot;&gt;$&lt;span class=&quot;counter&quot;&gt;5,953&lt;/span&gt;&lt;/h4&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;card-body pt-0&quot;&gt;
                                                        &lt;div class=&quot;monthly-visit&quot;&gt;
                                                         &lt;div id=&quot;column-chart&quot;&gt;&lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;!-- Cod Box Copy end --&gt;</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-body">
                                        @foreach ($customers as $customer)


                                            <div class="ecommerce-widgets media">
                                                <div class="media-body">
                                                    <p class="f-w-500 font-roboto">Customer</p>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="avatars">
                                                                <div class="avatar">
                                                                    <img class="img-50 rounded-circle table-img"
                                                                        src="/assets/images/user/1.jpg"
                                                                        alt="{{ $customer->first_name }}">
                                                                    <div
                                                                        class="{{ $customer->isOnline() ? 'status-online ' : 'status-offline' }}">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="progress-box">
                                                                <h6 class="f-w-500 mb-0 f-18">
                                                                    <span>{{ $customer->first_name }}
                                                                        &nbsp;{{ $customer->surname }}</span></h4>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="progress-box">
                                                                <p>
                                                                    <span>Phone Number:{{ $customer->phone }}
                                                                        &nbsp; Email :{{ $customer->phone }}</span>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                <div class="card o-hidden">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="f-w-500 font-roboto">Drivers</p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="display dataTable" id="basic-3">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Phone</th>
                                                                <th>Email</th>
                                                            </thead>
                                                            <tbody>
                                                                    @foreach ($drivers as $driver)
                                                                    <tr>
                                                                        <td>{{ $driver[0]->first_name }}
                                                                            &nbsp;{{ $driver[0]->surname }}</td>
                                                                        <td>{{ $driver[0]->phone }}</td>
                                                                        <td>{{ $driver[0]->email }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>

                                                                    <th>Name</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>
                                                                </tfoot>
                                                            </table>

                                                        </div>

                                                    </div>


                                                </div>
                                            </div>


                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaign Location</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="map"></div>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head4"
                                        title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre><code class="language-html" id="example-head4">&lt;!-- Cod Box Copy begin --&gt;
                                                        &lt;div class=&quot;card&quot;&gt;
                                                        &lt;div class=&quot;card-header card-no-border&quot;&gt;
                                                        &lt;h5&gt;Location&lt;/h5&gt;
                                                        &lt;div class=&quot;card-header-right&quot;&gt;
                                                        &lt;ul class=&quot;list-unstyled card-option&quot;&gt;
                                                          &lt;li&gt;&lt;i class=&quot;fa fa-spin fa-cog&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;view-html fa fa-code&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-maximize full-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-minus minimize-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-refresh reload-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-error close-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                        &lt;/ul&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;card-body pt-0&quot;&gt;
                                                        &lt;div class=&quot;dash-map&quot;&gt;
                                                        &lt;div id=&quot;map&quot;&gt;&lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;!-- Cod Box Copy end --&gt;</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaing Heat map </h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="dash-map">
                                    <div id="heat-map"></div>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head4"
                                        title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre><code class="language-html" id="example-head4">&lt;!-- Cod Box Copy begin --&gt;
                                                        &lt;div class=&quot;card&quot;&gt;
                                                        &lt;div class=&quot;card-header card-no-border&quot;&gt;
                                                        &lt;h5&gt;Location&lt;/h5&gt;
                                                        &lt;div class=&quot;card-header-right&quot;&gt;
                                                        &lt;ul class=&quot;list-unstyled card-option&quot;&gt;
                                                          &lt;li&gt;&lt;i class=&quot;fa fa-spin fa-cog&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;view-html fa fa-code&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-maximize full-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-minus minimize-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-refresh reload-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                          &lt;li&gt;&lt;i class=&quot;icofont icofont-error close-card&quot;&gt;&lt;/i&gt;&lt;/li&gt;
                                                        &lt;/ul&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;div class=&quot;card-body pt-0&quot;&gt;
                                                        &lt;div class=&quot;dash-map&quot;&gt;
                                                        &lt;div id=&quot;map&quot;&gt;&lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;/div&gt;
                                                        &lt;!-- Cod Box Copy end --&gt;</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 xl-50 box-col-12">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Campaign Updates</h5>
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-body new-update pt-0">
                                <div class="activity-timeline">
                                    <div class="media">
                                        <div class="activity-line"></div>
                                        <div class="activity-dot-secondary"></div>
                                        <div class="media-body"><span>Update Product</span>
                                            <p class="font-roboto">Quisque a consequat ante Sit amet magna at volutapt.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-primary"></div>
                                        <div class="media-body"><span>James liked Nike Shoes</span>
                                            <p class="font-roboto">Aenean sit amet magna vel magna fringilla ferme.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-secondary"></div>
                                        <div class="media-body"><span>john just buy your product<i
                                                    class="fa fa-circle circle-dot-secondary pull-right"></i></span>
                                            <p class="font-roboto">Vestibulum nec mi suscipit, dapibus purus.....</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="activity-dot-primary"></div>
                                        <div class="media-body"><span>Jihan Doe just save your product<i
                                                    class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                            <p class="font-roboto">Curabitur egestas consequat lorem.</p>
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
