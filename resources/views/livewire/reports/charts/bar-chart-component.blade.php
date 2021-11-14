<!-- STACKED BAR CHART -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Top 5 Customers By Order Value</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="stackedBarChart" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@push('scripts')

    <script>
        $(function () {


            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#stackedBarChart').get(0).getContext('2d')

            var areaChartData = {
                labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                        label               : 'Digital Goods',
                        backgroundColor     : '#1c2346',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label               : 'Electronics',
                        backgroundColor     : '#e6e6e6',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            }

            var stackedBarChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

// This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'bar',
                data: areaChartData,
                options: stackedBarChartOptions
            })


        }); // end am4core.ready()
    </script>
@endpush
