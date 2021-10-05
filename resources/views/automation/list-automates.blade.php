@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Automation</h3>

            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            @livewire('automation.list-auto-component')
{{--            @livewire('automation.create-auto-component')--}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection
