@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/daterangepicker/daterangepicker.css')}}">
@endpush
<div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('broadcast_type')}}" wire:model.defer="broadcast_type.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('mail_type')}}" wire:model.defer="mail_type.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('table_type')}}"  wire:model.defer="table_type.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('sender_name')}}" wire:model.defer="sender_name.from" >
        </div>
      </div>

    </div>
    <hr style="margin-top: 0px;">


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('recipient_name')}}" wire:model.defer="recipient_name.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('recipient_email')}}"  wire:model.defer="recipient_email.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="title" class="form-control"  placeholder="{{\App\Helpers\PoHelper::NormalizeColString('msg_subject')}}" wire:model.defer="msg_subject.from" >
        </div>
      </div>
      <div class="col-md-3">
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="{{\App\Helpers\PoHelper::NormalizeColString('last_executed_at')}}" wire:model.defer="last_executed_at.from">
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
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

  <script type="text/javascript">
    $(function () {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    });
 </script>
  @endpush
