<!-- Content Header (Page header) -->
<div class="content-header custom-bread-crum">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Summary</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{--                <ol class="breadcrumb float-sm-right">--}}
                {{--                    <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                {{--                    <li class="breadcrumb-item active">Dashboard v3</li>--}}
                {{--                </ol>--}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row four-col-value">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Total Contracts</h6>
                        <div class="inner-icon">
                            <img src="{{URL('img/dashboard-1.png')}}">
                            <h3 class="Sky_blue_color">{{\App\Helpers\PoHelper::thousandsCurrencyFormat(\Illuminate\Support\Facades\DB::table('dash_summary_report')->first()->total_contract)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Late Contracts</h6>
                        <div class="inner-icon">
                            <h3 class="orange_color">{{\Illuminate\Support\Facades\DB::table('dash_summary_report')->first()->late_contract}} %</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Net Order value</h6>
                        <div class="inner-icon">
                            <img src="{{URL('img/dashboard-2.png')}}">
                            <h3 class="Sky_blue_color reduce_space">{{\App\Helpers\PoHelper::thousandsCurrencyFormat(\Illuminate\Support\Facades\DB::table('dash_summary_report')->first()->net_order_value)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>GR Amount</h6>
                        <div class="inner-icon">
                            <img src="{{URL('img/dashboard-3.png')}}">
                            <h3 class="Sky_blue_color">{{\App\Helpers\PoHelper::thousandsCurrencyFormat(\Illuminate\Support\Facades\DB::table('dash_summary_report')->first()->gr_amount)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-3">
                <!-- STACKED BAR CHART -->
             @livewire('reports.charts.bar-chart-component')
                <!-- /.card -->
            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
