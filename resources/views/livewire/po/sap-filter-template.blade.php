<div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="PO Type " wire:model.defer="document_type.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Pur. Goup" wire:model.defer="purchasing_group.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Customer Name"  wire:model.defer="customer_name.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Tender no" wire:model.defer="tender_no.from" >
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Tender Desc" wire:model.defer="tender_desc.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Vendor Name"  wire:model.defer="vendor_name_en.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Puchasing Document" wire:model.defer="po_number.from" >
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
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Delivery Address"   wire:model.defer="delivery_address.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Plant"  wire:model.defer="plant.from" >
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
      {{-- <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Supplier Feedback an per HOS" wire:model.defer="customer_no.from">
        </div>
      </div> --}}

    </div>
    <hr style="margin-top: 0px;">

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Vendor NO"  wire:model.defer="vendor_code.from" >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Supply Ratio"  wire:model.defer="supply_ratio.from" >
        </div>
      </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right" wire:click="checknewfilter" >
                Check Now
            </button>
        </div>
      </div>

  </div>
