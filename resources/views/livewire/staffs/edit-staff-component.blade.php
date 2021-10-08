<div>
@push('styles')
    <!-- Google Font: Source Sans Pro -->

        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">
    @endpush

    <div class="row">
        <div class="col-md-12">
            <p class="text-uppercase text-center"> <strong>UPDATE STAFF</strong> </p>

        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Employee Number</label>
                <input type="title" class="form-control"  placeholder="Enter Employee Number" wire:model="employee_num">
                @error('employee_num') <span class="error-msg">{{ $message  }}</span> @enderror

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="title" class="form-control"  placeholder="Enter First Name" wire:model="first_name">
                @error('first_name') <span class="error-msg">{{ $message  }}</span> @enderror

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="title" class="form-control"  placeholder="Enter Last Name" wire:model="last_name">
                @error('last_name') <span class="erro-msg">{{ $message  }}</span> @enderror
            </div>
        </div>



        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control"  placeholder="Enter Email" wire:model="email">
                @error('email') <span class="erro-msg">{{ $message  }}</span> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Contact</label>
                <input type="title" class="form-control"  placeholder="Enter Contact No" wire:model="phone">
                @error('phone') <span class="erro-msg">{{ $message  }}</span> @enderror
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="title" class="form-control"  placeholder="Enter Username" wire:model="username" readonly disabled>
                @error('username') <span class="erro-msg">{{ $message  }}</span> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Permissions</label>
                <div class="select2-purple" wire:ignore>
                    <select class="select2" multiple="multiple" id="permissionsEdit" wire:model="permissions"  data-placeholder="Select Permissions" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        @if($permissionArray)
                            @foreach($permissionArray as $perKey => $permission)
                                <option  value="{{$perKey}}">{{$permission}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <button class="btn btn-info flat text-capitalize" wire:click="updateStaff"><i class="fas fa-download"></i>  Update</button>
            </div>
        </div>


    </div>

    @push('scripts')

    <!-- jQuery -->

        <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/js/select2.full.min.js')}}"></script>



        <script >
            $(document).ready(function () {
                $('#permissionsEdit').select2()
            })
            document.addEventListener('livewire:load', function () {

                $('#permissionsEdit').select2({
                }).on('change', function(){
                @this.set('permissions', $(this).val());
                });

                window.addEventListener('reset-permission-select2', event => {
                    $("#permissionsEdit").val('').trigger('change')
                })

                Livewire.hook('message.processed',(message, component)=>{
                    $('#permissionsEdit').select2({
                    }).on('change', function(){
                    @this.set('permissions', $(this).val());
                    });
                });
            })


        </script>
    @endpush
</div>
