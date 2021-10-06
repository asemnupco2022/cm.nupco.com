<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group input-group-sm">
                                <select class="form-control  " style="width: 100%;" wire:model="number_of_rows" >
                                    @foreach($num_rows as $rowKey => $num_row)
                                        <option value="{{$num_row}}" > {{ $num_row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-sm-2">
                            <div class="form-inline">
                                <div class="form-group input-group-sm">
                                    <select class="form-control  " style="width: 13rem;" wire:model="selected_staff" title="Select Search Column">
                                        <option value="" selected disabled >Filter Staff</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}" > {{ \App\Helpers\PoHelper::NormalizeColString($staff->display_name)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control float-right" title="Search String"
                                       placeholder="Search Template" wire:model.debounce.500ms="searchable_col_val">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

{{--                        <div class="col-sm-2 ">--}}
{{--                            <button type="button" class="btn btn-primary btn-sm flat btn-sm" data-toggle="modal" data-target="#modal-primary">--}}
{{--                                Select Columns--}}
{{--                            </button>--}}
{{--                        </div>--}}

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


                        </tr>
                        </thead>
                        <tbody>
                        @if($collections)
                            @foreach($collections as $key => $collection)
                                <tr>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'sender_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->sender_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'recipient_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->recipient_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'table_type' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->table_type)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'msg_subject' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->msg_subject)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'last_executed_at' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->last_executed_at)}}</td>
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

    {{--    ===================--}}



    {{--    ============Extra Large Model=========--}}


    {{--    ============Extra Large Model=========--}}


    @push('scripts')

    @endpush

    {{--    =====================--}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
