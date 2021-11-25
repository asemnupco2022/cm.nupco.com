<?php

namespace App\Http\Controllers;

use App\Models\UserExportFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Models\LbsAdmin;

class UserExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $files = UserExportFiles::where('admin_id',auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('exportfile.index',compact('files'));
    }

    public function downloadFile(Request $request)
    {
        UserExportFiles::find($request->model)->update(['status'=>'read']);
        return Storage::disk('local')->download($request->path);
    }
}
