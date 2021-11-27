<div>

@push('styles')
    <!-- daterange picker -->
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/summernote/summernote-bs4.min.css')}}">
        <style>

            .alert.alert-warning.alert-dismissible {
                font-size: 1rem;
            }

        </style>
        <style>
            .fixTableHead {
                overflow-y: auto;
                height: 600px;
            }
            .fixTableHead thead th {
                position: sticky;
                top: 0;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            thead.data-sticky-header tr th {
                background: #fff;
            }

            .ar-badge {
            color: #fff;
            background-color: #e37526 !important;
            border-color: #e37526 !important;
            box-shadow: none;
            font-weight: 400;
            padding: 3px;
        }
        </style>
    @endpush
    @if(!$initSearch)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    @if($json_data_to_string)
                        <div class="row ">
                            <div class="col-md">
                                <div class="alert alert-warning alert-dismissible flat">
                                    <i class="icon fas fa-info-circle"></i>
                                    {!! $json_data_to_string !!}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                    <br>

                    <div class="row yf_display_inline">

                        <div class="col-sm-1">
                            <div class="form-group input-group-sm">
                                <select class="form-control select2 " style="width: 100%;" wire:model="number_of_rows" >
                                    @foreach($num_rows as $rowKey => $num_row)
                                        <option value="{{$num_row}}" > {{ $num_row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 inline_block pr-0">
                            <div class="form-inline">

                                <div class="form-group input-group-sm">

                                    <select class="form-control select2 " style="width: 100%;" wire:model.defer="searchable_col" title="Select Search Column">
                                        @foreach($columnsNormalized as $colKey => $column)
                                            <option value="{{$colKey}}" class="{{$colKey==false?'hide':''}}"> {{ $colKey }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-inline">
                                <div class="form-group input-group-sm">

                                    <select class="form-control select2 " style="width: 100%;" wire:model.defer="searchable_operator"  title="Select Search Operator">
                                        @foreach($operators as $operatorKey => $operator)
                                            <option value="{{$operatorKey}}"> {{ $operator }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-inline">
                                <div class="input-group input-group-sm" >
                                    <input type="text" name="table_search" class="form-control float-right" title="Search String"
                                           placeholder="Search" wire:model.defer="searchable_col_val">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default text-capitalize" wire:click="search_enter" title="search">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="input-group input-group-sm" >
                                <select class="form-control float-right" title="Select Preset Filter" wire:model.defer="getFilterTemplate">
                                    <option value="" selected disabled>Please Select Filter Template</option>
                                    @if($userFilterTemplates)
                                        @foreach($userFilterTemplates as $userFilterTemplate)
                                            <option value="{{$userFilterTemplate->id}}">{{$userFilterTemplate->template_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default text-capitalize" wire:click="search_enter" title="search">
                                        <i class="fas fa-search"></i>
                                    </button>

                                    <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                    <button type="submit" class="btn btn-default text-capitalize"  title="Reset Current Filter"  data-toggle="modal" data-target="#modal-add-filter-lib">
                                        <i class="fas fa-folder-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 text-right">
                            <button type="button" class="btn btn-success btn-sm flat btn-sm" data-toggle="modal" data-target="#modal-primary">
                                Select Columns
                            </button>
                        </div>
                        <div class="download_btn">
                            <button type="button" class="btn btn-warning btn-sm flat btn-sm" data-toggle="modal" data-target="#modal-filter-sap-po">
                                <i class="fas fa-filter"></i>
                              </button>
                              <button type="submit" class="btn btn-warning btn-sm flat btn-sm"  title="Reset Current Filter" wire:click="search_reset">
                                <i class="fas fa-sync"></i>
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
                <div class="card-body table-responsive p-0 fixTableHead">
                    <table class="table table-hover text-nowrap sap-report-table">
                        <thead class="data-sticky-header">
                        <tr>
                            <th>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" autocomplete="off" wire:model="selectAll">
                                </div>
                            </th>
                            @foreach($columnsNormalized as $colKey => $column)
                                <th class="{{$column==false?'hide':''}}"> {{ $colKey  }}</th>
                            @endforeach
                            <th>Internal</th>
                            <th>Vendor</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($collections as $key => $collection)
                        {{-- @dd($collection) --}}
                            <tr>
                                <td>
                                    <div class="icheck-primary d-inline">
                                        <input class="sleectALlClass" autocomplete="off" type="checkbox" wire:key="{{ $collection->id}}" wire:model.defer="selectedPo.{{$collection->id}}">
                                    </div>
                                </td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'notified' )==false?'hide':''}}" ><span class=" badge badge-info ar-badge">{{$collection->notified}}</span></td>
                                {{-- <td  class="{{\Illuminate\Support\Arr::get($columns, 'asn' )==false?'hide':''}}" wire:click="show_asan_info_modal({{$collection->po_number}},{{$collection->po_item}})"><span class=" badge badge-info ar-badge">{{$collection->asn}}</span></td> --}}
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'document_type' )==false?'hide':''}}" >{{$collection->document_type}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'document_type_desc' )==false?'hide':''}}" >{{$collection->document_type_desc}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_number' )==false?'hide':''}}" >{{$collection->po_number}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_item' )==false?'hide':''}}" >{{$collection->po_item}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'material_number' )==false?'hide':''}}" >{{$collection->material_number}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'mat_description' )==false?'hide':''}}" >{{$collection->mat_description}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'po_created_on' )==false?'hide':''}}" >{{$collection->po_created_on}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'purchasing_organization' )==false?'hide':''}}" >{{$collection->purchasing_organization}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'purchasing_group' )==false?'hide':''}}" >{{$collection->purchasing_group}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'currency' )==false?'hide':''}}" >{{$collection->currency}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'customer_no' )==false?'hide':''}}" >{{$collection->customer_no}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'customer_name' )==false?'hide':''}}" >{{$collection->customer_name}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'tender_no' )==false?'hide':''}}" >{{$collection->tender_no}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'tender_desc' )==false?'hide':''}}" >{{$collection->tender_desc}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_code' )==false?'hide':''}}" >{{$collection->vendor_code}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_name_en' )==false?'hide':''}}" >{{$collection->vendor_name_en}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'vendor_name_er' )==false?'hide':''}}" >{{$collection->vendor_name_er}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'plant' )==false?'hide':''}}" >{{$collection->plant}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'storage_location' )==false?'hide':''}}" >{{$collection->storage_location}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'uo_m' )==false?'hide':''}}" >{{$collection->uo_m}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'net_price' )==false?'hide':''}}" >{{$collection->net_price}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'price_unit' )==false?'hide':''}}" >{{$collection->price_unit}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'net_value' )==false?'hide':''}}" >{{$collection->net_value}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'nupco_trade_code' )==false?'hide':''}}" >{{$collection->nupco_trade_code}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'nupco_delivery_date' )==false?'hide':''}}" >{{$collection->nupco_delivery_date}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'ordered_quantity' )==false?'hide':''}}" >{{$collection->ordered_quantity}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'open_quantity' )==false?'hide':''}}" >{{$collection->open_quantity}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'item_status' )==false?'hide':''}}" >{{$collection->item_status}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'delivery_address' )==false?'hide':''}}" >{{$collection->delivery_address}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'delivery_no' )==false?'hide':''}}" >{{$collection->delivery_no}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'cust_cont_trade_numb' )==false?'hide':''}}" >{{$collection->cust_cont_trade_numb}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'cust_gen_code' )==false?'hide':''}}" >{{$collection->cust_gen_code}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'generic_mat_code' )==false?'hide':''}}" >{{$collection->generic_mat_code}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'old_new_po_number' )==false?'hide':''}}" >{{$collection->old_new_po_number}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'old_po_item' )==false?'hide':''}}" >{{$collection->old_po_item}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'gr_quantity' )==false?'hide':''}}" >{{$collection->gr_quantity}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'gr_amount' )==false?'hide':''}}" >{{$collection->gr_amount}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'supply_ratio' )==false?'hide':''}}" >{{$collection->supply_ratio}}</td>
                                <td  class="{{\Illuminate\Support\Arr::get($columns, 'supplier_comment' )==false?'hide':''}}" >{{$collection->supplier_comment}}</td>
                                <td>
                                    <a class="btn btn-app chat_po_btn" wire:click="open_comment_modal({{$collection->po_number }},{{$collection->po_item}},'sap_line_item')">
                                        <span class="badge bg-teal">{{$collection->InternalComentCount}}</span>
                                        <i class="far fa-comment-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-app chat_po_btn" wire:click="open_vendor_comment_modal({{$collection->po_number }},{{$collection->po_item}},'sap_line_item', '{{$collection->uniue_hash??"null" }}')">
                                        <span class="badge bg-teal bg-maroon">{{$collection->VendorlComentCount}}</span>
                                        <i class="far fa-comment-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    @if($collections)
                    <span class=" badge badge-danger row-count-badge">{{ $collections->total()}}</span>
                    @endif
                    <ul class="pagination pagination-sm m-0 float-right">

                        @if($collections)
                        {{$collections->links()}}
                        @endif
                    </ul>
                </div>

            </div>
            @if(auth()->user()->hasAnyPermission(['who_can-send_notification']))
            <button class="btn btn-success flat text-capitalize" wire:click="emitMailComposerReq('enquiry-email')"><i class="fas fa-envelope"></i> Warning Letter</button>
            <button class="btn btn-info flat text-capitalize" wire:click="emitMailComposerReq('expedite-email')"><i class="fas fa-envelope" ></i> Reminder Letter</button>
            @endif

            <!-- /.card -->
        </div>
    </div>






    {{--    ===================--}}


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
                            @foreach($columnsNormalized as $colKey => $column)

                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id=" {{$colKey}}" {{$column==false?'':'checked'}} wire:model="columns.{{$colKey}}">
                                    <label for="checkboxPrimary3">
                                        {{ $colKey  }}
                                    </label>
                                </div> <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" wire:click="save_staff_col_set">Save</button>
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- =================== --}}


    {{-- ============Extra Large Model========= --}}

        <div class="modal fade" id="modal-xl"  >
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




    <div class="modal fade" id="modal-add-filter-lib"  >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    {{-- @livewire('po.user-filters-component',['columns'=>$columns,'template_for_table'=>$tableType]) --}}
                    @livewire('filters.advance-filter-component')
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-open-edit-internal-comment"  >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('internals.show-comment-component')
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-open-edit-vendor-comment"  >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('tickets.vendor-chat-component')
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal" id="modal-filter-sap-po" data-backdrop="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter SAP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                <div class="modal-body">


                    @push('styles2')

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
                    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
                    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">
                    @endpush

                    @include('sap-filter-tmp-new')

                    @push('scripts2')
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
                    
                    <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/inputmask/jquery.inputmask.min.js')}}"></script>
                    <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

                    <script>
                        $('.selectpicker').selectpicker(
                            {
                                liveSearchPlaceholder: 'Select Po Type'
                            }
                        );


                        $('#numberbox').keyup(function(){
                            if ($(this).val() > 100){
                                alert("No numbers above 100");
                                $(this).val('100');
                            }
                        });


                    $(document).ready(function() {

                        var startpo_created_on;
                                var endpo_created_on;
                                $('#createDate').daterangepicker(
                            {
                                format: 'YYYY-MM-DD',
                            },
                            function(start, end) {
                                startpo_created_on = start;
                                endpo_created_on = end;

                            }
                            );
                                $('#createDate').val("");
                                $('#createDate').change(function () {
                                    @this.set('po_created_on.from', startpo_created_on.format('YYYY-MM-DD'));
                                    @this.set('po_created_on.to', endpo_created_on.format('YYYY-MM-DD'));

                                })




                                var startnupco_delivery_date;
                                var endnupco_delivery_date;
                                $('#deliveryDate').daterangepicker(
                            {
                                format: 'YYYY-MM-DD',
                            },
                            function(start, end) {
                                startnupco_delivery_date = start;
                                endnupco_delivery_date = end;

                            }
                            );
                                $('#deliveryDate').val("");
                                $('#deliveryDate').change(function () {
                                    @this.set('nupco_delivery_date.from', startnupco_delivery_date.format('YYYY-MM-DD'));
                                    @this.set('nupco_delivery_date.to', endnupco_delivery_date.format('YYYY-MM-DD'));
                                })

                    });
                    </script>
                    @endpush
                    {{-- @include('livewire.po.sap-filter-template') --}}

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal" id="modal-asn-info">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">ASN Information   @if ($asnJson and !empty($asnJson)) <span class=" badge badge-info ar-badge">{{$asnJson->asn}}</span> @endif</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                <div class="modal-body">
                    @if ($asnJson and $asnJson->asn_json and !empty($asnJson))
                        <table  class="text-center">
                            @foreach (json_decode($asnJson->asn_json) as $asnKey => $asnValue )
                            <tr>
                                <th>{{$asnKey}}</th>
                                <td>{{$asnValue}}</td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                    <h4 class="text-center">NO ASN FOUND</h4>
                    @endif

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



@endif





        <!-- loader -->
        <div class="loading" wire:loading >
            <div class='uil-ring-css' style='transform:scale(0.79);'>
                <div></div>
            </div>
        </div>
        <!-- loader -->

    @push('scripts')
  <!-- loaderloader -->
        <script>
            window.addEventListener('jq-confirm-alert', event => {

                $.alert({
                    title: 'Alert!',
                    content: event.detail.message,
                });
            })


            window.addEventListener('open-mail-composer', event => {
                $('#modal-xl').modal('show');
            })
            window.addEventListener('close-mail-composer', event => {
                $('#modal-xl').modal('hide');
            })


            window.addEventListener('modal-asn-info-open', event => {
                $('#modal-asn-info').modal('show');
            })

            Livewire.on('update-users-filter-template', event => {
                $('#modal-add-filter-lib').modal('hide');
            })
            Livewire.on('open-edit-internal-comment', event => {
                $('#modal-open-edit-internal-comment').modal('show');
            })

            Livewire.on('open-edit-vendor-comment', event => {
                $('#modal-open-edit-vendor-comment').modal('show');
            })
            window.addEventListener('close-edit-vendor-comment', event => {

                $('body').removeClass('modal-open');
                $('#modal-open-edit-vendor-comment').modal('hide');
            })

        </script>

        <!-- date-range-picker -->
        <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.js')}}"></script>

        <script>
            $(document).ready(function () {
                $('#reservation').daterangepicker();
            })


            $('#sleectALlClass').click(function(){

                if($(this).prop("checked") == true){
                    $(".sleectALlClass").attr("checked",true);
                }
                else if($(this).prop("checked") == false){
                    $('.sleectALlClass').attr("checked",false);
                }
            });
        </script>

<script src=" {{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    document.addEventListener('livewire:load', function () {
        $('#compose_textarea').summernote({
            height: 350,
            codemirror: {
                theme: 'monokai'
            },
            callbacks: {
                onChange: function(contents, $editable) {
                @this.set('mail_content', contents, $editable);
                }
            }
        });
    });
    Livewire.on('set-mail-content', mail_contents => {

        $('#compose_textarea').summernote('code',mail_contents);
    })
</script>



@endpush



    @stack('livewire-parent')

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
