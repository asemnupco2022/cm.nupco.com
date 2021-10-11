@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','dashboard')

{{--main body content--}}
@section('content')
    <style>
        .content-wrapper {
            background: URL('img/nupco-banner.png');
        }
    </style>


    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{DashboardHelper::historyCounter('enquiry-email',1)}}</h3>
                    <p>Enquiry Email</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{DashboardHelper::historyCounter('expedite-email',1)}}</h3>
                    <p>Expedite Email</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{DashboardHelper::historyCounter('warning-email',1)}}</h3>
                    <p>Warning Email</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{DashboardHelper::historyCounter('penalty-email',1)}}</h3>
                    <p>Penalty Email</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Area Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Donut Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->



        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Line Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Bar Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->



        </div>
        <!-- /.col (RIGHT) -->
    </div>

    @push('scripts')

        <script>
            $(function () {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */

                //--------------
                //- AREA CHART -
                //--------------

                // Get context with jQuery - using jQuery's .get() method.
                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

                var areaChartData = {
                    // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    labels: [{!! \App\Helpers\DashboardHelper::lineChart(null,[],true) !!}],
                    datasets: [
                        {
                            label               : 'Enquiry Email',
                            backgroundColor     : 'rgba(23, 162, 184, 1)',
                            borderColor         : 'rgba(23, 162, 184, 1)',
                            pointRadius          : false,
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : [{!! \App\Helpers\DashboardHelper::lineChart('enquiry-email') !!}]
                        },
                        {
                            label               : 'Expedite Email',
                            backgroundColor     : 'rgba(40, 167, 69, 1)',
                            borderColor         : 'rgba(40, 167, 69, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(40, 167, 69, 1)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [{!! \App\Helpers\DashboardHelper::lineChart('expedite-email') !!}]
                        },

                        {
                            label               : 'Warning Email',
                            backgroundColor     : 'rgba(255, 193, 7, 1)',
                            borderColor         : 'rgba(255, 193, 7, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(255, 193, 7, 1)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [{!! \App\Helpers\DashboardHelper::lineChart('warning-email') !!}]
                        },

                        {
                            label               : 'Penalty Email',
                            backgroundColor     : 'rgba(220, 53, 69, 1)',
                            borderColor         : 'rgba(220, 53, 69, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(220, 53, 69, 1)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [{!! \App\Helpers\DashboardHelper::lineChart('penalty-email') !!}]
                        },
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaChartData,
                    options: areaChartOptions
                })

                //-------------
                //- LINE CHART -
                //--------------
                var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
                var lineChartOptions = $.extend(true, {}, areaChartOptions)
                var lineChartData = $.extend(true, {}, areaChartData)
                lineChartData.datasets[0].fill = false;
                lineChartData.datasets[1].fill = false;
                lineChartData.datasets[2].fill = false;
                lineChartData.datasets[3].fill = false;
                lineChartOptions.datasetFill = false

                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
                })

                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData        = {
                    labels: [
                        'Enquiry Email',
                        'Expedite Email',
                        'Warning Email',
                        'Penalty Email',
                    ],
                    datasets: [
                        {
                            data: [

                                {{DashboardHelper::historyCounter('enquiry-email',1)}},
                                {{DashboardHelper::historyCounter('expedite-email',1)}},
                                {{DashboardHelper::historyCounter('warning-email',1)}},
                                {{DashboardHelper::historyCounter('penalty-email',1)}}
                            ],
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                        }
                    ]
                }
                var donutOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })



                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

            })
        </script>

    @endpush
@endsection
