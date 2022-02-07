@push('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">


@endpush

<div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="PO Type " wire:model.defer="document_type.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder="PO Type " wire:model.defer="document_type.from" multiple title="PO Type">

            @foreach ($collection_sap_po_types as  $po_types )
            <option value="{{$po_types}}">{{$po_types}}</option>
            @endforeach
         </select>


        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Pur. Group" wire:model.defer="purchasing_group.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="purchasing_group.from" multiple title="Purchasing Group">

            @foreach ($collection_sap_pur_groups as  $purchasing_groups )
            <option value="{{$purchasing_groups}}">{{$purchasing_groups}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Customer Name"  wire:model.defer="customer_name.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" customer_name"   wire:model.defer="customer_name.from" multiple title="Customer Name">

            @foreach ($collection_sap_customer_names as  $customer_names )
            <option value="{{$customer_names}}">{{$customer_names}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Tender no" wire:model.defer="tender_no.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" tender_no"   wire:model.defer="tender_no.from" multiple title="Tender No">

            @foreach ($collection_sap_tender_nos as  $tender_nos )
            <option value="{{$tender_nos}}">{{$tender_nos}}</option>
            @endforeach
         </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Tender Description" wire:model.defer="tender_desc.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" tender_desc"   wire:model.defer="tender_desc.from" multiple title="Tender Description">

            @foreach ($collection_sap_tender_descs as  $tender_descs )
            <option value="{{$tender_descs}}">{{$tender_descs}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Vendor Name"  wire:model.defer="vendor_name_en.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" vendor_name_en"   wire:model.defer="vendor_name_en.from" multiple title="Vendor Name">

            @foreach ($collection_sap_vendor_name_ens as  $vendor_name_ens )
            <option value="{{$vendor_name_ens}}">{{$vendor_name_ens}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Puchasing Document" wire:model.defer="init_po_number.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" init_po_number"   wire:model.defer="init_po_number.from" multiple title="Puchasing Document">

            @foreach ($collection_sap_po_numbers as  $po_numbers )
            <option value="{{$po_numbers}}">{{$po_numbers}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Generic Mat Code" wire:model.defer="generic_mat_code.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" generic_mat_code"   wire:model.defer="generic_mat_code.from" multiple title="Generic Mat Code">

            @foreach ($collection_sap_generic_mat_codes as  $generic_mat_codes )
            <option value="{{$generic_mat_codes}}">{{$generic_mat_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="CUST Gen Code"  wire:model.defer="cust_gen_code.from"  > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" cust_gen_code"   wire:model.defer="cust_gen_code.from" multiple title="CUST Gen Code">

            @foreach ($collection_sap_cust_gen_codes as  $cust_gen_codes )
            <option value="{{$cust_gen_codes}}">{{$cust_gen_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Mat Description" wire:model.defer="mat_description.from"  > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" mat_description"   wire:model.defer="mat_description.from" multiple title="Mat Description" >

            @foreach ($collection_sap_mat_descriptions as  $mat_descriptions )
            <option value="{{$mat_descriptions}}">{{$mat_descriptions}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore >
          {{-- <input type="title" class="form-control"  placeholder="Delivery Address"   wire:model.defer="delivery_address.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder="Delivery Address"   wire:model.defer="delivery_address.from" multiple title="Delivery Address">

            @foreach ($collection_sap_delivery_address as  $delivery_address )
            <option value="{{$delivery_address}}">{{$delivery_address}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Plant"  wire:model.defer="plant.from" > --}}
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" plant"   wire:model.defer="plant.from" multiple title="plant">

                @foreach ($collection_sap_plnts as  $plants )
                <option value="{{$plants}}">{{$plants}}</option>
                @endforeach
            </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">



    <div class="row">
        <div class="col-md-3">
            <div class="form-group" wire:ignore>
              {{-- <input type="title" class="form-control"  placeholder="Tender Description" wire:model.defer="tender_desc.from" > --}}
              <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" customer_po_no"   wire:model.defer="customer_po_no.from" multiple title="Customer Po No">

                @foreach ($collection_sap_customer_po_nos as  $customer_po_nos )
                <option value="{{$customer_po_nos}}">{{$customer_po_nos}}</option>
                @endforeach
             </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group" wire:ignore>
              {{-- <input type="title" class="form-control"  placeholder="Vendor Name"  wire:model.defer="vendor_name_en.from" > --}}
              <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" customer_po_item"   wire:model.defer="customer_po_item.from" multiple title="Customer Po Item">

                @foreach ($collection_sap_customer_po_items as  $customer_po_items )
                <option value="{{$customer_po_items}}">{{$customer_po_items}}</option>
                @endforeach
             </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group" wire:ignore>
              {{-- <input type="title" class="form-control"  placeholder="Puchasing Document" wire:model.defer="pur_grp_name.from" > --}}
              <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" pur_grp_name"   wire:model.defer="pur_grp_name.from" multiple title="Pur Grp Name">

                @foreach ($collection_sap_pur_grp_names as  $pur_grp_names )
                <option value="{{$pur_grp_names}}">{{$pur_grp_names}}</option>
                @endforeach
             </select>
            </div>
          </div>
        <div class="col-md-3">
          <div class="form-group" wire:ignore>
            {{-- <input type="title" class="form-control"  placeholder="Plant"  wire:model.defer="plant.from" > --}}
              <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" notified"   wire:model.defer="notified.from"  title="notified">

                  @foreach ($collection_sap_notifieds as  $notifieds )
                  <option value="{{$notifieds}}">{{$notifieds}}</option>
                  @endforeach
              </select>
          </div>
        </div>

      </div>
      <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Storage Location"   wire:model.defer="storage_location.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" storage_location"   wire:model.defer="storage_location.from"  multiple title="Storage Location">

            @foreach ($collection_sap_storage_locations as  $storage_locations )
            <option value="{{$storage_locations}}">{{$storage_locations}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Storage Location"   wire:model.defer="nupco_trade_code.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" nupco_trade_code"   wire:model.defer="nupco_trade_code.from"  multiple title="Trade Code">

            @foreach ($collection_sap_nupco_trade_codes as  $nupco_trade_codes )
            <option value="{{$nupco_trade_codes}}">{{$nupco_trade_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Customer No" wire:model.defer="customer_no.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" customer_no"   wire:model.defer="customer_no.from"  multiple title="Customer No">
            @foreach ($collection_sap_customer_nos as  $customer_nos )
            <option value="{{$customer_nos}}">{{$customer_nos}}</option>
            @endforeach
         </select>
        </div>
      </div>



      <div class="col-md-4">
        <div class="form-group" wire:ignore style="text-align: right ">
            <select class="form-control selectpicker"  wire:model.defer="supplier_comment.from"  placeholder="Please Choose Supplier Comments" style="text-align: right "  multiple title="Please Choose Supplier Comments">

                @if (\App\Models\SupplierCommentTypes::supplierCommets())
                @foreach (\App\Models\SupplierCommentTypes::supplierCommets() as $key => $supComs)

                <option value="{{$key}}"  >{{$supComs}}</option>
                @endforeach

                @endif

            </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group" wire:ignore>
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" asn"   wire:model.defer="asn.from"  multiple title="ASN">
            <option value="no">No</option>
            <option value="new">New</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
            <option value="delivered">Delivered</option>
            <option value="not_delivered">Not Delivered</option>
         </select>
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">

    <div class="row">
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control"  placeholder="Vendor NO"  wire:model.defer="vendor_code.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" vendor_code"   wire:model.defer="vendor_code.from"  multiple title="Vendor Code">

            @foreach ($collection_vendor_codes as  $vendor_codes )
            <option value="{{$vendor_codes}}">{{$vendor_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="slider-red">
            <input type="text" wire:model.defer="supply_ratio.from" class=" form-control"  placeholder="supply ration from" >
          </div>
      </div>
      <div class="col-md-2">
        <div class="slider-red">
            <input type="text" wire:model.defer="supply_ratio.to" class=" form-control"  placeholder="supply ration to" >
          </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control float-right" id="deliveryDate" placeholder="Nupco Delivery Date" >
              <input type="hidden"  id="startnupco_delivery_date" wire:model.defe="nupco_delivery_date.from">
            <input type="hidden"  id="endnupco_delivery_date" wire:model.defe="nupco_delivery_date.to">
            </div>
            <!-- /.input group -->
          </div>
      </div>


      <div class="col-md-3">
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control float-right" id="createDate" placeholder="Po Created On">
              <input type="hidden"  id="startpo_created_on" wire:model.defe="po_created_on.from">
                <input type="hidden"  id="endpo_created_on" wire:model.defe="po_created_on.to">
            </div>
            <!-- /.input group -->
          </div>
      </div>


    </div>


    <div class="row">
        <div class="col-md-12 justify-center">

            <button type="button" id="submit_filter" class="btn btn-success btn-sm flat btn-sm float-right" wire:click="search_enter" >
                Check Now
            </button>
            <button type="submit" class="btn btn-success btn-sm flat btn-sm "  title="Reset Current Filter" wire:click="search_reset">
                <i class="fas fa-sync"></i>
            </button>

        </div>
      </div>

  </div>

  @stack("sap-filter-scripts")


@push('livewire-parent')
@endpush


