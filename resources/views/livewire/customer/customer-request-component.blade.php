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


                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            @foreach($columns as $colKey => $column)
                                <th class="{{$column==false?'hide':''}}"> {{$colKey}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @if($collections)
                            @foreach($collections as $key => $collection)
                                <tr>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Customer Code' )==false?'hide':''}}" >{{$collection->customer_code}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Customer Name En' )==false?'hide':''}}" >{{$collection->customer_name_en}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Customer Name Ar' )==false?'hide':''}}" >{{$collection->customer_name_ar }}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Customer Email' )==false?'hide':''}}" >{!! $collection->customer_email !!} </td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Customer Phone' )==false?'hide':''}}" >{{$collection->customer_phone}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Region' )==false?'hide':''}}" >{{$collection->region}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'Tendor Description' )==false?'hide':''}}" >{{$collection->tendor_description}}</td>
                                    <td  class="{{\Illuminate\Support\Arr::get($columns, 'File Name' )==false?'hide':''}}" ><a href="{{$collection->file_path}}" target="_blank" >{{$collection->file_name}}</a> </td>
                                </tr>
                            @endforeach
                        @endif
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
            <!-- /.card -->
        </div>
    </div>



    {{--    =====================--}}

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
