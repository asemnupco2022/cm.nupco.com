<div>
@push('styles')
    <!-- Google Font: Source Sans Pro -->

        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/select2/css/select2.min.css')}}">

        <style>
            span.right.badge.badge-info.lbs-badge {
                padding: 12px !important;
                font-weight: 300 !important;
            }

        </style>
    @endpush

    <div class="row">
        <div class="col-md-12">
            <p class="text-uppercase text-center text-uppercase"> <strong>UPDATE PROFILE</strong> </p>

        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Employee Number</label>
                <input type="title" class="form-control"  placeholder="Enter Employee Number" wire:model="employee_num" readonly>
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
                    @foreach($permissionArray as $perKey => $permission)
                        <span class="right badge badge-info lbs-badge">{{$permission}}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <button class="btn btn-success flat text-capitalize" wire:click="updateStaff"><i class="fas fa-download"></i>  Update</button>
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

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
