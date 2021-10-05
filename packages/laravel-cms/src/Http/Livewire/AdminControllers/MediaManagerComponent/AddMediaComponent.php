<?php


namespace rifrocket\LaravelCms\Http\Livewire\AdminControllers\MediaManagerComponent;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class AddMediaComponent extends Component
{

    use WithFileUploads;


    public $mediaFile=null;


    public function updatedMediaFile($values)
    {
        $tumps='';
        foreach ($values as $value){
//            LaravelCmsFacade::lbs_media_add($value, 'test');
            $tumps .=LaravelCmsFacade::lbs_media_add($value, 'test', true).'\n';
        }
        dump($tumps);
    }

    public function mount()
    {

//        dd(Str::of('image.jpg')->before('.jpg'));
        $savingData = [

            'title' => '$fileOriginalName',
            'media_owners' => 1,
            'slug' => 'dasd-adas-das-das-das-das-d-asd',
            'media_year' => 2021,
            'media_month' => 'jun',
            'media_date' => 28,
            'media_path' => 'dadsda/dasdasd/asdasdasdas.jpg',
        ];
//        dd( LaravelCmsFacade::lbs_media_storeMediaData($savingData,true));
//        dd(Auth::user()->id);
//        $checkExistingSlug="this-is-my-dummy-slug-2";
//        $tmpArray=explode('-',$checkExistingSlug);
//        $lastIndex=end($tmpArray);
//        if (is_numeric($lastIndex)){
//            dd($lastIndex+1);
//        }
//        dd('failed');
    }


    public function render()
    {
        return view('LbsViews::livewire.AdminComponent.MediaManagerComponent.add_media_manager');
    }
}
