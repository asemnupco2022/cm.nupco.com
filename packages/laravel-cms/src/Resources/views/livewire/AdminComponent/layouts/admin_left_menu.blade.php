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
                    @if(auth()->user()->hasAnyPermission([
                        'access_ces_dashboard_',
                        'access_summary_dashboard_',
                        'access_suppliers_dashboard_',
                        'access_tenders_dashboard_',
                        'access_progress_dashboard_',
                        'access_over_due_dashboard_',
                        'access_contracts_expediting_dashboard_',

                        ]))
                     <li class="nav-item {{ (Request::is('dashboard/*')?'menu-open':'') }} ">
                        <a href="#" class="nav-link text-bold {{ (Request::is('dashboard')?'active':'') }} {{ (Request::is('dashboard/*')?'active':'') }}">
                            <img src="{{ asset('img/lt1.svg') }}" alt="job image" title="job image" class="light_mode_img">
                            <img src="{{ asset('img/light/dk1.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                          <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if(auth()->user()->hasAnyPermission(['access_ces_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.ces_dashboard')}}" class="nav-link {{ (Request::is('dashboard/ces-dashboard')?'active':'') }}">
                              <p>Ces Dashboard</p>
                            </a>
                          </li>
                          @endif

                          @if(auth()->user()->hasAnyPermission(['access_summary_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.summary')}}" class="nav-link {{ (Request::is('dashboard/summary')?'active':'') }}">
                              <p>Summary Dashboard</p>
                            </a>
                          </li>
                          @endif
                          @if(auth()->user()->hasAnyPermission(['access_suppliers_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.suppliers_performance')}}" class="nav-link {{ (Request::is('dashboard/suppliers-performance')?'active':'') }}">
                              <p>Suppliers Performance</p>
                            </a>
                          </li>
                          @endif
                          @if(auth()->user()->hasAnyPermission(['access_tenders_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.tenders')}}" class="nav-link {{ (Request::is('dashboard/tenders')?'active':'') }}">
                              <p>Tenders</p>
                            </a>
                          </li>
                          @endif
                          @if(auth()->user()->hasAnyPermission(['access_progress_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.progress')}}" class="nav-link {{ (Request::is('dashboard/progress')?'active':'') }}">
                              <p>Progress</p>
                            </a>
                          </li>
                          @endif
                          @if(auth()->user()->hasAnyPermission(['access_over_due_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.over_due')}}" class="nav-link {{ (Request::is('dashboard/over-due')?'active':'') }}">
                              <p>Over Due</p>
                            </a>
                          </li>
                          @endif
                          @if(auth()->user()->hasAnyPermission(['access_contracts_expediting_dashboard_']))
                          <li class="nav-item">
                            <a href="{{route('web.route.dashboard.contracts_expediting')}}" class="nav-link {{ (Request::is('dashboard/contracts_expediting')?'active':'') }}">
                              <p>Contracts Expediting</p>
                            </a>
                          </li>
                          @endif
                        </ul>
                      </li>
                    @endif
                @if(auth()->user()->hasAnyPermission(['lbs-permission-sap-po','lbs-permission-import','view_only_po_management','lbs-permission-mawari-po']))
                <li class="nav-item increase_size  {{ (Request::is('expediting-management/*')?'menu-open':'')  }}">
                    <a href="#" class="nav-link text-bold">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/lt3.svg') }}" alt="job image" title="job image" class="light_mode_img">
                        <img src="{{ asset('img/light/dk3.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                        <p>
                            Expediting Management

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        @if(auth()->user()->hasAnyPermission(['lbs-permission-sap-po','view_only_po_management']))
                        <li class="nav-item ">
                            <a href="{{route('web.route.po.SAPTableLineItems')}}" class="nav-link {{ (Request::is('*/sap-pos')?'active':'')  }}   {{(Request::is('*/sap-line-items-po/*')?'active':'')}}">
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
                            <a href="{{route('web.route.po.import')}}" class="nav-link {{ (Request::is('*/import-pos')?'active':'') }}">
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
                <li class="nav-item increase_size  {{ (Request::is('expediting-requests/*')?'menu-open':'')  }}">
                    <a href="#" class="nav-link {{ (Request::is('')?'active':'')  }} text-bold  ">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/management.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 25px !important; ">
                        <img src="{{ asset('img/light-dropdown-icon/management.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 25px !important;">
                        <p>
                            Expediting Requests
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        @if(auth()->user()->hasAnyPermission(['lbs-permission-supplier-comments','who_can-reply_notification']))
                            <li class="nav-item increase_size" >
                                <a href="{{route('web.route.ticket.manager.list')}}" class="nav-link {{ (Request::is('*/ticket-manager/*')?'active':'') }} {{ (Request::is('*/ticket-manager')?'active':'') }}">
                                    <!-- <i class=" nav-icon fas fa-upload"></i> -->
                                    <img src="{{ asset('img/dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                    <img src="{{ asset('img/light-dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Supplier Requests
                                        <span class="right badge badge-danger">{{\App\Helpers\PoHelper::unreadMessages('top')}}</span>
                                    </p>
                                </a>
                            </li>
                        @endif


                        <li class="nav-item">
                            <a href="{{route('web.route.customer.request.manager')}}" class="nav-link {{ (Request::is('*/cutomer-request/*')?'active':'') }} {{ (Request::is('*/cutomer-request')?'active':'') }} ">
                                <img src="{{ asset('img/dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                <img src="{{ asset('img/light-dropdown-icon/supplier.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                <p>Customer Requests</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="{{ asset('img/dropdown-icon/radar-tracking.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                <img src="{{ asset('img/light-dropdown-icon/radar-tracking.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                <p>Tracking Requests</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item increase_size  {{ (Request::is('expediting-control/*')?'menu-open':'')  }} ">
                    <a href="#" class="nav-link text-bold ">
                        <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
                        <img src="{{ asset('img/control-panel.svg') }}" alt="job image" title="job image" class="light_mode_img" style="width: 25px !important; margin-right: 24px;">
                        <img src="{{ asset('img/light-dropdown-icon/control-panel.svg') }}" alt="job image" title="job image" class="dark_mode_img" style="width: 25px !important; margin-right: 24px;">
                        <p>
                            Expediting Control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if(auth()->user()->hasAnyPermission(['lbs-permission-notification-history']))
                            <li class="nav-item">
                                <a href="{{route('web.route.automation.history')}}" class="nav-link {{ (Request::is('*/automation/automation-history')?'active':'')  }} ">
                                    <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                                    <img src="{{ asset('img/lt6.svg') }}" alt="job image" title="job image"  class="light_mode_img">
                                    <img src="{{ asset('img/light/dk6.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Notification History
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyPermission(['lbs-permission-staff-data']))
                            <li class="nav-item increase_size">
                                <a href="{{route('web.route.staff.manager.list')}}" class="nav-link {{ (Request::is('*/staff-manager/*')?'active':'')  }} {{ (Request::is('*/staff-manager')?'active':'')  }}">
                                    <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                                    <img src="{{ asset('img/lt9.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                    <img src="{{ asset('img/light/dk9.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Authority
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyPermission(['lbs-permission-logs']))
                            <li class="nav-item ">
                                <a href="{{route('web.route.logs.staff.logs')}}" class="nav-link {{ (Request::is('*/logs/staff-logs')?'active':'')  }}">
                                    <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                                    <img src="{{ asset('img/lt7.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                    <img src="{{ asset('img/light/dk7.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Staff Logs
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyPermission(['lbs-permission-filters']))
                            <li class="nav-item">
                                <a href="{{route('web.route.filters.index')}}" class="nav-link {{ (Request::is('*/filters')?'active':'')  }}  ">
                                    <!-- <i class=" nav-icon fas fa-filter"></i> -->
                                    <img src="{{ asset('img/lt4.svg') }}" alt="job image" title="Filters image" class="light_mode_img">
                                    <img src="{{ asset('img/light/dk4.svg') }}" alt="job image" title="Filters image" class="dark_mode_img">
                                    <p>
                                        Filters
                                    </p>
                                </a>
                            </li>
                        @endif


                        {{-- @if(auth()->user()->hasAnyPermission(['lbs-permission-automation-po']))
                            <li class="nav-item ">
                                <a href="{{route('web.route.automation.list')}}" class="nav-link {{ (Request::is('*/automation')?'active':'')  }}">
                                    <!-- <i class=" nav-icon fab fa-accusoft"></i> -->
                                    <img src="{{ asset('img/lt5.svg') }}" alt="job image" title="job image" class="light_mode_img" style=" width: 21px !important;  margin-right: 22px;">
                                    <img src="{{ asset('img/light/dk5.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Automation
                                    </p>
                                </a>
                            </li>
                        @endif --}}



                        @if(auth()->user()->hasAnyPermission(['lbs-permission-vendor-data']))
                            <li class="nav-item increase_size">
                                <a href="{{route('web.route.vendor.manager.list')}}" class="nav-link {{ (Request::is('*/vendor-manager/*')?'active':'')  }} {{ (Request::is('*/vendor-manager')?'active':'')  }}">
                                    <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                                    <img src="{{ asset('img/lt8.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                    <img src="{{ asset('img/light/dk8.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                    <p>
                                        Vendors
                                    </p>
                                </a>
                            </li>
                        @endif


                        <li class="nav-item increase_size">
                            <a href="{{route('web.route.export')}}" class="nav-link {{ (Request::is('*/export/*')?'active':'')  }} {{ (Request::is('*/export')?'active':'')  }}">
                                <!-- <i class=" nav-icon fas fa-clipboard-list"></i> -->
                                <img src="{{ asset('img/lt2.svg') }}" alt="job image" title="job image" class="light_mode_img">
                                <img src="{{ asset('img/light/Group 70.svg') }}" alt="job image" title="job image" class="dark_mode_img">
                                <p>
                                    Exports
                                    <span class="right badge badge-danger">{{\App\Models\UserExportFiles::getCountOFUnread()}}</span>
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar_bg">
    <img src="{{ asset('img/Path38.svg') }}" alt="job image" title="job image">
    </div>
</aside>
