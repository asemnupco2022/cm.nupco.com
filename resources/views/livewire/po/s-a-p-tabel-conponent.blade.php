<div>

@push('styles')
    <!-- daterange picker -->
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.css')}}">
    @endpush
    @if(!$initSearch)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <br>

                    <div class="row yf_display_inline">
{{--                        <div class="col-sm-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="input-group input-group-sm">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                      <span class="input-group-text">--}}
{{--                                        <i class="far fa-calendar-alt"></i>--}}
{{--                                      </span>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" class="form-control float-left" id="reservation" autocomplete="off" >--}}
{{--                                    <input wire:model.lazy="dateRangePicker" type="hidden" id="startTime"  class="form-control" name="startDate" readonly>--}}
{{--                                </div>--}}
{{--                                <!-- /.input group -->--}}
{{--                            </div>--}}
{{--                        </div>--}}

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

                        </div>

                    </div>



                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            @foreach($columns as $colKey => $column)
                                <th class="{{$column==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</th>
                            @endforeach
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($collections as $key => $collection)
                            <tr>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_type' )==false?'hide':''}}" >{{$collection->po_type}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_type_description' )==false?'hide':''}}" >{{$collection->po_type_description}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'pur_group' )==false?'hide':''}}" >{{$collection->pur_group}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'tender_no' )==false?'hide':''}}" >{{$collection->tender_no}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'purchasing_document' )==false?'hide':''}}" >{{$collection->purchasing_document}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'customer_name' )==false?'hide':''}}" >{{$collection->customer_name}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_code' )==false?'hide':''}}" >{{$collection->vendor_code}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_name' )==false?'hide':''}}" >{{$collection->vendor_name}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'Ordered_quantity' )==false?'hide':''}}" >{{$collection->Ordered_quantity}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'pending_qty' )==false?'hide':''}}" >{{$collection->pending_qty}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'total_recived_qty' )==false?'hide':''}}" >{{$collection->total_recived_qty}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'order_total' )==false?'hide':''}}" >{{number_format($collection->order_total, 2)}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'gr_amount' )==false?'hide':''}}" >{{number_format($collection->gr_amount,2)}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'trade_date' )==false?'hide':''}}" >{{$collection->trade_date}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'storage_location' )==false?'hide':''}}" >{{$collection->storage_location}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'delivery_address' )==false?'hide':''}}" >{{$collection->delivery_address}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'contract_item_no' )==false?'hide':''}}" >{{$collection->contract_item_no}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'plant' )==false?'hide':''}}" >{{$collection->plant}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'generic_mat_code' )==false?'hide':''}}" >{{$collection->generic_mat_code}}</td>
                                <td><a href="{{route('web.route.po.SAPTableLineItem',['slug'=>base64_encode($collection->purchasing_document)])}}"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{$collections->links()}}
                    </ul>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
@endif

    {{--    +++++++++ PRE FILTER ++++++++++++--}}
    @if($initSearch)
    <div class="row" >
        <div class="col-md-12">
            <h3>Purchase Order (PO) Status Report</h3>
        </div>
        <div class="col-md-12">

                <div class="card-body">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                        <tr>
                            <td>Tender No</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tendor" wire:model="initTenderNo.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tendor"  wire:model="initTenderNo.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Purchasing Document	</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="vendor" wire:model="initPurchaseNo.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="vendor" wire:model="initPurchaseNo.to"  >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Vendor Code	</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="document" wire:model="iniVendorNo.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="document"  wire:model="iniVendorNo.to">
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Ordered Quantity</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="0rganization" wire:model="initOrderQty.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="organization"  wire:model="initOrderQty.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Pending Qty</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Group" wire:model="initPendQty.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Group" wire:model="initPendQty.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Total Recived Qty</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Purchasing_doc" wire:model="initTotaRecelQty.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Purchasing_doc" wire:model="initTotaRecelQty.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Order Total</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Customer_no" wire:model="initTotalQty.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Customer_no" wire:model="initTotalQty.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>


                        <tr>
                            <td>Gr Amount</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="initGrAmt.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="initGrAmt.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>Trade Date</td>
                            <td>
                                <div class="form-group">
                                    <input type="date" class="form-control Deliver_Date" id="Deliver_Date" data-date-format="YYYY-MM-DD" wire:model="initTradeDate.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="date" class="form-control Deliver_Date" id="Deliver_Date" data-date-format="YYYY-MM-DD" wire:model="initTradeDate.to" >
                                </div>
                            </td>
{{--                            <td><button type="button" class="btn btn-primary" ><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>


{{--                        =====================================--}}



                        <tr>
                            <td>{{ \App\Helpers\PoHelper::NormalizeColString('storage_location')  }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="storage_location.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="storage_location.to" >
                                </div>
                            </td>
                            {{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>


                        <tr>
                            <td>{{ \App\Helpers\PoHelper::NormalizeColString('delivery_address')  }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="delivery_address.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="delivery_address.to" >
                                </div>
                            </td>
                            {{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>


                        <tr>
                            <td>{{ \App\Helpers\PoHelper::NormalizeColString('contract_item_no')  }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="contract_item_no.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="contract_item_no.to" >
                                </div>
                            </td>
                            {{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>


                        <tr>
                            <td>{{ \App\Helpers\PoHelper::NormalizeColString('plant')  }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="plant.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="plant.to" >
                                </div>
                            </td>
                            {{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>

                        <tr>
                            <td>{{ \App\Helpers\PoHelper::NormalizeColString('generic_mat_code')  }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="generic_mat_code.from" >
                                </div>
                            </td>
                            <td>To</td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Name" wire:model="generic_mat_code.to" >
                                </div>
                            </td>
                            {{--                            <td><button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button></td>--}}
                        </tr>



                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" class="btn btn-primary" wire:click="initSearchFilter">Check Now</button>
                </div>


        </div>
    </div>
    @endif
    {{--    +++++++++ PRE FILTER ++++++++++++--}}

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
