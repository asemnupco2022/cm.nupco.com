@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Media Manager</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-plus"></i>  Add Media</button>
            </div>
        </div>
        <div class="card-body">
            <livewire:livewire.AdminControllers.MediaManagerComponent.add_media_manager />
            <livewire:livewire.AdminControllers.MediaManagerComponent.edit_image_media_manager />
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


{{--  <livewire:livewire.AdminControllers.MediaManagerComponent.list_media_manager />--}}
@endsection
