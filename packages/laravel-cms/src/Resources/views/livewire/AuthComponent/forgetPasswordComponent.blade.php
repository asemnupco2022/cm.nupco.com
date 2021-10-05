
        <div class="card-body">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                @if (session()->has('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
            <p class="login-box-msg">reset your password</p>

            <form wire:submit.prevent="onForgetPassword" >
                <div class="input-group mb-3">
                    <input wire:model.lazy="email" type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <br>
                    @error('email') <span class="error invalid-feedback ">{{ $message }}</span> @enderror
                </div>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">send Rest Token</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->

