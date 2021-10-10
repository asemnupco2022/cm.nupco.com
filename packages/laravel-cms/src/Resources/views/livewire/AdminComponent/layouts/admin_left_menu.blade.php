<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo_aria">
        <img src="{{URL(LaravelCms::lbs_object_key_exists('app_logo',Session::get('_LbsAppSession')))}}" alt="{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}" class="brand-image" >
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3  d-flex">
            <div class="image">
                <img src="{{URL(LaravelCms::lbs_object_key_exists('avatar',Session::get('_LbsUserSession')))}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('web.route.profile')}}" class="d-block text-uppercase ">{{LaravelCms::lbs_object_key_exists('username',Session::get('_LbsUserSession'))}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
    {{--        <div class="form-inline">--}}
    {{--            <div class="input-group" data-widget="sidebar-search">--}}
    {{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
    {{--                <div class="input-group-append">--}}
    {{--                    <button class="btn btn-sidebar">--}}
    {{--                        <i class="fas fa-search fa-fw"></i>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    <!-- Sidebar Menu -->
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">

                    <a href="/"  class="nav-link {{ (Request::is('dashboard')?'active':'') }} ">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <img src="{{ asset('img/Group 69.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 69.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p class="">
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('web.route.po.import')}}" class="nav-link {{ (Request::is('import-pos')?'active':'') }}">
                        <!-- <i class=" nav-icon fas fa-upload"></i> -->
                        <img src="{{ asset('img/Group 70.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 70.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Import PO
                        </p>
                    </a>
                </li>

                <li class="nav-item increase_size">
                    <a href="{{route('web.route.po.SAPTable')}}" class="nav-link {{ (Request::is('sap-pos')?'active':'')  }}  {{(Request::is('sap-line-items-po/*')?'active':'')}}">
                        <!-- <i class=" nav-icon fas fa-file"></i> -->
                        <img src="{{ asset('img/Group 71.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 71.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            SAP PO
                        </p>
                    </a>
                </li>

                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('web.route.po.MawTable')}}" class="nav-link  {{ (Request::is('mowared-pos')?'active':'')  }}  {{(Request::is('mow-line-items-po/*')?'active':'')}}">--}}
                {{--                        <i class=" nav-icon fas fa-file"></i>--}}
                {{--                        <p>--}}
                {{--                            Mowared PO--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}


                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('lbs.admin.dashboard.listAppSettings')}}" class="nav-link">--}}
                {{--                        <i class=" nav-icon fas fa-cogs"></i>--}}
                {{--                        <p>--}}
                {{--                            Settings--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

                <li class="nav-item">
                    <a href="{{route('web.route.filters.index')}}" class="nav-link {{ (Request::is('filters')?'active':'')  }}  ">
                        <!-- <i class=" nav-icon fas fa-filter"></i> -->
                        <img src="{{ asset('img/Group 72.svg') }}" alt="job image" title="Filters image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 72.svg') }}" alt="job image" title="Filters image" class="dark_mode_img">
                        <p>
                            Filters
                        </p>
                    </a>
                </li>


                <li class="nav-item increase_size">
                    <a href="{{route('web.route.automation.list')}}" class="nav-link {{ (Request::is('automation')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/Group 73.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 73.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Automation
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('web.route.automation.history')}}" class="nav-link {{ (Request::is('automation/automation-history')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/Group 76.svg') }}" alt="job image" title="job image"  class="light_mode_img">
                        <img src="{{ asset('img/light/Group 76.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Notification History
                        </p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a href="{{route('web.route.logs.staff.logs')}}" class="nav-link {{ (Request::is('logs/staff-logs')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/Group 75.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 75.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Staff Logs
                        </p>
                    </a>
                </li>

                <li class="nav-item increase_size">
                    <a href="{{route('web.route.vendor.manager.list')}}" class="nav-link {{ (Request::is('staff-manager/*')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/Group 74.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 80.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Vendors
                        </p>
                    </a>
                </li>

                <li class="nav-item increase_size">
                    <a href="{{route('web.route.staff.manager.list')}}" class="nav-link {{ (Request::is('vendor-manager/*')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/Group 74.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/Group 80.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Staffs
                        </p>
                    </a>
                </li>


{{--                <li class="nav-item ">--}}
{{--                    <a href="" wire:click.prevent="logout" class="nav-link ">--}}
{{--                        <p class="">--}}
{{--                            Logout--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar_bg">
    <img src="{{ asset('img/Path38.svg') }}" alt="job image" title="job image">
    </div>
</aside>
