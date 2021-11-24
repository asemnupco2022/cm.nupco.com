@push('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
@endpush

<div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="PO Type " wire:model.defer="document_type.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder="PO Type " wire:model.defer="document_type.from">
            <option value="">PO Type</option>
            @foreach (PoHelper::collection_sap_po_types() as  $po_types )
            <option value="{{$po_types}}">{{$po_types}}</option>
            @endforeach
         </select>


        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Pur. Group" wire:model.defer="purchasing_group.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="purchasing_group.from">
            <option value="">Purchasing Group</option>
            @foreach (PoHelper::collection_sap_pur_groups() as  $purchasing_groups )
            <option value="{{$purchasing_groups}}">{{$purchasing_groups}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Customer Name"  wire:model.defer="customer_name.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" customer_name"   wire:model.defer="customer_name.from">
            <option value="">Customer Name</option>
            @foreach (PoHelper::collection_sap_customer_names() as  $customer_names )
            <option value="{{$customer_names}}">{{$customer_names}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Tender no" wire:model.defer="tender_no.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" tender_no"   wire:model.defer="tender_no.from">
            <option value="">Tender No</option>
            @foreach (PoHelper::collection_sap_tender_nos() as  $tender_nos )
            <option value="{{$tender_nos}}">{{$tender_nos}}</option>
            @endforeach
         </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Tender Description" wire:model.defer="tender_desc.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Vendor Name"  wire:model.defer="vendor_name_en.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" vendor_name_en"   wire:model.defer="vendor_name_en.from">
            <option value="">Vendor Name</option>
            @foreach (PoHelper::collection_sap_vendor_name_ens  () as  $vendor_name_ens )
            <option value="{{$vendor_name_ens}}">{{$vendor_name_ens}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Puchasing Document" wire:model.defer="init_po_number.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Generic Mat Code" wire:model.defer="generic_mat_code.from" >
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="CUST Gen Code"  wire:model.defer="cust_gen_code.from"  >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Mat Description" wire:model.defer="mat_description.from"  >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore >
          {{-- <input type="title" class="form-control"  placeholder="Delivery Address"   wire:model.defer="delivery_address.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder="Delivery Address"   wire:model.defer="delivery_address.from">
            <option value="">Delivery Address</option>
            @foreach (PoHelper::collection_sap_delivery_address() as  $delivery_address )
            <option value="{{$delivery_address}}">{{$delivery_address}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Plant"  wire:model.defer="plant.from" > --}}
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" plant"   wire:model.defer="plant.from">
                <option value="">plant</option>
                @foreach (PoHelper::collection_sap_plnts() as  $plants )
                <option value="{{$plants}}">{{$plants}}</option>
                @endforeach
            </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Storage Location"   wire:model.defer="storage_location.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Customer No" wire:model.defer="customer_no.from" >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <select class="form-control"  wire:model.defer="supplier_comment.from"  placeholder="Please Choose Supplier Comments">
                <option value="0" selected  >Please Choose Supplier Comments</option>
                @if (\App\Models\SupplierCommentTypes::supplierCommets())
                @foreach (\App\Models\SupplierCommentTypes::supplierCommets() as $key => $supComs)
                <option value="{{$key}}" <?php if($supplier_comment and $key==$supplier_comment['from'] ){ echo 'selected' ; }?> >{{$supComs}}</option>
                @endforeach

                @endif

            </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">

    <div class="row">
      <div class="col-md-6">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Vendor NO"  wire:model.defer="vendor_code.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" vendor_code"   wire:model.defer="vendor_code.from">
            <option value="">Vendor Code</option>
            @foreach (PoHelper::collection_vendor_codes() as  $vendor_codes )
            <option value="{{$vendor_codes}}">{{$vendor_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Supply Ratio"  wire:model.defer="supply_ratio.from" >
        </div>
      </div>

    </div>


    <div class="row">
        <div class="col-md-12 justify-center">

            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right" wire:click="search_enter" >
                Check Now
            </button>

            {{-- <button type="submit" class="btn btn-warning btn-sm flat btn-sm"  title="Reset Current Filter" wire:click="search_reset">
                <i class="fas fa-sync"></i>
            </button> --}}

        </div>
      </div>

  </div>
@push('scripts')
{{-- <script src=" {{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/js/select2.full.min.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $('.selectpicker').selectpicker(
  {
    liveSearchPlaceholder: 'Select Po Type'
  }
);
</script>
@endpush

@push('livewire-parent')

@endpush
