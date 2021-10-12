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

            @charset "UTF-8";
            .avatar-wrapper {
                position: relative;
                height: 200px;
                width: 200px;
                margin: 50px auto;
                border-radius: 50%;
                overflow: hidden;
                box-shadow: 1px 1px 15px -5px black;
                transition: all 0.3s ease;
            }
            .avatar-wrapper:hover {
                transform: scale(1.05);
                cursor: pointer;
            }
            .avatar-wrapper:hover .profile-pic {
                opacity: 0.5;
            }
            .avatar-wrapper .profile-pic {
                height: 100%;
                width: 100%;
                transition: all 0.3s ease;
            }
            .avatar-wrapper .profile-pic:after {
                font-family: FontAwesome;
                content: "";
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                position: absolute;
                font-size: 190px;
                background: #ecf0f1;
                color: #ecf0f1;
                text-align: center;
            }
            .avatar-wrapper .upload-button {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
            }
            .avatar-wrapper .upload-button .fa-arrow-circle-up {
                position: absolute;
                font-size: 234px;
                top: -17px;
                left: -17px;
                text-align: center;
                opacity: 0;
                transition: all 0.3s ease;
                color: #e54b00;
            }
            .avatar-wrapper .upload-button:hover .fa-arrow-circle-up {
                opacity: 0.9;
            }

        </style>
    @endpush

    <div class="avatar-wrapper">
            <img class="profile-pic" src="{{$OldAvatar}}" />
        <div class="upload-button">
            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
        </div>
        <input class="file-upload" wire:model="avatar" type="file" accept="image/*" />
        @error('avatar') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
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

        <div class="col-md-6 permission_col_profile">
            <div class="form-group">
                <label>Permissions</label>

                <div class="select2-purple" wire:ignore>
                    @foreach($permissionArray as $perKey => $permission)
                        <span class="right badge badge-info lbs-badge">{{$permission}}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{--            Password--}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="title" class="form-control"  placeholder="Enter First Name" wire:model="password">
                @error('password') <span class="error-msg">{{ $message  }}</span> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Confirm Password</label>
                <input type="title" class="form-control"  placeholder="Enter First Name" wire:model="password_confirmation">
                @error('password_confirmation') <span class="error-msg">{{ $message  }}</span> @enderror
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




            // =======avatar====|
            document.addEventListener('livewire:load', function () {


                // $(".file-upload").on('change', function(){
                //     @this.saveAvatar();
                // });

                $(".upload-button").on('click', function() {
                    $(".file-upload").click();
                });
            })

        </script>
    @endpush

    @livewire('livewire.CoreHelpers.core-helper-toaster-component')
</div>
