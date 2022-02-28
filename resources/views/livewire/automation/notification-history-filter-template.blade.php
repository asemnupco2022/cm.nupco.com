@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="{{ URL(LbsConstants::BASE_ADMIN_ASSETS . 'plugins/daterangepicker/daterangepicker.css') }}">
@endpush
<div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Tender Num" wire:model.defer="tender_num.from">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Vendor No" wire:model.defer="vendor_num.from">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Po Number" wire:model.defer="po_num.from">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Customer Code"
                    wire:model.defer="cust_code.from">
            </div>
        </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Po Item No" wire:model.defer="po_item_num.from">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Uom" wire:model.defer="uom.from">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Plant" wire:model.defer="plant.from">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Mat No" wire:model.defer="mat_num.from">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="title" class="form-control" placeholder="Employee Name"
                    wire:model.defer="staff_name.from">
            </div>
        </div>
    </div>

    <hr style="margin-top: 0px;">




    <div class="row">
        <div class="col-md-12 justify-center">

            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right"
                wire:click="search_filter_submit">
                Check Now
            </button>

            {{-- <button type="submit" class="btn btn-warning btn-sm flat btn-sm"  title="Reset Current Filter" wire:click="search_reset">
                <i class="fas fa-sync"></i>
            </button> --}}

        </div>
    </div>

</div>

@push('scripts')
@endpush
