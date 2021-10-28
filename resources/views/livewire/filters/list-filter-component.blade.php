<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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

                        <div class="col-sm-2">
                            <div class="form-inline">
                                <div class="input-group input-group-sm">
                                    <select class="form-control select2 " style="width: 13rem;" wire:model="selected_bulk_action" title="Select bulk action">
                                        <option value="" selected disabled >Bulk Actions</option>
                                        @foreach($actions as $actionKey => $action)
                                            <option value="{{$actionKey}}" > {{ \App\Helpers\PoHelper::NormalizeColString($action)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-inline">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default text-capitalize" wire:click="bulk_action" title="Reset Current Filter">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-2">
                            <div class="form-inline">
                                <div class="form-group input-group-sm">
                                    <select class="form-control select2 " style="width: 13rem;" wire:model="selected_staff" title="Select Search Column">
                                        <option value="" selected disabled >Filter Staff</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}" > {{ \App\Helpers\PoHelper::NormalizeColString($staff->display_name)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="input-group input-group-sm"">
                                <input type="text" name="table_search" class="form-control float-right" title="Search String"
                                       placeholder="Search Template" wire:model.debounce.500ms="searchable_col_val">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset" title="Reset Current Filter">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 display-block">
                            <button type="button" class="btn btn-primary btn-sm flat btn-sm outline_org_btn" data-toggle="modal" data-target="#modal-primary">
                                Select Columns
                            </button>
                            <button class="btn btn-sm btn-success float-right flat fill_org_btn" data-toggle="modal" data-target="#select_table_to_create_filter"><i class="fas fa-plus"></i>  Create Filter</button>
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
                            <th >Action</th>

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
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'staff' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->User->display_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'template_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->template_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'template_for_table' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->template_for_table) }}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'query' )==false?'hide':''}}" >{!! $collection->json_to_string !!} </td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'status' )==false?'hide':''}}" >{{$collection->status}}</td>
                                    <td>
                                        <i class="fas fa-edit" style="cursor:pointer" title="edit" wire:click="editUsersTemplate({{$collection->id}})"></i>

{{--                                        <i class="fas fa-trash" style="cursor:pointer" title="delete" wire:click="updateModelStatus({{$collection->id}},'{{ LbsConstants::STATUS_DELETED}}',1)" onclick="confirm_before_delete({{$collection->id}},'{{ LbsConstants::STATUS_DELETED}}',1)"></i>--}}
                                        <i class="fas fa-trash" style="cursor:pointer" title="delete" onclick="confirm_before_delete()"></i>
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

    {{--    ===================--}}


    {{--    ============Extra Large Model=========--}}



    <div class="modal fade" id="edit_model"  >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('filters.edit-filter-component')
                </div>
                <div class="modal-footer justify-content-between">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




    <div class="modal fade" id="select_table_to_create_filter"  wire:ignore.self >
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Table</label>
                        <select class="form-control select2" style="width: 100%;" wire:model="selectedTemplateArray">
                            @if($templateArray)
                                <option value="" selected disabled>Please Chose A Table</option>
                                @foreach($templateArray as $temKey => $template)
                            <option value="{{$temKey}}">{{\App\Helpers\PoHelper::NormalizeColString($template)}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade"  id="_create_filter" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('po.user-filters-component',['columns'=>$create_for_cols,'template_for_table'=>$create_for_tableType])
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{--    ============Extra Large Model=========--}}


    @push('scripts')

        <script>
            function confirm_before_delete(id, txt, mode){
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure you wanna delete !',
                    buttons: {

                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn flat btn-success',
                            keys: ['enter', 'shift'],

                        },
                        somethingElse: {
                            text: 'Confirmed',
                            btnClass: 'btn flat btn-danger',
                            keys: ['enter', 'shift'],
                            action: function(){
                                @this.updateModelStatus(id,txt,mode);
                            }
                        }

                    }
                });
            }

        </script>
        <script>
            window.addEventListener('open-create-user-search-template', event => {

               $('#select_table_to_create_filter').modal('hide');
               $('#_create_filter').modal('show');

            });

            window.addEventListener('open-edit-user-search-template', event => {
                $('#edit_model').modal('show');
            });

            document.addEventListener('livewire:load', function () {
                $('#_create_filter').on('hidden.bs.modal', function () {
                @this.selectedTemplateArray = '';
                @this.create_for_tableType = '';
                @this.create_for_cols = '';

                })

                $('#edit_model').on('hidden.bs.modal', function () {
                @this.searchEngine();

                })
            });
        </script>
    @endpush

    {{--    =====================--}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
