<div>
    <div class="row">
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder="PO Type " wire:model.defer="tender_num.from"  title="tender num">
                     </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group" wire:ignore>
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="vendor_num.from"  title="vendor num">
                     </select>

        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="vendor_name_en.from"  title="vendor name en">
                     </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="cust_code.from"  title="cust code">
                     </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="customer_name.from"  title="customer name">
                     </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="po_num.from"  title="po num">
                     </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
          <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="po_item_num.from"  title="po item num">
                     </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="mat_num.from"  title="mat num">
                     </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="tender_desc.from"  title="tender desc">
                     </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="customer_po_no.from"  title="customer po no">
                     </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="customer_po_item.from"  title="customer po item">
                     </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          
         <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="importance.from"  title="importance">
            <option value="1">yes</option>
            <option value="0">no</option>
         </select>
        </div>
      </div>



      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="line_status.from"  title="line status">
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
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="uom.from"  title="uom">
                     </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
            <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="plant.from"  title="plant">
                     </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          
           <select class="form-control selectpicker " data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;" placeholder=" purchasing_group"   wire:model.defer="item_desc.from"  title="item desc">
                     </select>
        </div>
      </div>
    </div>

    <hr style="margin-top: 0px;">


    <div class="row">
        <div class="col-md-8">
            <div class="form-group" wire:ignore style="text-align: right ">
                <select class="form-control "  wire:model.defer="supplier_comment.from"  placeholder="Please Choose Supplier Comments" style="text-align: right ">
                    <option value="0" selected  >Please Choose Supplier Comments</option>
                                                                                </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="deliveryDate" placeholder="Delivery Address" >
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

            

        </div>
      </div>

  </div>




