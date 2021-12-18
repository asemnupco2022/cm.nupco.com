@push('styles')
    <!-- daterange picker -->
<link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">
@endpush

<div>

    <div class="row">
      <div class="col-md-2">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Tender Num" wire:model.defer="tender_num.from" >
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Vendor No" wire:model.defer="vendor_num.from" >
        </div>
      </div>
      {{-- <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Vendor Name" wire:model.defer="vendor_name.from" >
        </div>
      </div> --}}
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Po Number"  wire:model.defer="po_num.from" >
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Customer Code" wire:model.defer="cust_code.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Customer Name" wire:model.defer="customer_name.from" >
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Po Item No" wire:model.defer="po_item_num.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Uom"  wire:model.defer="uom.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Plant" wire:model.defer="plant.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="Mat No" wire:model.defer="mat_num.from" >
        </div>
      </div>
    </div>

    <hr style="margin-top: 0px;">


    <div class="row">
        <div class="col-md-8">
            <div class="form-group" wire:ignore style="text-align: right ">
                <select class="form-control "  wire:model.defer="supplier_comment.from"  placeholder="Please Choose Supplier Comments" style="text-align: right ">
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
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="deliveryDate" placeholder="Last Executed At" >
                  <input type="hidden"  id="startnupco_delivery_date" wire:model.defe="last_executed_at.from">
                <input type="hidden"  id="endnupco_delivery_date" wire:model.defe="last_executed_at.to">
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

  @push('scripts')
  <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/moment/moment.min.js')}}"></script>
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

  <script>
      $(document).ready(function() {

        var startnupco_delivery_date;
        var endnupco_delivery_date;
        $('#deliveryDate').daterangepicker(
       {
          format: 'YYYY-MM-DD',
       },
       function(start, end) {
        startnupco_delivery_date = start;
         endnupco_delivery_date = end;

       }
    );
        $('#deliveryDate').val("");
        $('#deliveryDate').change(function () {
            @this.set('last_executed_at.from', startnupco_delivery_date.format('YYYY-MM-DD'));
            @this.set('last_executed_at.to', endnupco_delivery_date.format('YYYY-MM-DD'));
        })

});


</script>

  @endpush
