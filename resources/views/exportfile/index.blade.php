@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Export Files</h3>

            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Date</th>
                  <th>File</th>
                  <th>Status</th>
                  <th>Download</th>
                </tr>
              </thead>
              <tbody>
                  @if ($files and !$files->isEmpty())

                    @foreach ($files as $file)
                        <tr>
                        <td>{{$file->adminInfo->display_name}}</td>
                        <td>{{\Carbon\Carbon::parse($file->created_at)->toDateTimeString()}}</td>
                        <td>{{$file->file_name}}</td>
                        <td>{{$file->status}}</td>
                        <td><a href="{{route('web.route.export.downloadFile',['path'=>$file->file_path,'model'=>$file->id])}}" target="_blank"><i class="fas fa-download"></i></a></td>
                      </tr>
                    @endforeach

                  @endif

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->

          <div class="card-footer clearfix">
            @if($files)
            <span class=" badge badge-danger row-count-badge">{{ $files->total()}}</span>
            @endif
            <ul class="pagination pagination-sm m-0 float-right">

                @if($files)
                {{$files->links()}}
                @endif
            </ul>
        </div>
    </div>
    <!-- /.card -->


@endsection
