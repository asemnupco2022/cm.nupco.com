@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Vendors</h3>

            <div class="card-tools">
                {{-- add something--}}
            </div>
        </div>
        <div class="card-body">
            @livewire('vendors.vendor-component')
        </div>
        <!-- /.card-body -->
    </div>



@endsection
