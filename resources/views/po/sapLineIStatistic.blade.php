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
<!-- Content Header (Page header) -->
<div class="content-header custom-bread-crum">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Statistic</h1>
                {{-- <br> --}}
                {{-- <p>QUERY : "{{$collectionString}}"</p> --}}
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
                            <h3 class="Sky_blue_color">{{$statisticTable->total_shipments}}</h3>
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
                            <img src="{{URL('img/dashboard-1.png')}}">
                            <h3 class="orange_color">{{$statisticTable->late_contract}}</h3>
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
                            <h3 class="Sky_blue_color reduce_space">{{$statisticTable->net_order_value}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Net GR Amount</h6>
                        <div class="inner-icon">
                            <img src="{{URL('img/dashboard-3.png')}}">
                            <h3 class="Sky_blue_color">{{$statisticTable->gr_amount}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

          <!-- Small boxes (Stat box) -->
          <div class="row four-col-value">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Total Suppliers</h6>
                        <div class="inner-icon">
                            {{-- <img src="{{URL('img/dashboard-1.png')}}"> --}}
                            <h3 class="Sky_blue_color">{{$statisticTable->numberofsuppliers}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>Total Items</h6>
                        <div class="inner-icon">
                            <h3 class="Sky_blue_color">{{$statisticTable->numberofitems}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>GR Quantity</h6>
                        <div class="inner-icon">
                            {{-- <img src="{{URL('img/dashboard-2.png')}}"> --}}
                            <h3 class="Sky_blue_color reduce_space">{{$statisticTable->percentageofGRquantity}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h6>GR Ammount</h6>
                        <div class="inner-icon">
                            {{-- <img src="{{URL('img/dashboard-3.png')}}"> --}}
                            <h3 class="Sky_blue_color">{{$statisticTable->percentageofGamount}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-6">
                <!-- STACKED BAR CHART -->
                <div class="card card-primary" >
                    <div class="card-header" style="background-color: #393e5e">
                      <h3 class="card-title" >Supply Ratio</h3>
                    </div>
                    <div class="card-body">

                        <?php
                            $supTotal = $statisticTable->supply_0+$statisticTable->supply_1_to_25+$statisticTable->supply_26_to_50+$statisticTable->supply_51_to_75+$statisticTable->supply_76_to_98+$statisticTable->supply_99_to_100;
                            ?>
                     <div class="row">
                         <div class="col-md-4">
                             <table class="table">
                            <tr>
                               <th>Ratio</th>
                               <th>Value</th>
                               <th>%</th>
                            </tr>

                            <tr>
                               <td>0</td>
                               <td style="background-color: #f56954"  >{{$statisticTable->supply_0}}</td>
                               <td style="background-color: #f56954"  ><?php if($supTotal != 0){ echo number_format((float)($statisticTable->supply_0/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>

                            <tr>
                                <td>1-25</td>
                                <td style="background-color: #00a65a" >{{$statisticTable->supply_1_to_25}}</td>
                                <td style="background-color: #00a65a" ><?php if($supTotal != 0){echo number_format((float)($statisticTable->supply_1_to_25/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>

                            <tr>
                                <td>26-50</td>
                                <td style="background-color: #f39c12" >{{$statisticTable->supply_26_to_50}}</td>
                                <td style="background-color: #f39c12" ><?php if($supTotal != 0){echo number_format((float)($statisticTable->supply_26_to_50/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>51-75</td>
                                <td style="background-color: #00c0ef" >{{$statisticTable->supply_51_to_75}}</td>
                                <td style="background-color: #00c0ef" ><?php if($supTotal != 0){echo number_format((float)($statisticTable->supply_51_to_75/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>76-98</td>
                                <td style="background-color: #3c8dbc" >{{$statisticTable->supply_76_to_98}}</td>
                                <td style="background-color: #3c8dbc" ><?php if($supTotal != 0){echo number_format((float)($statisticTable->supply_76_to_98/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>99-100</td>
                                <td style="background-color: #d2d6de" >{{$statisticTable->supply_99_to_100}}</td>
                                <td style="background-color: #d2d6de" ><?php if($supTotal != 0){echo number_format((float)($statisticTable->supply_99_to_100/$supTotal*100), 2, '.', ''); }else{echo '0.00'; }?>%</td>
                            </tr>
                         </table></div>
                         <div class="col-md-8">
                            <canvas id="pieChart_supply_ratio" style="min-height: 340px; height: 340px; max-height: 340px; max-width: 100%;"></canvas>
                         </div>
                     </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                <!-- /.card -->
            </div>



            <div class="col-md-6">
                <!-- STACKED BAR CHART -->
                <div class="card card-primary" >
                    <div class="card-header" style="background-color: #393e5e">
                      <h3 class="card-title" >ASN Status</h3>
                    </div>
                    <div class="card-body">

                        <?php
                            $supTotalAsn = $statisticTable->asn_no+$statisticTable->asn_new+$statisticTable->asn_approved+$statisticTable->asn_rejected;
                            ?>
                     <div class="row">
                        <div class="col-md-8">
                            <canvas id="pieChart_asn_status" style="min-height: 340px; height: 340px; max-height: 340px; max-width: 100%;"></canvas>
                         </div>

                         <div class="col-md-4">
                             <table class="table">
                            <tr>
                               <th>Status</th>
                               <th>Value</th>
                               <th>%</th>
                            </tr>

                            <tr>
                               <td>No</td>
                               <td style="background-color: #f39c12"  >{{$statisticTable->asn_no}}</td>
                               <td style="background-color: #f39c12"  ><?php if($supTotalAsn != 0 ){echo number_format((float)($statisticTable->asn_no/$supTotalAsn*100), 2, '.', ''); }else{echo '0.00';}?>%</td>
                            </tr>

                            <tr>
                                <td>New</td>
                                <td style="background-color: #00c0ef" >{{$statisticTable->asn_new}}</td>
                                <td style="background-color: #00c0ef" ><?php if($supTotalAsn != 0 ){echo number_format((float)($statisticTable->asn_new/$supTotalAsn*100), 2, '.', ''); }else{echo '0.00';}?>%</td>
                            </tr>

                            <tr>
                                <td>Approved</td>
                                <td style="background-color: #3c8dbc" >{{$statisticTable->asn_approved}}</td>
                                <td style="background-color: #3c8dbc" ><?php if($supTotalAsn != 0 ){echo number_format((float)($statisticTable->asn_approved/$supTotalAsn*100), 2, '.', ''); }else{echo '0.00';}?>%</td>
                            </tr>
                            <tr>
                                <td>Rejected</td>
                                <td style="background-color: #d2d6de" >{{$statisticTable->asn_rejected}}</td>
                                <td style="background-color: #d2d6de" ><?php if($supTotalAsn != 0 ){echo number_format((float)($statisticTable->asn_rejected/$supTotalAsn*100), 2, '.', ''); }else{echo '0.00';}?>%</td>
                            </tr>
                         </table></div>

                     </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                <!-- /.card -->
            </div>



            <div class="col-md-12">
                <!-- STACKED BAR CHART -->
                <div class="card card-primary" >
                    <div class="card-header" style="background-color: #393e5e">
                      <h3 class="card-title" >Supplier Comments</h3>
                    </div>
                    <div class="card-body">

                        <?php
                            $supTotalSupComment =
                            $statisticTable->comment1+
                            $statisticTable->comment2+
                            $statisticTable->comment3+
                            $statisticTable->comment4+
                            $statisticTable->comment5+
                            $statisticTable->comment6+
                            $statisticTable->comment7+
                            $statisticTable->comment8+
                            $statisticTable->comment9+
                            $statisticTable->comment10;



                            ?>
                     <div class="row">
                        <div class="col-md-7">
                            <canvas id="pieChart_sup_comments" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                         </div>

                         <div class="col-md-5">
                             <table class="table" style="text-align: right">
                            <tr>
                               <th>Comment</th>
                               <th>Value</th>
                               <th>%</th>
                            </tr>

                            <tr>
                               <td>تم التوريد (يجب ارفاق مذكرة استلام)</td>
                               <td style="background-color: #916622"  >{{$statisticTable->comment1}}</td>
                               <td style="background-color: #916622"  ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment1/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>

                            <tr>
                                <td>سيتم التوريد (يجب تحديد التاريخ)</td>
                                <td style="background-color: #00c0ef" >{{$statisticTable->comment2}}</td>
                                <td style="background-color: #00c0ef" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment2/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>

                            <tr>
                                <td>رفض استلام من الجهة (يجب ارفاق الرفض)</td>
                                <td style="background-color: #3c8dbc" >{{$statisticTable->comment3}}</td>
                                <td style="background-color: #3c8dbc" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment3/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>توريد جزئي</td>
                                <td style="background-color: #d2d6de" >{{$statisticTable->comment4}}</td>
                                <td style="background-color: #d2d6de" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment4/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>(توريد جزئي حسب طلب الجهة (يجب ارفاق الطلب</td>
                                <td style="background-color: #0ed940" >{{$statisticTable->comment5}}</td>
                                <td style="background-color: #0ed940" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment5/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>اعتذار عن توريد البند (يجب ارفاق خطاب أسباب الاعتذار)</td>
                                <td style="background-color: #868a17" >{{$statisticTable->comment6}}</td>
                                <td style="background-color: #868a17" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment6/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>طلب خطاب تمديد/ فتح دفعة (يجب ارفاق الطلب)</td>
                                <td style="background-color: #0d03ed" >{{$statisticTable->comment7}}</td>
                                <td style="background-color: #0d03ed" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment7/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>طلب اذن استيراد (يجب ارفاق الطلب)</td>
                                <td style="background-color: #89f8d3" >{{$statisticTable->comment8}}</td>
                                <td style="background-color: #89f8d3" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment8/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>
                            <tr>
                                <td>الرد على خطاب الانذار</td>
                                <td style="background-color: #8b2755" >{{$statisticTable->comment9}}</td>
                                <td style="background-color: #8b2755" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment9/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr> <tr>
                                <td>أخرى</td>
                                <td style="background-color: #da8206" >{{$statisticTable->comment10}}</td>
                                <td style="background-color: #da8206" ><?php  if( $supTotalSupComment != 0){echo number_format((float)($statisticTable->comment10/$supTotalSupComment*100), 2, '.', ''); }else{ echo '0.00'; }?>%</td>
                            </tr>

                         </table></div>

                     </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                <!-- /.card -->
            </div>


        </div>

        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header" style="background-color: #393e5e">
                  <h3 class="card-title">Suppliers</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Vendor Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($vendorCollections)
                            @foreach ($vendorCollections as $vendorName => $vendorCode)
                                <tr>
                                    <td>{{$vendorCode}}</td>
                                    <td>{{$vendorName}}</td>
                                    <td>{{rifrocket\LaravelCms\Models\LbsMember::getByVendorCode($vendorCode, 'email')}}</td>
                                    <td>{{rifrocket\LaravelCms\Models\LbsMember::getByVendorCode($vendorCode, 'status')}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

{{--
            <div class="col-6">
                <div class="card card-primary">
                  <div class="card-header" style="background-color: #393e5e">
                    <h3 class="card-title">Suppliers</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Nupco Trade Code</th>
                          <th>Total Contracts</th>
                        </tr>
                      </thead>
                      <tbody>
                          @if($tradeCollections)
                              @foreach ($tradeCollections as $tradeCollectionKey=> $tradeCollection)
                                  <tr>
                                      <td>{{$tradeCollectionKey}}</td>
                                      <td><?php if($tradeCollection){count($tradeCollection);}?></td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div> --}}

          </div>


    </div><!-- /.container-fluid -->
</section>


@push('scripts')
<script>
    $(function () {


      //-------------
      //- PIE CHART - suplly ratio
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas_supply_ratio = $('#pieChart_supply_ratio').get(0).getContext('2d')

      var pieChart_supply_ratio        = {
      labels: [
          '0',
          '1-25',
          '26-50',
          '51-57',
          '76-98',
          '99-100',
      ],
      datasets: [
        {
          data: [{{$statisticTable->supply_0}},{{$statisticTable->supply_1_to_25}},{{$statisticTable->supply_26_to_50}},{{$statisticTable->supply_51_to_75}},{{$statisticTable->supply_76_to_98}},{{$statisticTable->supply_99_to_100}}],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }

      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas_supply_ratio, {
        type: 'pie',
        data: pieChart_supply_ratio,
        options: pieOptions
      })


            //-------------
      //- PIE CHART - asn status
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas_asn_status = $('#pieChart_asn_status').get(0).getContext('2d')

      var pieChart_asn_status   = {
      labels: [
          'No',
          'New',
          'Approved',
          'Rejected',
      ],
      datasets: [
        {
          data: [{{$statisticTable->asn_no}},{{$statisticTable->asn_new}},{{$statisticTable->asn_approved}},{{$statisticTable->asn_rejected}}],
          backgroundColor : ['#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }

      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas_asn_status, {
        type: 'pie',
        data: pieChart_asn_status,
        options: pieOptions
      })


                  //-------------
      //- PIE CHART - supplier comments
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas_sup_comments = $('#pieChart_sup_comments').get(0).getContext('2d')

      var pieChart_sup_comments   = {
    //   labels: [
    //     'تم التوريد (يجب ارفاق مذكرة استلام)' ,
    //     'سيتم التوريد (يجب تحديد التاريخ)' ,
    //     'رفض استلام من الجهة (يجب ارفاق الرفض)' ,
    //     'توريد جزئي' ,
    //     'توريد جزئي حسب طلب الجهة (يجب ارفاق الطلب)' ,
    //     'اعتذار عن توريد البند (يجب ارفاق خطاب أسباب الاعتذار)' ,
    //     'طلب خطاب تمديد/ فتح دفعة (يجب ارفاق الطلب)' ,
    //     'طلب اذن استيراد (يجب ارفاق الطلب)' ,
    //     'الرد على خطاب الانذار' ,
    //     'أخرى' ,
    //   ],
      datasets: [
        {
          data: [
              {{$statisticTable->comment1}},
              {{$statisticTable->comment2}},
              {{$statisticTable->comment3}},
              {{$statisticTable->comment4}},
              {{$statisticTable->comment5}},
              {{$statisticTable->comment6}},
              {{$statisticTable->comment7}},
              {{$statisticTable->comment8}},
              {{$statisticTable->comment9}},
              {{$statisticTable->comment10}},
            ],

          backgroundColor : ['#916622', '#00c0ef', '#3c8dbc','#d2d6de', '#0ed940', '#868a17', '#0d03ed', '#89f8d3','#8b2755', '#da8206'],
        }
      ]
    }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }

      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas_sup_comments, {
        type: 'pie',
        data: pieChart_sup_comments,
        options: pieOptions
      })


    })
  </script>
@endpush
@endsection
