 <div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row yf_display_inline head_space">
                        <div class="col-sm-1">
                            <div class="form-group input-group-sm">
                                <select class="form-control  " style="width: 100%;" wire:model="number_of_rows" >
                                    @foreach($num_rows as $rowKey => $num_row)
                                        <option value="{{$num_row}}" > {{ $num_row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--                        <div class="col-sm-2">--}}
                        {{--                            <div class="form-inline">--}}
                        {{--                                <div class="form-group input-group-sm">--}}
                        {{--                                    <select class="form-control  " style="width: 13rem;" wire:model="selected_staff" title="Select Search Column">--}}
                        {{--                                        <option value="" selected disabled >Filter Staff</option>--}}
                        {{--                                        @foreach($staffs as $staff)--}}
                        {{--                                            <option value="{{$staff->id}}" > {{ \App\Helpers\PoHelper::NormalizeColString($staff->display_name)  }}</option>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </select>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="col-sm-3 inline_block pr-0">
                            <div class="form-inline">
                                <div class="form-group input-group-sm">
                                    <select class="form-control select2 " style="width: 100%;" wire:model="searchable_col" title="Select Search Column">
                                        @foreach($columns as $colKey => $column)
                                            <option value="{{$colKey}}" class="{{$colKey==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group input-group-sm">

                                    <select class="form-control select2 " style="width: 100%;" wire:model="searchable_operator"  title="Select Search Operator">
                                        @foreach($operators as $operatorKey => $operator)
                                            <option value="{{$operatorKey}}"> {{ $operator }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="table_search" class="form-control float-right" title="Search String"
                                           placeholder="Search" wire:model.debounce.500ms="searchable_col_val">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group input-group-sm" >
                                <select class="form-control float-right" title="Select Preset Filter" wire:model="getFilterTemplate">
                                    <option value="" selected disabled>Please Select Filter Template</option>
                                    @if($userFilterTemplates)
                                        @foreach($userFilterTemplates as $userFilterTemplate)
                                            <option value="{{$userFilterTemplate->id}}">{{$userFilterTemplate->template_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                    <button type="submit" class="btn btn-default text-capitalize"  title="Reset Current Filter"  data-toggle="modal" data-target="#modal-add-filter-lib">
                                        <i class="fas fa-folder-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 display-block automation">
                            <button type="button" class="btn btn-success btn-sm flat btn-sm" data-toggle="modal" data-target="#modal-primary">
                                Select Columns
                            </button>
                        </div>
                        <div class="download_btn">
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
                            <th>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" autocomplete="off" wire:model="selectAll">
                                </div>
                            </th>
                            @foreach($columns as $colKey => $column)
                                <th class="{{$column==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</th>
                            @endforeach

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($collections)
                            @foreach($collections as $key => $collection)
                                <tr>
                                    <td>
                                        <div class="icheck-primary d-inline " >
                                            <input class="sleectALlClass" autocomplete="off" type="checkbox" wire:key="{{ $key }}" wire:model="selectedPo.{{$collection->id }}">
                                        </div>
                                    </td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'broadcast_type' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->broadcast_type)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'mail_type' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->mail_type)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'table_type' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->table_type)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'sender_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->sender_name)}}</td>
                                    @if($collection->recipient_name)
                                        <td  class="{{\Illuminate\Support\Arr::get($columns, 'recipient_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->recipient_name)}}</td>
                                    @else
                                        <td  class="{{\Illuminate\Support\Arr::get($columns, 'recipient_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString('unknown recipient')}}</td>
                                    @endif
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'recipient_email' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->recipient_email)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'msg_subject' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->msg_subject)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'last_executed_at' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->last_executed_at)}}</td>
                                    <td>
                                        <a href="{{route('web.route.ticket.manager.chat',['token'=>base64_encode($collection->mail_ticket_hash )])}}"><i class="fas fa-eye"></i></a>&nbsp;
                                        <span class="right badge badge-success" title="total coments">{{$collection->AllTicketCount}}</span>&nbsp;
                                        <span class="right badge badge-danger" title="unread comments">{{$collection->ReadTicketCount}}</span>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
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


    <div class="modal fade" id="modal-add-filter-lib"  >
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

    {{--    ===================--}}



    {{--    ============Extra Large Model=========--}}


    {{--    ============Extra Large Model=========--}}


    @push('scripts')

        <script>
            Livewire.on('update-users-filter-template', event => {
                $('#modal-add-filter-lib').modal('hide');
            })
        </script>

    @endpush

    {{--    =====================--}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
