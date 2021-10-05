<?php


namespace rifrocket\LaravelCms\Helpers\Traits;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Exception;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

trait TaxonomiesHelperTrait
{

    public static function lbs_Insert_Taxonomies($request, $model)
    {

        try {
            $request = Arr::only($request, [
                'category_name',
                'is_parent',
                'category_parents',
                'slug',
                'taxonomies_owner_model',
                'taxonomies_meta',
                'taxonomies_options',
                'json_data','status','suspendReason','deleted_at','created_at','updated_at'
            ]);

            $rules=[
                'category_name'=>'required',
            ];

            $validator = Validator::make($request, $rules);
            if ($validator->fails())
            {
                return $Error_Records=$validator->getMessageBag()->toArray();

            }

            $modelProvider = LaravelCmsFacade::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, $er_check = false);
            if (! $modelProvider and empty($modelProvider)) {
                return $response_messages= 'No model Found';
            }

            $checktaxonomies = $modelProvider->model_path::where('taxonomies_owner_model',$request['taxonomies_owner_model'])->where('category_name',$request['category_name'])->first();

            if ($checktaxonomies and !empty($checktaxonomies)){
                return $response_messages= 'No data Found';
            }

            $slugId= $modelProvider->model_path::orderBy('id','desc')->first();
            if ($slugId){

                $slug=Str::slug($request['category_name'],'-');
                $slugId->id=$slugId->id+1;
                $request['slug']=$slug.'-'.$slugId->id;
            }
            else{

                $slug=Str::slug($request['category_name'],'-');
                $request['slug']=$slug.'-1';
            }

            return LaravelCmsFacade::lbs_model_insertNew($request, $model);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public static function lbs_update_Taxonomies($request, $model)
    {
        try {

            $request = Arr::only($request, [
                'id',
                'category_name',
                'is_parent',
                'category_parents',
                'slug',
                'taxonomies_owner_model',
                'taxonomies_meta',
                'taxonomies_options',
                'json_data','status','suspendReason','deleted_at','created_at','updated_at'
            ]);

            $rules=[
                'id'=>'required|numeric',
                'category_name'=>'required',
            ];

            $validator = Validator::make($request, $rules);
            if ($validator->fails())
            {
                return $Error_Records=$validator->getMessageBag()->toArray();

            }
            $modelProvider = LaravelCmsFacade::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, $er_check = false);

            if (! $modelProvider and empty($modelProvider)) {

                return $response_messages= 'No model Found';
            }

            $UniqueValid=$modelProvider->model_path::where('taxonomies_owner_model',$request['taxonomies_owner_model'])->where('category_name',$request['category_name'])->first();
            if (!empty($UniqueValid) and $UniqueValid->id !=$request['id']){

               return $Error_Records[]=['title'=>'The Category Name has already been taken.'];
            }

            $slug=Str::slug($request['category_name'],'-');
            $request['slug']=$slug.'-'.$request['id'];

            return LaravelCmsFacade::lbs_model_update($request['id'], $request, $model);
        } catch (Exception $exception) {

          return  $exception->getMessage();
        }
    }

    public static function fetch_Stringify_Taxonomies($request, $model)
    {
        //code...
    }
}
