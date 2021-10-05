<?php

namespace rifrocket\LaravelCms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Models\LbsMedia;

class ImageProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $parentModel, $files, $prefix, $destinationPath, $savingData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($files, $prefix,$destinationPath,$savingData)
    {
        $this->files=$files;
        $this->prefix=$prefix;
        $this->destinationPath=$destinationPath;
        $this->savingData=$savingData;
        $this->parentModel = 'lbs_media';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageSizes = Cache::get('lbsImageSizes');
        $storageType = config('lbs-laravel-cms.application.storage');
        $exoloded=explode('.',$this->files);
        $file=Storage::disk('local')->path( $this->files);
        $fileExtension = end($exoloded);


        foreach ($imageSizes as $key => $imageSize){
            $saveFileName =  $this->prefix . '_' . time() . '_'.$imageSize.'_.' . $fileExtension;
            $this->savingData['slug']= $imageSize.'-'.$this->savingData['slug'];
            $this->savingData['media_type']= $key;
            LaravelCmsFacade::lbs_media_imageIntervention($file, $this->destinationPath . $saveFileName, $this->savingData, explode('x',$imageSize), $storageType);
        }
        return LbsMedia::find($this->savingData['media_sibling'])->updated(['media_sibling' =>$this->savingData['media_sibling']]);
    }
}
