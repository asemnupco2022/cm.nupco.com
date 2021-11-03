<div>

    @push('styles')
        <!-- daterange picker -->
            <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.css')}}">
        @endpush

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <br>

                        <div class="row yf_display_inline">
                                    <!-- put date filter insted of this comment -->
                            <div class="col-sm-8 display-block">
                                <div class="form-inline">

                                    <div class="form-group input-group-sm">

                                        <select class="form-control select2 " style="width: 100%;" wire:model="searchable_col">
                                            @foreach($columns as $colKey => $column)
                                                <option value="{{$colKey}}" class="{{$colKey==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group input-group-sm">

                                        <select class="form-control select2 " style="width: 100%;" wire:model="searchable_operator">
                                            @foreach($operators as $operatorKey => $operator)
                                                <option value="{{$operatorKey}}"> {{ $operator }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search" wire:model.debounce.500ms="searchable_col_val">


                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default" wire:click="search_reset">
                                                <i class="fas fa-sync"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-4 button_pos">
                                <button type="button" class="btn btn-primary btn-sm fill_org_btn" data-toggle="modal" data-target="#modal-primary">
                                    Select Columns
                                </button>

                                <button type="button" class="btn btn-warning btn-sm flat btn-sm" wire:click="export_data('PDF')" >
                                    DOWNLOAD PDF
                                </button>

                                <button type="button" class="btn btn-warning btn-sm flat btn-sm" wire:click="export_data('EXCEL')" >
                                    DOWNLOAD Excel
                                </button>


                            </div>

                        </div>



                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                @foreach($columns as $colKey => $column)
                                    <th class="{{$column==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }} {{$colKey=='supply_ratio'?'%':''}}</th>
                                @endforeach

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($collections as $key => $collection)
                                <tr>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'customer_name' )==false?'hide':''}}" >{{$collection->customer_name}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'tender_desc' )==false?'hide':''}}" >{{$collection->tender_desc}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'tender_no' )==false?'hide':''}}" >{{$collection->tender_no}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'count_of_items' )==false?'hide':''}}" >{{$collection->count_of_items}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'count_of_line' )==false?'hide':''}}" >{{$collection->count_of_line}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'total_value' )==false?'hide':''}}" >{{ round($collection->total_value,2)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'delivered_value' )==false?'hide':''}}" >{{ round($collection->delivered_value,2)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'remaining_delivered_value' )==false?'hide':''}}" >{{ round($collection->remaining_delivered_value,2)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'supply_ratio' )==false?'hide':''}}" >{{ round($collection->supply_ratio,2)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'total_qty' )==false?'hide':''}}" >{{$collection->total_qty}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'delivered_qty' )==false?'hide':''}}" >{{$collection->delivered_qty}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'remaining_delivered_qty' )==false?'hide':''}}" >{{$collection->remaining_delivered_qty}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_number' )==false?'hide':''}}" >{{$collection->po_number}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'nupco_delivery_date' )==false?'hide':''}}" >{{$collection->nupco_delivery_date}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'storage_location' )==false?'hide':''}}" >{{$collection->storage_location}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'plant' )==false?'hide':''}}" >{{$collection->plant}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_code' )==false?'hide':''}}" >{{$collection->vendor_code}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'customer_no' )==false?'hide':''}}" >{{$collection->customer_no}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        @if($collections)
                        <span class="right badge badge-danger row-count-badge">{{ $collections->total()}}</span>
                        @endif
                        <ul class="pagination pagination-sm m-0 float-right">
                            @if($collections)
                            {{$collections->links()}}
                            @endif
                        </ul>
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>




        {{--    ==============  =====--}}


        <div class="modal fade" id="modal-primary"  wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h4 class="modal-title">Select Columns</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                @foreach($columns as $colKey => $column)
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id=" {{$colKey}}" {{$column==false?'':'checked'}} wire:model="columns.{{$colKey}}">
                                        <label for="checkboxPrimary3">
                                            {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}
                                        </label>
                                    </div> <br>
                                @endforeach


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        {{--    ===================--}}


        {{--    ============Extra Large Model=========--}}

        <div class="modal fade" id="modal-xl">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        @livewire('mail.compose-mail-component')
                    </div>
                    <div class="modal-footer justify-content-between">

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        {{--    =====================--}}

        <div class="loading" wire:loading >
            <div class='uil-ring-css' style='transform:scale(0.79);'>
                <div></div>
            </div>
        </div>

        @push('scripts')
        <!-- InputMask -->
            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/moment/moment.min.js')}}"></script>

        <!-- date-range-picker -->
            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.js')}}"></script>

            <script>
                $(document).ready(function () {
                    $('#reservation').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD'
                        }
                    })
                    $("#reservation").val('');
                })

                document.addEventListener('livewire:load', function () {

                    $('#reservation').on('apply.daterangepicker', function (e) {
                    @this.set('dateRangePicker', e.target.value);
                    });
                });

            </script>
        @endpush
    </div>



{{--
<div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>Customer Name </th>
                <th>Tender/RFQ Num-Tender desc</th>
                <th>Tender NO</th>
                <th>Count of items  </th>
                <th>Count of lines </th>
                <th>Total Value</th>
                <th>Delivered Value (GR Value)</th>
                <th>Remaining Delivered Value</th>
                <th>% Delivered Value</th>
                <th>Total Qty</th>
                <th>Delivered Qty</th>
                <th>Remaining Delivered Qty</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div> --}}
