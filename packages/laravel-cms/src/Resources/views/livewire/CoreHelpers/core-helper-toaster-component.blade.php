<div>
@push('styles')
    <!-- Toastr -->
        <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/toastr/toastr.min.css')}}">
    @endpush


    @push('scripts')
    <!-- Toastr -->
        <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/toastr/toastr.min.js')}}"></script>

        <script>
            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message,
                    event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
        </script>
    @endpush

</div>
