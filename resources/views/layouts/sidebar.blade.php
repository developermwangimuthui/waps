<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
                {{-- <a href="index-2.html"><img class="img-fluid for-light"
                        src="/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark"
                        src="/assets/images/logo/logo_dark.png" alt="">
                    </a> --}}
                    <h3>WAPS</h3>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="index-2.html"><img class="img-fluid"
                    src="/assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index-2.html"><img class="img-fluid"
                                src="/assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>

                    {{-- <li class="sidebar-list">
                        <label class="badge badge-success">2</label><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="home"></i><span class="lan-3">Dashboard </span></a>

                    </li> --}}

                    <li class="sidebar-list">
                      <a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="box"></i><span>Campaigns </span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('campaign.create')}}">Create new</a></li>
                            <li><a href="{{route('campaign.index')}}">Campaign List</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{route('driver.index')}}"><i
                                data-feather="git-pull-request"> </i><span>Drivers</span></a></li>

                                <li class="sidebar-list">
                                  <a class="sidebar-link sidebar-title" href="#"><i
                                            data-feather="box"></i><span>Customers </span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{route('customer.create')}}">Add Customers</a></li>
                                        <li><a href="{{route('customer.index')}}">Customer List </a></li>
                                    </ul>
                                </li>

                    {{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="users"></i><span>Users</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="user-profile.html">Users Profile</a></li>
                            <li><a href="edit-profile.html">Users Edit</a></li>
                            <li><a href="user-cards.html">Users Cards</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="to-do.html"><i
                                data-feather="clock"> </i><span>Notification</span></a></li> --}}

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
