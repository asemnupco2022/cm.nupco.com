@push('styles')
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
@endpush
<div class="row">
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box dash_color1">
            <div class="inner">
                <h3>{{DashboardHelper::historyCounter('enquiry-email',1)}}</h3>
                <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('enquiry-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('enquiry-email',null,'manual',null,null)}}
                <p>Warning Email</p>
            </div>
            <div class="icon">
                <i class="ion ion-email"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-success dash_color2">
            <div class="inner">
                <h3>{{DashboardHelper::historyCounter('expedite-email',1)}}</h3>
                <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('expedite-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp;
                <i class="ion ion-person" title="manual"></i>  {{DashboardHelper::historyCounter('expedite-email',null,'manual',null,null)}}
                <p>Reminder Email</p>
            </div>
            <div class="icon">
                <i class="ion ion-email"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-warning dash_color3">
            <div class="inner">
                <h3>{{DashboardHelper::vendorComments()}}</h3>
                {{-- <i class="ion ion-ios-gear" title="automated"></i>  {{DashboardHelper::historyCounter('warning-email',null,'automation',null,null)}} &nbsp;&nbsp;&nbsp; --}}
                <i class="ion ion-person" title="manual"></i> {{DashboardHelper::vendorComments()}}
                <p>Vendor Response</p>
            </div>
            <div class="icon">
                <i class="ion ion-email"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->



</div>

<div class="row dashboard_style">
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

<div class="row dashboard_style">

    {{-- <!-- Item Delivery Status -->
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Delivery Summary Report</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @livewire('reports.deliver-sum-repo-component')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div> --}}


    <!-- Item Delivery Status -->
    {{-- <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Item Delivery Status</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @livewire('reports.item-delivery-status-component')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div> --}}


    <!-- SAP import Report -->
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PO Import Records</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @livewire('reports.po-import-repo-component')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

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
                        label               : 'Warning Email',
                        backgroundColor     : 'rgba(60, 141, 199, 1)',
                        borderColor         : 'rgba(60, 141, 199, 1)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [{!! DashboardHelper::lineChart('enquiry-email') !!}]
                    },
                    {
                        label               : 'Reminder Email',
                        backgroundColor     : 'rgba(137, 93, 148, 1)',
                        borderColor         : 'rgba(137, 93, 148, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(137, 93, 148, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [{!! DashboardHelper::lineChart('expedite-email') !!}]
                    },

                    // {
                    //     label               : 'Warning Email',
                    //     backgroundColor     : 'rgba(231, 142, 74, 1)',
                    //     borderColor         : 'rgba(231, 142, 74, 1)',
                    //     pointRadius         : false,
                    //     pointColor          : 'rgba(231, 142, 74, 1)',
                    //     pointStrokeColor    : '#c1c7d1',
                    //     pointHighlightFill  : '#fff',
                    //     pointHighlightStroke: 'rgba(220,220,220,1)',
                    //     data                : [{!! DashboardHelper::lineChart('warning-email') !!}]
                    // },

                    // {
                    //     label               : 'Penalty Email',
                    //     backgroundColor     : 'rgba(150, 49, 73, 1)',
                    //     borderColor         : 'rgba(150, 49, 73, 1)',
                    //     pointRadius         : false,
                    //     pointColor          : 'rgba(150, 49, 73, 1)',
                    //     pointStrokeColor    : '#c1c7d1',
                    //     pointHighlightFill  : '#fff',
                    //     pointHighlightStroke: 'rgba(220,220,220,1)',
                    //     data                : [{!! DashboardHelper::lineChart('penalty-email') !!}]
                    // },
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
            // lineChartData.datasets[2].fill = false;
            // lineChartData.datasets[3].fill = false;
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
                    'Warning Email',
                    'Reminder Email',
                    // 'Warning Email',
                    // 'Penalty Email',
                ],
                datasets: [
                    {
                        data: [
                            {{DashboardHelper::historyCounter('enquiry-email',null,'manual', date('Y'), date('m'))}},
                            {{DashboardHelper::historyCounter('expedite-email',null,'manual', date('Y'), date('m'))}},
                            // {{DashboardHelper::historyCounter('warning-email',null,'manual', date('Y'), date('m'))}},
                            // {{DashboardHelper::historyCounter('penalty-email',null,'manual', date('Y'), date('m'))}}
                        ],
                        backgroundColor : ['#3c8dc7', '#895d94'],
                        // backgroundColor : ['#3c8dc7', '#895d94', '#e78e4a', '#963149'],
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
                    'Warning Email',
                    'Reminder Email',
                    // 'Warning Email',
                    // 'Penalty Email',
                ],
                datasets: [
                    {
                        data: [
                            {{DashboardHelper::historyCounter('enquiry-email',null,'automation', date('Y'), date('m'))}},
                            {{DashboardHelper::historyCounter('expedite-email',null,'automation', date('Y'), date('m'))}},
                            // {{DashboardHelper::historyCounter('warning-email',null,'automation', date('Y'), date('m'))}},
                            // {{DashboardHelper::historyCounter('penalty-email',null,'automation', date('Y'), date('m'))}}
                        ],
                        backgroundColor : ['#3c8dc7', '#895d94'],
                        // backgroundColor : ['#3c8dc7', '#895d94', '#e78e4a', '#963149'],
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
            // var temp2 = areaLineData.datasets[2]
            // var temp3 = areaLineData.datasets[3]
            barChartData.datasets[0] = temp0
            barChartData.datasets[1] = temp1
            // barChartData.datasets[2] = temp2
            // barChartData.datasets[3] = temp3

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
