<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row yf_display_inline">
                        <div class="col-sm-1">
                            <div class="form-group input-group-sm">
                                <select class="form-control  " style="width: 100%;" wire:model="number_of_rows" >
                                    @foreach($num_rows as $rowKey => $num_row)
                                        <option value="{{$num_row}}" > {{ $num_row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-inline">
                                <div class="input-group input-group-sm" >
                                    <select class="form-control  " style="width: 13rem;" wire:model="selected_bulk_action" title="Select bulk action">
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
                                <div class="input-group input-group-sm" >
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default text-capitalize" wire:click="bulk_action" title="Reset Current Filter">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="input-group input-group-sm">
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
                            <button class="btn btn-sm btn-success float-right flat text-capitalize" data-toggle="modal" data-target="#_create_filter"><i class="fas fa-plus "></i>  add staff</button>
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
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'first_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->first_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'last_name' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->last_name)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'username' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->username)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'employee_num' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->employee_num)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'email' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->email)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'role' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->role)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'phone' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->phone)}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'permissions' )==false?'hide':''}}" >{{\App\Helpers\PoHelper::NormalizeColString($collection->getPermissionDisplayNames())}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'status' )==false?'hide':''}}" >
                                        <?php if($collection->status =='suspended'){ echo 'Deleted'; } else { echo \App\Helpers\PoHelper::NormalizeColString($collection->status); }?>
                                    <td>
                                        @if ($collection->status !='suspended')
                                        <i class="fas fa-trash" style="cursor:pointer" title="delete" wire:click="updateModelStatus({{$collection->id}},'{{ LbsConstants::STATUS_DELETED}}',1)"></i>&nbsp;&nbsp;&nbsp;
                                        @endif
                                        <i class="fas fa-edit" style="cursor:pointer" title="delete" wire:click="editStaff({{$collection->id}})"></i>
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

  <!-- loader -->
  <div class="loading" wire:loading>
    <div class='uil-ring-css' style='transform:scale(0.79);'>
        <div></div>
    </div>
</div>
<!-- loader -->

    {{--    ============Extra Large Model=========--}}


    <div class="modal fade"  id="_create_filter" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('staffs.create-staff-component')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal fade" id="modal_show_edit_staff">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('staffs.edit-staff-component')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{--    ============Extra Large Model=========--}}
    <script>
        window.addEventListener('update-staff-data', event => {
            $("#modal_show_edit_staff").modal('show');
        })
    </script>
    {{--    =====================--}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
