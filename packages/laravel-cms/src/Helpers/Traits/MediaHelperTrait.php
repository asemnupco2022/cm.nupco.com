<?php


namespace rifrocket\LaravelCms\Helpers\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Jobs\ImageProcessor;
use rifrocket\LaravelCms\LaravelCms;
use rifrocket\LaravelCms\Models\LbsMedia;
use rifrocket\LaravelCms\Models\LbsSetting;

trait MediaHelperTrait
{

    protected static $parentModel;

    public function __construct()
    {
        self::$parentModel = 'lbs_media';
    }

    public static function lbs_media_add($files, $prefix, $er_check = false)
    {
        try {

            if (!Auth::check()) {
                if ($er_check) {
                    return 'User Login is required';
                }
                return false;
            }

            $storageType = config('lbs-laravel-cms.application.storage');
            $suppImageExtension = config('lbs-laravel-cms.application.imageMedia');
            $fileExtension = $files->getClientOriginalExtension();
            $fileOriginalName = $files->getClientOriginalName();
            $saveFileName = $prefix . '_' . time() . '_.' . $fileExtension;

            $year = Carbon::now()->format('Y');
            $Month = Str::lower(Carbon::now()->format('M'));
            $date = Carbon::now()->format('d');
            $destinationPath = ('/uploads/' . $year . '/' . $Month . '/' . $date . '/');


            $savingData = [

                'title' => $fileOriginalName,
                'media_owners' => json_encode(["".Auth::user()->id.""]),
                'slug' => LaravelCmsFacade::lbs_slugGenerator(Str::of($fileOriginalName)->before('.'.$fileExtension), self::$parentModel),
                'media_year' => $year,
                'media_month' => $Month,
                'media_date' => $date,
                'media_path' => $destinationPath . $saveFileName,
                'media_thumbnail_default' => self::lbs_set_defaultMediaType($fileExtension),
                'media_extension'=>$fileExtension
            ];

            if (in_array($fileExtension, $suppImageExtension)) {

                //create media size cache if not exist
                if (!Cache::has('lbsImageSizes')) {
                    self::lbs_media_imageSizes();
                }

                //make directory if not exist
                $imageSizes = Cache::get('lbsImageSizes');
                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                //generate images
                $thumbImage=$destinationPath.$prefix . '_' . time() . '_150x150_.' . $fileExtension;
                $result=self::lbs_media_imageIntervention($files, $destinationPath . $saveFileName, $savingData, null,$thumbImage, $storageType, true);

                //if image need multiple sizes
                if ($result and is_numeric($result) and $imageSizes and !empty($imageSizes)){

                        $savingData['media_sibling']=$result;
                        ImageProcessor::dispatch($destinationPath . $saveFileName, $prefix, $destinationPath, $savingData);

                }
                return $result;
            }

            $files->storeAs($destinationPath, $saveFileName);
            return self::lbs_media_storeMediaData($savingData);

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }


    public static function lbs_media_imageIntervention($picture, $destinationPath, $savingData, array $size = null,$thumbImage=null, $storageType = null, $er_check = false)
    {

        try {
            $image = Image::make($picture);

            if ($size) {
                $image = $image->resize($size[0], $size[1]);

                if ($storageType) {

                    Storage::disk($storageType)->put($destinationPath, (string)$image->encode());
                    return self::lbs_media_storeMediaData($savingData, true);
                }

                Storage::put($destinationPath, (string)$image->encode());
                return self::lbs_media_storeMediaData($savingData, true);
            }
            else
            {
                if ($storageType) {

                    Storage::disk($storageType)->put($destinationPath, (string)$image->encode());
                    return self::lbs_media_storeMediaData($savingData, true);
                }

                Storage::put($destinationPath, (string)$image->encode());
                $savingData['media_thumbnail']= $thumbImage;
                self::lbs_media_storeMediaData($savingData, true);

                Storage::put($thumbImage, (string)$image->encode());
                $savingData['media_thumbnail']= null;
                $savingData['media_type']= LbsMedia::MEDIA_THUMBNAIL;
                self::lbs_media_storeMediaData($savingData, true);

            }



        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    public static function lbs_media_storeMediaData($requests, $er_check = false)
    {
        try {

            $validation = self::validationRules($requests);

            if (!$validation) {

                return $validation;
            }

            return LaravelCmsFacade::lbs_model_insertNew($requests, self::$parentModel);

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    protected static function validationRules($requests, $er_check = false)
    {
        try {

            $rules = [
                'title' => 'required|string',
                'media_owners' => 'required',
                'slug' => 'required|string',
                'media_year' => 'required|numeric',
                'media_month' => 'required|string',
                'media_date' => 'required|numeric',
                'media_path' => 'required',
            ];

            $validator = Validator::make($requests, $rules);
            if ($validator->fails()) {
                if ($er_check) {
                    return $validator->getMessageBag()->toArray();
                }
                return false;
            }
            return true;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    public function lbs_media_updateEntity($media_id, $col, $val)
    {
        return LbsMedia::find($media_id)->updated([$col => $val]);
    }


    protected static function lbs_media_imageSizes()
    {
        if (LaravelCmsFacade::lbs_object_key_exists('app_media_resize',Session::get('_LbsAppSession'))=='true'){
            $lbsApp = LbsSetting::AppSetting([LbsMedia::MEDIA_MINI, LbsMedia::MEDIA_MEDIUM, LbsMedia::MEDIA_LARGE]);
         return   Cache::store('file')->put('lbsImageSizes', $lbsApp, 600); // 10 Minutes
        }
        return Cache::store('file')->put('lbsImageSizes', null, 600); // 10 Minutes
    }


    protected static function lbs_set_defaultMediaType($extension)
    {
        $extension=Str::lower($extension);
        $suppImageExtension = config('lbs-laravel-cms.application.imageMedia');
        $suppVideoExtension = config('lbs-laravel-cms.application.videoMedia');
        if (in_array($extension, $suppImageExtension))
        {
            return LbsMedia::MEDIA_DEFAULT_IMAGE;
        }
        elseif ($extension=='pdf'){
            return LbsMedia::MEDIA_DEFAULT_PDF;
        }elseif(in_array($extension, $suppVideoExtension)){
            return LbsMedia::MEDIA_DEFAULT_VIDEO;
        }
        return LbsMedia::MEDIA_DEFAULT_DOC;
    }


    public static function lbs_txt_to_image(
        $text = 'DEV',
        array $bgColor = null,
        array $textColor = null,
        $fontSize = 25,
        $width = 150,
        $height = 150,
        $er_check = false
    )
    {
        try {

            if (empty($bgColor)) {
                $bgColor = LaravelCms::lbs_random_color();
            }

            if (empty($textColor)) {
                $textColor = LaravelCms::lbs_random_color($bgColor);
            }

            $font = public_path(LbsConstants::BASE_ADMIN_ASSETS . 'fonts/Lato-Black.ttf');

            $image = @imagecreate($width, $height)
            or die("Cannot Initialize new GD image stream");

            imagecolorallocate($image, $bgColor[0], $bgColor[1], $bgColor[2]);

            $fontColor = imagecolorallocate($image, $textColor[0], $textColor[1], $textColor[2]);

            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);

            $y = abs(ceil(($height - $textBoundingBox[5]) / 2));
            $x = abs(ceil(($width - $textBoundingBox[2]) / 2));

            imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $font, $text);

            return $image;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }


}
