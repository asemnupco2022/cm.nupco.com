@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','dashboard')

{{--main body content--}}
@section('content')
    <style>
        .content-wrapper {
            background: URL('img/nupco-banner.png');
        }
        #areaChart {
            min-height: 273px !important;
            height: 250px;
            max-height: 250px;
            max-width: 100%;
            display: block;
            width: 737px;
        }
    </style>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{DashboardHelper::historyCounter('enquiry-email',1)}}</h3>
                    <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('enquiry-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                    <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('enquiry-email',null,'manual',null,null)}}
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
                    <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('expedite-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                    <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('expedite-email',null,'manual',null,null)}}
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
                    <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('warning-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                    <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('warning-email',null,'manual',null,null)}}
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
                    <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('penalty-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                    <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('penalty-email',null,'manual',null,null)}}
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


            <!-- DONUT CHART -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Donut Chart For Month: {{date('F')}}</h3>

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
                   <div class="row">
                       <div class="col-md-6 text-center"> <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>Manual</div>
                       <div class="col-md-6 text-center"> <canvas id="donutChartManual" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>Automation</div>
                   </div>
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


            <!-- AREA CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Area Chart: Automated VS Manual</h3>

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

                var areaLineData = {
                    labels: [{!! DashboardHelper::lineChart(null,[],true) !!}],
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
                            data                : [{!! DashboardHelper::lineChart('enquiry-email') !!}]
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
                            data                : [{!! DashboardHelper::lineChart('expedite-email') !!}]
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
                            data                : [{!! DashboardHelper::lineChart('warning-email') !!}]
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
                            data                : [{!! DashboardHelper::lineChart('penalty-email') !!}]
                        },
                    ]
                }

                var areaAreaData = {
                    labels: [{!! DashboardHelper::lineChart(null,[],true) !!}],
                    datasets: [
                        {
                            label               : 'Digital Goods',
                            backgroundColor     : 'rgba(60,141,188,0.9)',
                            borderColor         : 'rgba(60,141,188,0.8)',
                            pointRadius          : false,
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : [{!! DashboardHelper::lineChart(null,null,null,null,'automation') !!}]
                        },
                        {
                            label               : 'Electronics',
                            backgroundColor     : 'rgba(210, 214, 222, 1)',
                            borderColor         : 'rgba(210, 214, 222, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(210, 214, 222, 1)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [{!! DashboardHelper::lineChart(null,null,null,null,'manual') !!}]
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
                    data: areaAreaData,
                    options: areaChartOptions
                })

                //-------------
                //- LINE CHART -
                //--------------
                var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
                var lineChartOptions = $.extend(true, {}, areaChartOptions)
                var lineChartData = $.extend(true, {}, areaLineData)
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
                //- DONUT CHART - MANUAL
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
                                {{DashboardHelper::historyCounter('enquiry-email',null,'manual', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('expedite-email',null,'manual', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('warning-email',null,'manual', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('penalty-email',null,'manual', date('Y'), date('m'))}}
                            ],
                            backgroundColor : ['#00c0ef', '#00a65a', '#f39c12', '#f56954'],
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
                //- DONUT CHART - AUTOMATED
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChartManual').get(0).getContext('2d')
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
                                {{DashboardHelper::historyCounter('enquiry-email',null,'automation', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('expedite-email',null,'automation', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('warning-email',null,'automation', date('Y'), date('m'))}},
                                {{DashboardHelper::historyCounter('penalty-email',null,'automation', date('Y'), date('m'))}}
                            ],
                            backgroundColor : ['#00c0ef', '#00a65a', '#f39c12', '#f56954'],
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
                var barChartData = $.extend(true, {}, areaLineData)
                var temp0 = areaLineData.datasets[0]
                var temp1 = areaLineData.datasets[1]
                var temp2 = areaLineData.datasets[2]
                var temp3 = areaLineData.datasets[3]
                barChartData.datasets[0] = temp0
                barChartData.datasets[1] = temp1
                barChartData.datasets[2] = temp2
                barChartData.datasets[3] = temp3

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
