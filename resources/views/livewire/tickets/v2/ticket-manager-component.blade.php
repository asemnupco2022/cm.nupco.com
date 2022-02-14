@push('styles')

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

        th{
            background-color: white;
        }
        </style>


    @endpush
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row yf_display_inline head_space">
                        <div class="col-sm-1">
                            <div class="form-group input-group-sm">
                                <select class="form-control  " style="width: 100%;" wire:model="number_of_rows">
                                    @foreach ($num_rows as $rowKey => $num_row)
                                        <option value="{{ $num_row }}"> {{ $num_row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5 inline_block pr-0"></div>
                        <div class="col-sm-6 display-block automation">
                            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right"
                                data-toggle="modal" data-target="#modal-primary">
                                Select Columns
                            </button>
                        </div>
                        <div class="download_btn">

                            <button type="button" class="btn btn-warning btn-sm flat btn-sm" data-toggle="modal"
                                data-target="#modal-filter-notification-history">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="submit" class="btn btn-warning btn-sm flat btn-sm"
                                title="Reset Current Filter" wire:click="search_reset">
                                <i class="fas fa-sync"></i>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 fixTableHead">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                @foreach ($columns as $colKey => $column)
                                    <th class="{{ $column == false ? 'hide' : '' }}"> {{ $colKey }}</th>
                                @endforeach

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($collections)
                                @foreach ($collections as $key => $collection)

                                    <tr>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Message Type') == false ? 'hide' : '' }}">
                                            {{ \App\Helpers\PoHelper::NormalizeColString($collection->message_type) }}
                                        </td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Tender Num') == false ? 'hide' : '' }}">
                                            {{ $collection->tender_num }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Vendor Num') == false ? 'hide' : '' }}">
                                            {{ $collection->vendor_num }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Vendor Name En') == false ? 'hide' : '' }}">
                                            {{ $collection->vendor_name_en }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Po Num') == false ? 'hide' : '' }}">
                                            {{ $collection->po_num }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Customer Name') == false ? 'hide' : '' }}">
                                            {{ $collection->customer_name }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Cust Code') == false ? 'hide' : '' }}">
                                            {{ $collection->cust_code }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Po Item Num') == false ? 'hide' : '' }}">
                                            {{ $collection->po_item_num }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Uom') == false ? 'hide' : '' }}">
                                            {{ $collection->uom }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Plant') == false ? 'hide' : '' }}">
                                            {{ $collection->plant }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Delivery Date') == false ? 'hide' : '' }}">
                                            {{ $collection->delivery_date }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Item Desc') == false ? 'hide' : '' }}">
                                            {{ $collection->item_desc }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Mat Num') == false ? 'hide' : '' }}">
                                            {{ $collection->mat_num }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Tender Desc') == false ? 'hide' : '' }}">
                                            {{ $collection->tender_desc }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Customer Po No') == false ? 'hide' : '' }}">
                                            {{ $collection->customer_po_no }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Customer Po Item') == false ? 'hide' : '' }}">
                                            {{ $collection->customer_po_item }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Importance') == false ? 'hide' : '' }}">
                                            {{ $collection->importance }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Delivery Address') == false ? 'hide' : '' }}">
                                            {{ $collection->delivery_address }}</td>
                                        <td
                                            class="{{ \Illuminate\Support\Arr::get($columns, 'Line Status') == false ? 'hide' : '' }}">
                                            {{ $collection->line_status }}</td>
                                        <td>
                                            <a
                                                href="{{ route('web.route.ticket.manager.chat', ['token' => base64_encode($collection->unique_line)]) }}"><i
                                                    class="fas fa-eye"></i></a>&nbsp;
                                            <span class="right badge badge-success"
                                                title="total coments">{{ $collection->AllTicketCount }}</span>&nbsp;
                                            <span class="right badge badge-danger"
                                                title="unread comments">{{ $collection->ReadTicketCount }}</span>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    @if ($collections)
                        <span class=" badge badge-danger row-count-badge">{{ $collections->total() }}</span>
                    @endif
                    <ul class="pagination pagination-sm m-0 float-right">

                        @if ($collections)
                            {{ $collections->links() }}
                        @endif
                    </ul>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>



    {{-- ==============  ===== --}}

    <div class="modal fade" id="modal-primary" wire:ignore.self>
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

                            @foreach ($columns as $colKey => $column)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id=" {{ $colKey }}"
                                        {{ $column == false ? '' : 'checked' }}
                                        wire:model="columns.{{ $colKey }}">
                                    <label for="checkboxPrimary3">
                                        {{ $colKey }}
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


    <div class="modal fade" id="modal-add-filter-lib">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('po.user-filters-component',['columns'=>$columns,'template_for_table'=>$tableType])
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal" id="modal-filter-notification-history" data-backdrop="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter Notification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @push('styles2')
                        <link rel="stylesheet"
                            href="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/daterangepicker/daterangepicker.css') }}">
                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
                        <link rel="stylesheet"
                            href="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
                        <link rel="stylesheet"
                            href="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/select2/css/select2.min.css') }}">
                    @endpush

                    @include('livewire.tickets.v2.filter.notification-history-filter-template')

                    @push('scripts2')

                        <script
                                                src="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
                        </script>
                        <script src="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/daterangepicker/daterangepicker.js') }}"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
                        <script src="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/moment/moment.min.js') }}"></script>
                        <script src="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/inputmask/jquery.inputmask.min.js') }}"></script>

                        <script>
                            $(document).ready(function() {

                                $('.selectpicker').selectpicker({
                                    liveSearchPlaceholder: 'Select Po Type'
                                });

                                var startnupco_delivery_date;
                                var endnupco_delivery_date;
                                $('#deliveryDate').daterangepicker({
                                        format: 'YYYY-MM-DD',
                                    },
                                    function(start, end) {
                                        startnupco_delivery_date = start;
                                        endnupco_delivery_date = end;

                                    }
                                );
                                $('#deliveryDate').val("");
                                $('#deliveryDate').change(function() {
                                    @this.set('delivery_address.from', startnupco_delivery_date.format('YYYY-MM-DD'));
                                    @this.set('delivery_address.to', endnupco_delivery_date.format('YYYY-MM-DD'));
                                })

                            });
                        </script>
                    @endpush
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- =================== --}}



    {{-- ============Extra Large Model========= --}}


    {{-- ============Extra Large Model========= --}}
    <!-- loader -->
    <div class="loading" wire:loading>
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <!-- loader -->

    @push('scripts')

        <script>
            Livewire.on('update-users-filter-template', event => {
                $('#modal-add-filter-lib').modal('hide');
            })
        </script>

    @endpush

    {{-- ===================== --}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
