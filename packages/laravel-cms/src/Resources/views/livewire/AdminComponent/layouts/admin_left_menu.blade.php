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
                <img src="{{URL('').'/'.LaravelCms::lbs_object_key_exists('avatar',Session::get('_LbsUserSession'))}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('web.route.profile')}}" class="d-block text-uppercase ">{{LaravelCms::lbs_object_key_exists('username',Session::get('_LbsUserSession'))}}</a>
            </div>
        </div>


    <!-- Sidebar Menu -->
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="/"  class="nav-link {{ (Request::is('dashboard')?'active':'') }} ">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <img src="{{ asset('img/lt1.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk1.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p class="">
                            Dashboard
                        </p>
                    </a>
                </li>


                @if(auth()->user()->hasAnyPermission(['lbs-permission-sap-po','lbs-permission-import','view_only_po_management','lbs-permission-mawari-po']))
                <li class="nav-item increase_size">
                    <a href="#" class="nav-link {{ (Request::is('sap-pos')?'active':'')  }} {{ (Request::is('import-pos')?'active':'')  }}  {{(Request::is('sap-pos')?' menu-is-opening menu-open':'')}}
                    {{(Request::is('sap-line-items-po/*')?'active':'')}}
                    ">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/lt3.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk3.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            PO Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview "  style="display: {{(Request::is('sap-line-items-po/*')?'block':'')}} {{ Request::is('sap-pos') ? 'block;' : '' }} {{ Request::is('import-pos') ? 'block;' : '' }}" >
                        @if(auth()->user()->hasAnyPermission(['lbs-permission-sap-po','view_only_po_management']))
                        <li class="nav-item ">
                            <a href="{{route('web.route.po.SAPTableLineItems')}}" class="nav-link {{ (Request::is('sap-pos')?'active':'')  }}   {{(Request::is('sap-line-items-po/*')?'active':'')}}">
                            <img src="{{ asset('img/dspa_light.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 21px !important; margin-right: 24px;">
                            <img src="{{ asset('img/light-dropdown-icon/dspa_dark.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 21px !important; margin-right: 24px;">
                            <p>SAP Reports</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasAnyPermission(['lbs-permission-mawari-po','view_only_po_management']))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/audit-report-survey.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 21px !important; margin-right: 24px;">
                            <img src="{{ asset('img/light-dropdown-icon/audit-report-survey.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 21px !important; margin-right: 24px;">
                            <p>Mawared Report</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasAnyPermission(['lbs-permission-import']))
                        <li class="nav-item ">
                            <a href="{{route('web.route.po.import')}}" class="nav-link {{ (Request::is('import-pos')?'active':'') }}">
                                <!-- <i class=" nav-icon fas fa-upload"></i> -->
                                <img src="{{ asset('img/lt2.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 24px !important; margin-right: 22px;">
                                <img src="{{ asset('img/light/dk2.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 24px !important; margin-right: 22px;">
                                <p>
                                    Import PO
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <li class="nav-item increase_size">
                    <a href="#" class="nav-link {{ (Request::is('')?'active':'')  }}  ">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/management.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 25px !important; ">
                        <img src="{{ asset('img/light-dropdown-icon/management.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 25px !important;">
                        <p>
                            Expediting Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/reminders.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 24px !important; margin-right: 22px;">
                            <img src="{{ asset('img/light-dropdown-icon/reminders.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 24px !important; margin-right: 22px;">
                            <p>Supplier Reminder</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/supplier_warning.svg') }}" alt="job image" title="job image" class="light_mode_img">
                            <img src="{{ asset('img/light-dropdown-icon/supplier_warning.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                            <p>Supplier Warning</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item increase_size">
                    <a href="#" class="nav-link {{ (Request::is('')?'active':'')  }}  ">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/control-panel.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 25px !important; margin-right: 24px;">
                        <img src="{{ asset('img/light-dropdown-icon/control-panel.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 25px !important; margin-right: 24px;">
                        <p>
                            Expediting Control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="light_mode_img">
                            <img src="{{ asset('img/light-dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                            <p>Supplier Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/radar-tracking.svg') }}" alt="job image" title="job image" class="light_mode_img">
                            <img src="{{ asset('img/light-dropdown-icon/radar-tracking.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                            <p>Tracking Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <img src="{{ asset('img/dropdown-icon/frq.svg') }}" alt="job image" title="job image" class="light_mode_img">
                            <img src="{{ asset('img/light-dropdown-icon/rfq.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                            <p>RFQ</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->hasAnyPermission(['lbs-permission-filters']))
                <li class="nav-item">
                    <a href="{{route('web.route.filters.index')}}" class="nav-link {{ (Request::is('filters')?'active':'')  }}  ">
                        <!-- <i class=" nav-icon fas fa-filter"></i> -->
                        <img src="{{ asset('img/lt4.svg') }}" alt="job image" title="Filters image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk4.svg') }}" alt="job image" title="Filters image" class="dark_mode_img">
                        <p>
                            Filters
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasAnyPermission(['lbs-permission-automation-po']))
                <li class="nav-item ">
                    <a href="{{route('web.route.automation.list')}}" class="nav-link {{ (Request::is('automation')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/lt5.svg') }}" alt="job image" title="job image" class="light_mode_img" style=" width: 21px;  margin-right: 22px;">
                        <img src="{{ asset('img/light/dk5.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Automation
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasAnyPermission(['lbs-permission-notification-history']))
                <li class="nav-item">
                    <a href="{{route('web.route.automation.history')}}" class="nav-link {{ (Request::is('automation/automation-history')?'active':'')  }} ">
                        <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                        <img src="{{ asset('img/lt6.svg') }}" alt="job image" title="job image"  class="light_mode_img">
                        <img src="{{ asset('img/light/dk6.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Notification History
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasAnyPermission(['lbs-permission-logs']))
                <li class="nav-item ">
                    <a href="{{route('web.route.logs.staff.logs')}}" class="nav-link {{ (Request::is('logs/staff-logs')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/lt7.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk7.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Staff Logs
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasAnyPermission(['lbs-permission-vendor-data']))
                <li class="nav-item increase_size">
                    <a href="{{route('web.route.vendor.manager.list')}}" class="nav-link {{ (Request::is('staff-manager/*')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/lt8.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk8.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Vendors
                        </p>
                    </a>
                </li>
                @endif


                @if(auth()->user()->hasAnyPermission(['lbs-permission-staff-data']))
                <li class="nav-item increase_size">
                    <a href="{{route('web.route.staff.manager.list')}}" class="nav-link {{ (Request::is('vendor-manager/*')?'active':'')  }}">
                        <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                        <img src="{{ asset('img/lt9.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk9.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Authority
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasAnyPermission(['lbs-permission-supplier-comments','who_can-reply_notification']))
                <li class="nav-item increase_size" >
                    <a href="{{route('web.route.ticket.manager.list')}}" class="nav-link {{ (Request::is('ticket-manager/*')?'active':'') }}">
                        <!-- <i class=" nav-icon fas fa-upload"></i> -->
                        <img src="{{ asset('img/ticket.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk12.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Supplier Comments
                            <span class="right badge badge-danger">{{\App\Helpers\PoHelper::unreadMessages('top')}}</span>
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar_bg">
    <img src="{{ asset('img/Path38.svg') }}" alt="job image" title="job image">
    </div>
</aside>
