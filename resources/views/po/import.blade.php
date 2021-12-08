@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Import PO</h3>

            <div class="card-tools">
{{--           add something--}}
            </div>
        </div>
        <div class="card-body">
{{--            @livewire('mail.compose-mail-component')--}}
{{--            @livewire('po.user-filters-component')--}}
          @livewire('po.po-import-component')   <!--import Po files -->

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection
