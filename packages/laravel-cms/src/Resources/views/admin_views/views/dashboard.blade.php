@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','dashboard')



{{--main body content--}}
@section('content')

    <style>

        .custom-bread-crum {
            margin-bottom: 1rem;
            background-color: #393e5e;
            color: white;
        }
        /*body {font-family: ArabicBold}*/

        /*@font-face {*/
        /*    font-family: ArabicBold;*/
        /*    src: url(uploads/font/06ed755cd36ef68e1c8caf631fb9102e.woff);*/

        /*}*/
        .four-col-value .inner {
            border: 1px solid #1c2346;
            border-radius: 4px;
            min-height: 84px;
        }
        .four-col-value .inner-icon img {
            width: 30px;
            height: 100%;
        }
        .four-col-value .inner-icon {
            display: inline-flex;
        }
        .four-col-value h3 {
            font-size: 19px !important;
            margin-left: 13px;
            margin-bottom: 0px;
            padding-top: 4px;
        }
        .row.four-col-value .small-box {
            text-align: center !important;
        }
        .row.four-col-value h6 {
            color: #76797a;
            font-size: 15px;
        }
        .Sky_blue_color {
            color: #895D94;
        }
        .orange_color {
            color: #e37526;
        }
        .reduce_space {
            margin-left: 4px !important;
        }
        .row.devide-two-part .inner {
            padding: 8px 0px;
            min-height: auto;
        }
        .row.devide-two-part h3 {
            font-size: 15px !important;
            padding-top: 1px;
            margin-left: 8px;
        }
        .row.devide-two-part img {
            width: 21px;
        }
        .row.devide-two-part h6 {
            font-size: 13px;
        }
        .devide-two-part .small-box {
            margin-bottom: 8px !important;
        }
        .devide-two-part .col-lg-6.col-6.sp-lt {
            padding-left: 4px;
        }
        .devide-two-part .col-lg-6.col-6.sp-rt {
            padding-right: 4px;
        }
        .devide-two-part h4 {
            text-align: center;
            font-size: 19px;
            margin-bottom: 15px;
            margin-top: 5px;
        }
        .bg_gray {
            background: #f8f8f8;
        }
        .bg_gray_dark {
            background: #e6e6e6;
        }
        .row.devide-two-part .inner {
            background: #f9f9f9;
        }
        .four-col-value .small-box {
            margin-bottom: 10px;
        }
        .chart-section h3.card-title {
            font-size: 15px;
            text-align: center;
            color: #76797a;
            width: 100%;
        }
        .chart-section .card-header {
            padding: 10px 0px;
            border: 0px solid;
        }
        .chart-section .card {
            border: 1px solid #1c2346;
            border-radius: 4px;
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .chart-section .card-body {
            padding: 5px 10px;
        }
        .vendor-info h6 {
            font-size: 15px !important;
        }
        .vendor-info img {
            width: 35px !important;
        }
        .vendor-info .row.devide-two-part h3 {
            font-size: 26px !important;
        }
        .vendor-info {
            margin-top: 10px;
        }
        .vendor-info .inner {
            background: #fff !important;
            padding: 5px 10px !important;
        }
        .chart-section .card {
            min-height: 265px !important;
        }
        .chart-section .col-md-6 .card {
            min-height: auto !important;
        }
        .map-section div#kt_amcharts_1 {
            margin-top: 25px;
        }
        .map-section .card {
            min-height: 250px !important;
        }
    </style>


   {{-- @include('dashboards.notification-report-dashboard') --}}
    @include('dashboards.power-bi-dashboard')
@endsection
