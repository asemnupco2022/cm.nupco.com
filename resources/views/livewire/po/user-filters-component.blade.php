@push('styles')

@endpush
<div>

    <div class="card card-primary card-outline yf_card_width">
        <div class="yf_card_width">
        <div class="card-header ">
            <div style="display: contents;">

                <h3 class="card-title">Create Filter Template</h3>
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Filter Name*</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Template Name" wire:model.debounce.500ms="templateName">
                        @error('templateName') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            @foreach ($templateLoops as $TmpKey => $templateLoop)
            <div class="row" wire:key="{{ $TmpKey }}">
                <div class="col-md-12 yf_full_w">
                    <div class="form-inline">
                        <div class="form-group input-group-sm col-md-4">
                            <select class="form-control select2 " style="width: 100%;"  wire:model.debounce.500ms="queryCol.{{ $TmpKey }}" title="Select Search Column">
                                <option value="" selected disabled>Select Search Column</option>
                                @if($columns)
                                    @foreach($columns as $colKey => $column)
                                        <option value="{{$colKey}}" class="{{$colKey==false?'hide':''}}"> {{ \App\Helpers\PoHelper::NormalizeColString($colKey)  }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group input-group-sm col-md-4">

                            <select class="form-control select2 " style="width: 100%;" wire:model.debounce.500ms="queryOpr.{{ $TmpKey }}"  title="Select Search Operator">
                                <option value="" selected disabled>Select Search Operator</option>
                                @foreach($operators as $operatorKey => $operator)
                                    <option value="{{$operatorKey}}"> {{ $operator }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-sm col-md-4" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" title="Search String"
                                   placeholder="Search"  wire:model.debounce.500ms="queryVal.{{ $TmpKey }}">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default text-capitalize" wire:click="search_reset({{ $TmpKey }})" title="Reset Current Filter">
                                    <i class="fas fa-sync"></i>
                                </button>
                                <button type="submit" class="btn btn-default text-capitalize" wire:click="removeTemplate({{ $TmpKey }})" title="Reset Current Filter">
                                    <i class="fas fa-minus-circle"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <br>
            @endforeach

            <br>
            <div class="row">
                <div class="col-sm">
                    <button class="btn btn-sm btn-danger flat text-capitalize" wire:click="addNewRow"><i class="fas fa-plus" ></i> add more condition<span style="font-size: 0.650rem">(s)</span></button>
                </div>
            </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                <button type="button" class="btn btn-success flat" wire:click="saveTemplateInRepo"><i class="fas fa-folder-open"></i> save filter</button>
                <button type="button" class="btn btn-warning flat" wire:click="resetInputs" data-dismiss="modal"><i class="fas fa-folder-open"></i> close</button>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
    </div>
    <!-- /.card -->

</div>

@push('scripts')
    <!-- Summernote -->
    <script src=" {{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/summernote/summernote-bs4.min.js')}}"></script>

@endpush
