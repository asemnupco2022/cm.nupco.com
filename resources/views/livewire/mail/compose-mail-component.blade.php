
<div>

    {{-- @push('styles') --}}
    <!-- summernote -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/summernote/summernote-bs4.min.css')}}">
    <style>
         h3.card-title {
            padding-right: 31px;
        }
    </style>
    {{-- @endpush --}}

    <div class="card card-primary card-outline">
        <div class="card-header">
            <div style="display: contents;">

                <h3 class="card-title">Compose New Message</h3>

                <div class="col-md-12">
                    @if (session()->has('success'))
                        <span class="text-success">
                            {{ session('success') }}
                        </span>
                    @endif

                    @if (session()->has('error'))
                        <span class="text-danger">
                            {{ session('error') }}
                        </span>
                    @endif
                </div>

            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <br>
            </div>

            <div class="form-group">
                <input class="form-control" placeholder="To:" wire:model.lazy="mail_to" >
                @error('mail_to') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Subject:" wire:model.lazy="mail_subject">
                @error('mail_subject') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group" wire:ignore wire:key="A" >
                    <textarea id="compose_textarea" class="form-control" style="height: 300px"   wire:model.debounce.500ms="mail_content" >
                            {{$mail_content}}
                    </textarea>
                @error('mail_content') <span class="error">{{ $message }}</span> @enderror
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                <button type="button" class="btn btn-primary" wire:click="sendEmail" wire:loading.attr="disabled"><i class="far fa-envelope" ></i> Send</button>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->


     @push('scripts')
        <!-- Summernote -->
        <script src=" {{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/summernote/summernote-bs4.min.js')}}"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                $('#compose_textarea').summernote({
                    height: 350,
                    codemirror: {
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                        @this.set('mail_content', contents, $editable);
                        }
                    }
                });
            });
            Livewire.on('set-mail-content', mail_contents => {

                $('#compose_textarea').summernote('code',mail_contents);
            })
        </script>


    @endpush
</div>


