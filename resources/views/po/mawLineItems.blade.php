@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">MOWARED PO LINE ITEMS</h3>

            <div class="card-tools">
                <a href="{{route('web.route.po.MawTable')}}" class="btn btn-sm btn-success">back</a>
            </div>
        </div>
        <div class="card-body">
          @livewire('po.maw-line-item-component',['item_code'=> $po_id])

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
