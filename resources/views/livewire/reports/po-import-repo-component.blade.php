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

                                        <select class="form-control select2 " style="width: 100%;" wire:model.defer="searchable_col">
                                            @foreach($columns as $colKey => $column)
                                                <option value="{{$colKey}}" class="{{$colKey==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group input-group-sm">

                                        <select class="form-control select2 " style="width: 100%;" wire:model.defer="searchable_operator">
                                            @foreach($operators as $operatorKey => $operator)
                                                <option value="{{$operatorKey}}"> {{ $operator }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search" wire:model.defer="searchable_col_val">


                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default text-capitalize" wire:click="search_enter" title="search">
                                                <i class="fas fa-search"></i>
                                            </button>
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

                                {{-- <button type="button" class="btn btn-warning btn-sm flat btn-sm" wire:click="export_data('PDF')" >
                                    DOWNLOAD PDF
                                </button> --}}

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
                                    <th class="{{$column==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }} </th>
                                @endforeach

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($collections as $key => $collection)
                                <tr>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'table_type' )==false?'hide':''}}" >{{ \App\Helpers\PoHelper::NormalizeColString($collection->table_type)  }}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'path' )==false?'hide':''}}" >{{$collection->path}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'total_records' )==false?'hide':''}}" >{{$collection->total_records}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'total_ex_records' )==false?'hide':''}}" >{{$collection->total_ex_records  }}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'start_time' )==false?'hide':''}}" >{{ $collection->start_time}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'end_time' )==false?'hide':''}}" >{{$collection->end_time}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'created_at' )==false?'hide':''}}" >{{$collection->created_at}}</td>

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



