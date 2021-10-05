<div>
    @push('styles')
        <!-- Google Font: Source Sans Pro -->

        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">
    @endpush
    <div class="row">
        @if($json_data_to_string)

                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible flat">
                        <i class="icon fas fa-info-circle"></i>
                        {!! $json_data_to_string !!}
                    </div>
                </div>
            <br>
        @endif

        <div class="col-md-12">
            <p class="text-uppercase text-center"> <strong>SCHEDULER</strong> </p>

        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Select PO Table</label>
                <select class="form-control " style="width: 100%;" wire:model="poTable">
                    @if($templateArray)
                        <option value="" selected disabled>Please Chose A Table</option>
                        @foreach($templateArray as $temKey => $template)
                            <option value="{{$temKey}}">{{\App\Helpers\PoHelper::NormalizeColString($template)}}</option>
                        @endforeach
                    @endif
                </select>
                @error('poTable') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Select Query</label>
                <select class="form-control " style="width: 100%;" wire:model="poQuery">
                    @if($availableQuery)
                        <option value="" selected disabled>Please Chose A Table</option>
                        @foreach($availableQuery as $qryKey => $query)
                            <option value="{{$qryKey}}">{{\App\Helpers\PoHelper::NormalizeColString($query)}}</option>
                        @endforeach
                    @endif
                </select>
                @error('poQuery') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input wire:model="subject" type="title" class="form-control" id="title" placeholder="Enter Title">
                    @error('subject') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


        <div class="col-md-4">
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Start Time:</label>

                    <div class="input-group date"  data-target-input="nearest">
                        <input  id="timepicker"  type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    @error('startTime') <span class="error">{{ $message }}</span> @enderror
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
        </div>
        <div class="col-md-4">
            <!-- Date -->
            <div class="form-group">
                <label>Start Date:</label>
                <div class="input-group date"  data-target-input="nearest">
{{--                    <input  id="schedule_date"  @if(!empty($switch) and $switch['day']) readonly @endif type="text" class="form-control datetimepicker-input" data-target="#schedule_date"/>--}}
                    <input  id="schedule_date"  type="text" class="form-control datetimepicker-input" data-target="#schedule_date"/>
                    <div class="input-group-append" data-target="#schedule_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                @error('startDate') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-md-4">
            <!-- Date -->
            <div class="form-group">
                <label>End Date:</label>
                <div class="input-group date"  data-target-input="nearest">
                    {{--                    <input  id="schedule_date"  @if(!empty($switch) and $switch['day']) readonly @endif type="text" class="form-control datetimepicker-input" data-target="#schedule_date"/>--}}
                    <input  id="schedule_end_date"  type="text" class="form-control datetimepicker-input" data-target="#schedule_end_date"/>
                    <div class="input-group-append" data-target="#schedule_end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('endDate') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


            <div class="col-md-12" >
                <div class="form-group">
                    <label>Select Day <small>(s)</small></label>
                    <div class="select2-purple" wire:ignore>
                        <select  class="select2" multiple="multiple" id="selected_recurrent_days" data-placeholder="Select Day" data-dropdown-css-class="select2-purple" style="width: 100%;" >
                            <option value="mon" selected >Monday</option>
                            <option value="tue" selected >Tuesday</option>
                            <option value="wed" selected >Wednesday</option>
                            <option value="thu" selected >Thursday</option>
                            <option value="fri" selected >Friday</option>
                            <option value="sat" selected >Suturday</option>
                            <option value="sun" selected >Sunday</option>
                        </select>
                        @error('selectedDays') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

    </div>
        <br>
        <div class="row">
            <div class="col-md">
                <button class="btn btn-success flat text-capitalize" wire:click="reset_schedule_input"><i class="fas fa-undo-alt"></i>  reset</button>
                <button class="btn btn-info flat text-capitalize" wire:click="save_scheduler"><i class="fas fa-download"></i>  Save</button>
            </div>

        </div>



    @push('scripts')

        <!-- jQuery -->

            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/js/select2.full.min.js')}}"></script>
            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/moment/moment.min.js')}}"></script>
            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/inputmask/jquery.inputmask.min.js')}}"></script>
            <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>



            <script >
                $(document).ready(function () {
                    $('.select2').select2()
                })
                document.addEventListener('livewire:load', function () {

                    $('.select2').select2({
                    }).on('change', function(){
                    @this.set('selectedDays', $(this).val());
                    });

                    $('#schedule_date').datetimepicker({
                        format: 'yy-MM-DD'
                    });

                    $('#schedule_end_date').datetimepicker({
                        format: 'yy-MM-DD'
                    });
                    $('#timepicker').datetimepicker({
                        datepicker:false,
                        format:'HH:mm',
                        pickDate: false,
                        pickSeconds: false,
                        pick12HourFormat: false
                    })

                    $("#timepicker").on("change.datetimepicker", ({date, oldDate}) => {
                            @this.startTime=date;
                    })

                    $("#schedule_date").on("change.datetimepicker", ({date, oldDate}) => {
                        @this.startDate=date;
                    })

                    $("#schedule_end_date").on("change.datetimepicker", ({date, oldDate}) => {
                    @this.endDate=date;
                    })



                    Livewire.hook('message.processed',(message, component)=>{
                        $('.select2').select2({
                        }).on('change', function(){
                        @this.set('selectedDays', $(this).val());
                        });
                    });
                })
            </script>
    @endpush
</div>
