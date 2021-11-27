<!DOCTYPE html>
<html lang="{{LaravelCms::lbs_object_key_exists('app_local',Session::get('_LbsAppSession'))}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="text-uppercase ">@yield('title_') | {{config('lbs-laravel-cms.application.admin_route_domain')}}  {{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}} </title>
    <link rel="icon" type="image/x-icon" href="{{URL(LaravelCms::lbs_object_key_exists('app_logo',Session::get('_LbsAppSession')))}}" alt="{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/css/adminlte.min.css')}}">

    <!-- overlayScrollbars -->

    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'css/custom.min.css')}}">
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'css/loader.css')}}">
    <link href="https//db.onlinewebfonts.com/c/7758d88db1fe2060f8b28055f108d316?family=Co+Headline+W23+Arabic+Regular" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    @if(LaravelCms::lbs_object_key_exists('dark_mode', Session::get('_LbsLteSession'))=='true')
        <style>
            span.select2-selection.select2-selection--multiple {
                background-color: #343a40 !important;
            }
        </style>
    @endif
    <livewire:styles />

    @stack('styles')
    @stack('styles2')



    <style>
        body {
            font-family: Regular
        }

        @font-face {
            font-family: Regular;

            src:url({{ URL::asset('uploads/font/7758d88db1fe2060f8b28055f108d316.woff') }});

        }
    </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">

<div class="wrapper">

{{--    <!-- Preloader -->--}}
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__shake" src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}
{{--    --}}

    <div class="clock-loader"></div>
    <!-- Navbar -->
    <livewire:livewire.AdminControllers.layouts.admin_nav />
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <livewire:livewire.AdminControllers.layouts.leftMenu />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">

        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

            {{--main body content--}}
            @section('content')
            @show
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer text-center">
        <strong>Copyright &copy; {{date('Y')}} <a href="/">{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</a>.</strong>
       {{-- <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> {{LaravelCms::lbs_object_key_exists('app_version',Session::get('_LbsAppSession'))}}
        </div> --}}
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<livewire:livewire.AdminControllers.layouts.rightMenu/>
<!-- jQuery -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/js/pages/dashboard3.js')}}"></script>


<!-- overlayScrollbars -->

<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/moment/moment.min.js')}}"></script>
<livewire:scripts />


@stack('loader')


@stack('scripts')
@stack('scripts2')

</body>
</html>
