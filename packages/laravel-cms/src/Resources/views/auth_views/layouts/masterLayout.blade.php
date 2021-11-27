<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_')  {{config('lbs-laravel-cms.application.admin_route_domain')}}  {{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}} </title>
    <link rel="icon" type="image/x-icon" href="{{URL(LaravelCms::lbs_object_key_exists('app_logo',Session::get('_LbsAppSession')))}}" alt="{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
          href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'css/custom.min.css')}}">
    <livewire:styles />
    @stack('styles')

</head>
<body class="hold-transition login-page">

<div class="login-box">
    <!-- /.login-logo -->

    <div class="card child-card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h5"><b>{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</b></a>
        </div>

        @section('content')
        @show

    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'dist/js/adminlte.min.js')}}"></script>



<livewire:scripts />

@stack('scripts')
@stack('scripts1')



</body>
</html>
