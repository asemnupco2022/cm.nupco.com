@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SAP PO LINE ITEMS</h3>

            <div class="card-tools">
                <a href="{{route('web.route.po.SAPTable')}}" class="btn btn-sm btn-success">back</a>
            </div>
        </div>
        <div class="card-body">
          @livewire('po.sap-line-item-component',['purchasing_document'=> $po_id])
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
