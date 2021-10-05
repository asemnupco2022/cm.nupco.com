@push('styles')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/toastr/toastr.min.css')}}">
@endpush

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

@push('scripts')
    <!-- Toastr -->
    <script src="{{URL(LbsConstants::BASE_ADMIN_ASSETS.'plugins/toastr/toastr.min.js')}}"></script>
@endpush
