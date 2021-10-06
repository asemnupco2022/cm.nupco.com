<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link logo_aria">
        <img src="{{URL(LaravelCms::lbs_object_key_exists('app_logo',Session::get('_LbsAppSession')))}}" alt="{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}" class="brand-image" >
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{URL(LaravelCms::lbs_object_key_exists('avatar',Session::get('_LbsUserSession')))}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-uppercase ">{{LaravelCms::lbs_object_key_exists('username',Session::get('_LbsUserSession'))}}</a>
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
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">

                    <a href="/"  class="nav-link {{ (Request::is('dashboard')?'active':'') }} ">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <img src="{{ asset('img/dashboard.svg') }}" alt="job image" title="job image">
                        <p class="">
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('web.route.po.import')}}" class="nav-link {{ (Request::is('import-pos')?'active':'') }}">
                        <!-- <i class=" nav-icon fas fa-upload"></i> -->
                        <img src="{{ asset('img/sent.svg') }}" alt="job image" title="job image">
                        <p>
                            Import PO
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('web.route.po.SAPTable')}}" class="nav-link {{ (Request::is('sap-pos')?'active':'')  }}  {{(Request::is('sap-line-items-po/*')?'active':'')}}">
                        <!-- <i class=" nav-icon fas fa-file"></i> -->
                        <img src="{{ asset('img/bar-chart.svg') }}" alt="job image" title="job image">
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
                        <img src="{{ asset('img/filter.svg') }}" alt="job image" title="Filters image">
                        <p>
                            Filters
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('web.route.automation.list')}}" class="nav-link {{ (Request::is('automation')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/clipboard.svg') }}" alt="job image" title="job image">
                        <p>
                            Automation
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('web.route.automation.history')}}" class="nav-link {{ (Request::is('automation/automation-history')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/history.svg') }}" alt="job image" title="job image">
                        <p>
                            Automation History
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('web.route.logs.staff.logs')}}" class="nav-link {{ (Request::is('logs/staff-logs')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/management.svg') }}" alt="job image" title="job image">
                        <p>
                            Staff Logs
                        </p>
                    </a>
                </li>


{{--                <li class="nav-item ">--}}
{{--                    <a href="" wire:click.prevent="logout" class="nav-link ">--}}
{{--                        <img src="{{ asset('img/logout.png') }}" alt="job image" title="job image">--}}
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
</aside>
