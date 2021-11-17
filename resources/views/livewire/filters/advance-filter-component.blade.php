<div>

    <div class="row"><div class="col-12">
        <div class="form-group">
            <input type="title" class="form-control"  placeholder="templateName" wire:model.defer="templateName" >
            @error('templateName') <span class="error">{{ $message }}</span> @enderror
          </div>
    </div></div>
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
          <input type="title" class="form-control"  placeholder="Tender Description" wire:model.defer="tender_desc.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Vendor Name"  wire:model.defer="vendor_name_en.from" >
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
        <div class="col-md-12 justify-center">
            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right" wire:click="saveTemplateInRepo" >
                Save Filter
            </button>
        </div>
      </div>

  </div>
