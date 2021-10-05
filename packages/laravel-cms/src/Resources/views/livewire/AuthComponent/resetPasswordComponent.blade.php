
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
            <p class="login-box-msg">Sign in to start your session</p>

            <form wire:submit.prevent="onLogin" >
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
                <div class="input-group mb-3">
                    <input wire:model.lazy="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <br>
                    @error('password') <span class="error invalid-feedback ">{{ $message }}</span>@enderror
                </div>


                @if(LaravelCms::lbs_object_key_exists('app_recaptcha',Session::get('_LbsAppSession'))=='true')
                    <div class="row">
                        <div class="col-12">
                            {!! NoCaptcha::display() !!}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input wire:model.lazy="rememberMe"  type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->

