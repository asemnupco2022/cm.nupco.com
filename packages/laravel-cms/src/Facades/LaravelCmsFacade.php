<?php

namespace rifrocket\LaravelCms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static lbs_apiResponceFormat($response_code=null,$response_status=null,$response_message=null,$response_body=null)
 * @method static lbs_apiResponceDescription(array $Excluded_Records, array $Error_Records, $Passed_Records=null , $Failed_Records=null)
 * @method static lbs_random_generator( $sting_length, $numeric = true, $upper_case = false, $lover_case = false, $er_check = false)
 * @method static lbs_multi_array_merge($toMerge, $original)
 * @method static lbs_object_key_exists($key, $objCollection, $er_check = false)
 * @method static lbs_array_key_exists($key, $arrayCollection, $er_check = false)
 * @method static lbs_model_provider($model, $status, $pluck = null, $er_check = false)
 * @method static lbs_update_model_provider(array $model_data, $model_id = null, $er_check = false)
 * @method static lbs_filterMetaOnly($request, $meta = false)
 * @method static lbs_filterSpecialTags($request, $SpecialChar, $onlySpecial=null)
 * @method static lbs_metaData_update($model_id, $request, $model, $metaKey, $metaValue)
 * @method static lbs_model_insertNew($request, $model)
 * @method static lbs_model_update($model_id, $request, $model)
 * @method static lbs_model_status_change($model_id, $request, $model, $is_deleted=false)
 * @method static lbs_list_model_data($request, $model, $specialChar=null)
 * @method static lbs_list_model_meta_data($model, array $request, array $restrictFilters, array $isNotFilters, $withMeta=false,$customSearch=null,$groupBy=null, array $paginate=null)
 * @method static lbs_get_meta($request,$model,$met_rel_key)
 * @method static lbs_set_meta($request,$model,$met_rel_key)
 * @method static lbs_basic_upload_files($file, array $checks, $path)
 * @method static lbs_Insert_Taxonomies($request, $model)
 * @method static lbs_update_Taxonomies($request, $model)
 * @method static lbs_paginate($items, $perPage = 5, $page = null, $options = [])
 * @method static lbs_login($model, array $requests,$redirect,$guard)
 * @method static lsb_logout($guard,$redirect)
 * @method static lbs_getUserInfo($model,$requests)
 * @method static lbs_forgetPassword($model,$requests)
 * @method static lbs_restPassword($model,$requests,$guard,$redirect)
 * @method static lbs_userSession($guard,$model)
 * @method static lbs_get_LteSettingInfo($model, array $requests)
 */
class LaravelCmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'laravel-cms';
    }
}
