<div>
    <div class="row">
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control" Tender Num" wire:model.defer="tender_num.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" wire:model.defer="tender_num.from"  title="tender num">
            @foreach ($collection_tender_num as  $po_types )
            <option value="{{$po_types}}">{{$po_types}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          {{-- <input type="title" class="form-control" Vendor No" wire:model.defer="vendor_num.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="vendor_num.from"  title="vendor num">
            @foreach ($collection_vendor_num as  $vendor_nums )
              <option value="{{$vendor_nums}}">{{$vendor_nums}}</option>
            @endforeach
         </select>

        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Vendor Name" wire:model.defer="vendor_name_en.from" > --}}
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="vendor_name_en.from"  title="vendor name en">
            @foreach ($collection_vendor_name_en as  $vendor_name_ens )
            <option value="{{$vendor_name_ens}}">{{$vendor_name_ens}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Customer Code" wire:model.defer="cust_code.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="cust_code.from"  title="cust code">
            @foreach ($collection_cust_code as  $cust_codes )
            <option value="{{$cust_codes}}">{{$cust_codes}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Customer Name"  wire:model.defer="customer_name.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="customer_name.from"  title="customer name">
            @foreach ($collection_customer_name as  $customer_names )
            <option value="{{$customer_names}}">{{$customer_names}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Po Num" wire:model.defer="po_num.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="po_num.from"  title="po num">
            @foreach ($collection_po_num as  $po_nums )
            <option value="{{$po_nums}}">{{$po_nums}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Po Item Num" wire:model.defer="po_item_num.from" > --}}
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="po_item_num.from"  title="po item num">
            @foreach ($collection_po_item_num as  $po_item_nums )
            <option value="{{$po_item_nums}}">{{$po_item_nums}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Material Num" wire:model.defer="mat_num.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="mat_num.from"  title="mat num">
            @foreach ($collection_mat_num as  $mat_nums )
            <option value="{{$mat_nums}}">{{$mat_nums}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Tender Desc" wire:model.defer="tender_desc.from" > --}}
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="tender_desc.from"  title="tender desc">
            @foreach ($collection_tender_desc as  $tender_descs )
            <option value="{{$tender_descs}}">{{$tender_descs}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Customer Po No" wire:model.defer="customer_po_no.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="customer_po_no.from"  title="customer po no">
            @foreach ($collection_customer_po_no as  $customer_po_nos )
            <option value="{{$customer_po_nos}}">{{$customer_po_nos}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Customer Po Item" wire:model.defer="customer_po_item.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="customer_po_item.from"  title="customer po item">
            @foreach ($collection_customer_po_item as  $customer_po_items )
            <option value="{{$customer_po_items}}">{{$customer_po_items}}</option>
            @endforeach
         </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Importance" wire:model.defer="importance.from" > --}}
         <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="importance.from"  title="importance">
            <option value="1">yes</option>
            <option value="0">no</option>
         </select>
        </div>
      </div>



      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Line Status" wire:model.defer="line_status.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="line_status.from"  title="line status">
            <option value="new">new</option>
            <option value="waiting for action">waiting for action</option>
            <option value="closed">closed</option>
            <option value="other">other</option>
         </select>
        </div>
      </div>


    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" UOM" wire:model.defer="uom.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="uom.from"  title="uom">
            @foreach ($collection_uom as  $uoms )
            <option value="{{$uoms}}">{{$uoms}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Plant"  wire:model.defer="plant.from" > --}}
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="plant.from"  title="plant">
            @foreach ($collection_plant as  $plants )
            <option value="{{$plants}}">{{$plants}}</option>
            @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group"  wire:ignore >
          {{-- <input type="title" class="form-control" Item Desc" wire:model.defer="item_desc.from" > --}}
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;"   wire:model.defer="item_desc.from"  title="item desc">
            @foreach ($collection_item_desc as  $item_descs )
            <option value="{{$item_descs}}">{{$item_descs}}</option>
            @endforeach
         </select>
        </div>
      </div>
    </div>

    <hr style="margin-top: 0px;">


    <div class="row">
        <div class="col-md-8">
            <div class="form-group" wire:ignore style="text-align: right ">
                <select class="form-control "  wire:model.defer="supplier_comment.from" Please Choose Supplier Comments" style="text-align: right ">
                    <option value="0" selected  >Please Choose Supplier Comments</option>
                    @if (\App\Models\SupplierCommentTypes::supplierCommets())
                        @foreach (\App\Models\SupplierCommentTypes::supplierCommets() as $key => $supComs)
                          <option value="{{$key}}"  >{{$supComs}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group"  wire:ignore >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="deliveryDate"Delivery Address" >
                  <input type="hidden"  id="startnupco_delivery_date" wire:model.defe="delivery_address.from">
                <input type="hidden"  id="endnupco_delivery_date" wire:model.defe="delivery_address.to">
                </div>
                <!-- /.input group -->
              </div>
          </div>

      </div>

      <hr style="margin-top: 0px;">



    <div class="row">
        <div class="col-md-12 justify-center">

            <button type="button" class="btn btn-success btn-sm flat btn-sm float-right" wire:click="search_filter_submit" >
                Check Now
            </button>

            {{-- <button type="submit" class="btn btn-warning btn-sm flat btn-sm"  title="Reset Current Filter" wire:click="search_reset">
                <i class="fas fa-sync"></i>
            </button> --}}

        </div>
      </div>

  </div>




