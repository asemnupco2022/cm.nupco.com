<?php


namespace rifrocket\LaravelCms\Helpers\Traits;

use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsModelProvider;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Exception;

trait CoreHelperTrait
{

    public static function lbs_apiResponseFormat($response_code = null, $response_status = null, $response_message = null, $response_description = null, $response_body = null)
    {
        $response['response_code'] = $response_code;
        $response['response_status'] = $response_status;
        $response['response_message'] = $response_message;
        $response['response_description'] = $response_description;
        $response['response_body'] = $response_body;

        return $response;
    }

    public static function lbs_apiResponseDescription(array $Excluded_Records, array $Error_Records, $Passed_Records = null, $Failed_Records = null)
    {
        $Passed_Records = $Passed_Records == null ? 0 : $Passed_Records;
        $Failed_Records = $Failed_Records == null ? 0 : $Failed_Records;

        $response['Passed_Records'] = $Passed_Records;
        $response['Failed_Records'] = $Failed_Records;
        $response['Excluded_Records'] = $Excluded_Records;
        $response['Error_Records'] = $Error_Records;

        return $response;
    }

    public static function lbs_random_generator($sting_length, $numeric = true, $upper_case = false, $lover_case = false, $er_check = false)
    {
        try {
            if ($numeric == false and $upper_case == false and $lover_case == false) {
                return false;
            }
            $numeric_sting = '';
            $upper_case_sting = '';
            $lover_case_sting = '';
            if ($numeric) {
                $numeric_sting = '123456789';
            }
            if ($upper_case) {
                $upper_case_sting = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            if ($lover_case) {
                $lover_case_sting = 'abcdefghijklmnopqrstuwxyz';
            }
            $compare_string = $numeric_sting . $upper_case_sting . $lover_case_sting;
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($compare_string) - 1; //put the length -1 in cache
            for ($i = 0; $i < $sting_length; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $compare_string[$n];
            }
            return implode($pass); //turn the array into a string
        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }


    public static function lbs_random_color(array $reverse = null, $hex = false, $er_check = false)
    {
        try {

            if ($reverse and is_array($reverse)) {

                $rvsColor = ($reverse[0] * 0.299 + $reverse[1] * 0.587 + $reverse[2] * 0.114) > 186
                    ? [0, 0, 0]
                    : [255, 255, 255];

                if ($hex) {
                    return sprintf("#%02x%02x%02x", $rvsColor[0], $rvsColor[1], $rvsColor[2]);
                }
                return $rvsColor;
            }

            //Generate reverse color from given color code
            $rgbColor = [];
            foreach (array(0, 1, 2) as $color) {
                //Generate a random number between 0 and 255.
                $rgbColor[$color] = mt_rand(0, 255);
            }
            if ($hex) {
                return sprintf("#%02x%02x%02x", $rgbColor[0], $rgbColor[1], $rgbColor[2]);
            }
            return $rgbColor;

        } catch (\Exception $exception) {

            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }


    public static function lbs_slugGenerator($title, $model, $er_check = false)
    {
        try {

            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }
            $generateSlug = $slug = Str::slug($title, '-');

            if ($checkExistingSlug = $modelProvider->model_path::where('slug', 'LIKE', '%' . $generateSlug . '%')->orderBy('id', 'desc')->exists()) {
                $checkExistingSlug = $modelProvider->model_path::where('slug', 'LIKE', '%' . $generateSlug . '%')->orderBy('id', 'desc')->first();
                $tmpArray = explode('-', $checkExistingSlug->slug);
                $lastIndex = end($tmpArray);
                if (is_numeric($lastIndex)) {
                     $lastIndex += 1;
                } else {
                    $lastIndex = 1;
                }
                return Str::slug($title, '-') . '-' . $lastIndex;
            }

            return $generateSlug;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    public static function lbs_multi_array_merge($toMerge, $original, $er_check = false)
    {
        try {

            $outPut = [];
            foreach ($original as $key => $value) {
                if (isset($toMerge[$key])) {
                    $outPut[$key] = array_merge($value, $toMerge[$key]);
                } else {
                    $outPut[$key] = $value;
                }
            }
            return $outPut;

        } catch (\Exception $exception) {

            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    public static function lbs_object_key_exists($key, $objCollection, $er_check = false)
    {
        try {
            if (property_exists($objCollection, $key)) {
                return $objCollection->{$key};
            }
        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
        return null;

    }

    public static function lbs_array_key_exists($key, $arrayCollection, $er_check = false)
    {
        try {
            return array_key_exists($key, $arrayCollection) ? true : false;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_model_provider($model, $status, $pluck = null, $er_check = false)
    {
        try {
            if (!empty($model) and $model) {
                if (LbsModelProvider::where('model', $model)->exists()) {
                    $model_provider = LbsModelProvider::where('model', $model)->where('status', $status)->first();
                }
                if (!empty($pluck) and $pluck) {
                    $model_provider = $model_provider->{$pluck};
                }
                return $model_provider;
            }
            return [];

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return [];
        }
    }

    public static function lbs_update_model_provider(array $model_data, $model_id = null, $er_check = false)
    {
        try {
            if (!empty($model_id) and $model_id) {
                $update = LbsModelProvider::find($model_id);
            } else {
                $update = new LbsModelProvider();
            }
            if (!empty($model_data) and $model_data) {
                foreach ($model_data as $key => $extract_model) {
                    $update->{$key} = $extract_model;
                }
                if ($update->save()) {
                    return trans('LCBFlash.Information_saved_successfully');
                }
                return trans('LCBFlash.Error_while_saving_information');
            }
            return trans('LCBFlash.Oops_something_went_wrong');

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_filterMetaOnly($request, $meta = false, $er_check = false)
    {

        try {
            $datas = collect($request);

            if (!$meta and empty($meta)) {

                $filtered = $datas->filter(function ($value, $key) {
                    $exploaded = explode('_', $key);
                    $exists = Arr::exists(LbsConstants::SPECIAL_CHAR_ARRAY, $exploaded[0]);
                    if (!$exists) {
                        return $value;
                    }
                });

            } else {

                $filtered = $datas->filter(function ($value, $key) {
                    $exploaded = explode('_', $key);
                    if ($exploaded[0] == "meta") {
                        return $value;
                    }
                });
            }
            return $filtered;
        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return [];
        }
    }

    public static function lbs_filterSpecialTags($request, $SpecialChar, $onlySpecial = null, $er_check = false)
    {
        try {
            $datas = collect($request);

            if (!$onlySpecial and empty($onlySpecial)) {

                $filtered = $datas->filter(function ($value, $key) use ($SpecialChar) {
                    $exploaded = explode('_', $key);
                    $exists = Arr::exists(LbsConstants::SPECIAL_CHAR_ARRAY, $exploaded[0]);
                    if ($exploaded[0] != $SpecialChar and !$exists) {
                        return $value;
                    }
                });

            } else {

                $filtered = $datas->filter(function ($value, $key) use ($SpecialChar) {
                    $exploaded = explode('_', $key);
                    if ($exploaded[0] == $SpecialChar) {
                        return $value;
                    }
                });
            }
            return $filtered;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return [];
        }

    }


    public static function lbs_model_insertNew($request, $model, $er_check = false)
    {

        $Excluded_Records = [];
        $response_body = null;
        try {
            $modelData = self::lbs_filterMetaOnly($request);
            $metaData = self::lbs_filterMetaOnly($request, true);

            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);

            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }

            if ($modelData and !empty($modelData) and !empty($modelProvider)) {
                $insertModel = new $modelProvider->model_path();
                foreach ($modelData as $key => $value) {
                    if (!Schema::hasColumn($modelProvider->model_tb_name, $key)) {
                        $Excluded_Records[] = $key;
//                        $Failed_Records++;
                        continue;
                    }
                    $insertModel->{$key} = $value;
                }
                $insertModel->save();
            }

            if ($metaData and !empty($metaData) and !empty($modelProvider) and !empty($modelProvider->meta_path)) {
                foreach ($metaData as $metaKey => $metaValue) {
                    $insertMeta = new $modelProvider->meta_path();
                    $insertMeta->{$modelProvider->meta_rel_key} = $insertModel->id;
                    $insertMeta->meta_key = $metaKey;
                    $insertMeta->meta_value = $metaValue;
                    $insertMeta->provider = $modelProvider->model;
                    $insertMeta->save();
                }

            }

            return  $insertModel->id;
//            return self::lbs_list_model_meta_data($model, ['id' => $insertModel->id], [], []);
        } catch (Exception $exception) {

            if ($insertModel->id) {
                $modelProvider->model_path::find($insertModel->id)->delete();
                $modelProvider->meta_path::where($modelProvider->meta_rel_key, $insertModel->id)->where('provider', $modelProvider->model)->delete();
            }
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_model_update($model_id, $request, $model, $er_check = false)
    {
        $Excluded_Records = [];
        $response_body = null;
        $findModel = [];

        try {

            $modelData = self::lbs_filterMetaOnly($request);
            $metaData = self::lbs_filterMetaOnly($request, true);

            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }

            if ($modelData and !empty($modelData) and !empty($modelProvider)) {
                $findModel = $modelProvider->model_path::find($model_id);
                if ($findModel and !empty($findModel)) {
                    foreach ($modelData as $key => $value) {
                        if ($key == 'id') {
                            continue;
                        }
                        if (!Schema::hasColumn($modelProvider->model_tb_name, $key)) {
                            $Excluded_Records[] = $key;
                            continue;
                        }
                        $findModel->{$key} = $value;
                    }
                    $findModel->save();
                }
            }

            if ($metaData and !empty($metaData) and !empty($modelProvider) and !empty($modelProvider->meta_path)) {
                foreach ($metaData as $metaKey => $metaValue) {
                    $updateMeta = $modelProvider->meta_path:: where($modelProvider->meta_rel_key, $findModel->id)
                        ->where('provider', $modelProvider->model)
                        ->where('meta_key', $metaKey)->first();

                    if ($updateMeta and !empty($updateMeta)) {

                        $updateMeta->meta_value = $metaValue;
                        $updateMeta->save();
                    } else {
                        $insertMeta = new $modelProvider->meta_path();
                        $insertMeta->{$modelProvider->meta_rel_key} = $model_id;
                        $insertMeta->meta_key = $metaKey;
                        $insertMeta->meta_value = $metaValue;
                        $insertMeta->provider = $modelProvider->model;
                        $insertMeta->save();
                    }
                }
            }

            return $findModel;

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }


    public static function lbs_model_meta_update($model_id, $model, $metaKey, $metaValue, $er_check = false)
    {
        try {
            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {

                if (empty($modelProvider->meta_path)) {
                    if ($er_check) {
                        return 'No model Found';
                    } else {
                        return false;
                    }
                }
            }

            $check = $modelProvider->meta_path::where($modelProvider->meta_rel_key, $model_id)
                ->where('provider', $modelProvider->model)
                ->where('meta_key', $metaKey)->first();
            if ($check and !empty($check)) {

                $check->meta_value = $metaValue;
                $check->save();
                return $check->id;

            } else {
                $insertMeta = new $modelProvider->meta_path();
                $insertMeta->{$modelProvider->meta_rel_key} = $model_id;
                $insertMeta->meta_key = $metaKey;
                $insertMeta->meta_value = $metaValue;
                $insertMeta->provider = $modelProvider->model;
                $insertMeta->save();
                return $insertMeta->id;
            }

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_model_status_change($model_id, $request, $model, $is_deleted = false, $er_check = false)
    {
        try {

            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }

            $findModel = $modelProvider->model_path::find($model_id);

            if (empty($findModel)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }

            if ($is_deleted and !empty($is_deleted)) {

                $findModel->deleted_at = Carbon::now();
                $findModel->save();

                if (!empty($modelProvider->meta_path)) {
                    $findMetaData = $modelProvider->meta_path:: where($modelProvider->meta_rel_key, $model_id)->where('provider', $modelProvider->model)->get();
                    if ($findMetaData and !empty($findMetaData)) {

                        foreach ($findMetaData as $key => $metakey) {
                            $updateModelMeta = $modelProvider->meta_path::find($metakey->id);
                            $updateModelMeta->deleted_at = Carbon::now();
                            $updateModelMeta->save();
                        }
                    }
                }
                return 'Record Deleted Successfully.';
            }

            if ($request and !empty($request)) {

                $coll = (object)collect($request)->all();

                if (Arr::has($request, 'restore') and $coll->restore and !empty($coll->restore)) {

                    $findModel = $modelProvider->model_path::find($model_id);
                    $findModel->deleted_at = null;
                    $findModel->save();

                    if (!empty($modelProvider->meta_path)) {
                        $findMetaData = $modelProvider->meta_path:: where($modelProvider->meta_rel_key, $model_id)->where('provider', $modelProvider->model)->get();
                        if ($findMetaData and !empty($findMetaData)) {

                            foreach ($findMetaData as $key => $metakey) {
                                $updateModelMeta = $modelProvider->meta_path::find($metakey->id);
                                $updateModelMeta->deleted_at = null;
                                $updateModelMeta->save();
                            }
                        }
                    }
                }
                $findModel->status = $coll->status;
                $findModel->save();

                if (!empty($modelProvider->meta_path)) {
                    $findMetaData = $modelProvider->meta_path::where($modelProvider->meta_rel_key, $model_id)->where('provider', $modelProvider->model)->get();
                    if ($findMetaData and !empty($findMetaData)) {

                        foreach ($findMetaData as $key => $metakey) {
                            $updateModelMeta = $modelProvider->meta_path::find($metakey->id);
                            $updateModelMeta->status = $coll->status;
                            $updateModelMeta->save();
                        }
                    }
                }

                return 'Record Updated Successfully.';

            }

            if ($er_check) {
                return 'Something went wrong';
            }
            return false;


        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_list_model_meta_data($model, array $request, array $restrictFilters, array $isNotFilters, $withMeta = false, $customSearch = null, $groupBy = null, array $paginate = null, $er_check = false)
    {
        $Excluded_Records = [];
        $response_body = null;

        try {

            $filterPlucksArray = [];

            $baseFilters = self::lbs_filterMetaOnly($request, false);
            $filterPlucks = self::lbs_filterSpecialTags($request, 'pluck', true);

            if ($filterPlucks and !empty($filterPlucks)) {
                foreach ($filterPlucks as $pluckKey => $pluckValue) {
                    $specialKeys = str_replace('pluck_', '', $pluckKey);
                    array_push($filterPlucksArray, $specialKeys);
                }
            }

            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }

            $Collection = $modelProvider->model_path::orderBy('id', 'DESC');

            if ($baseFilters and !empty($baseFilters)) {

                foreach ($baseFilters as $baseKeys => $baseValues) {

                    if (!Schema::hasColumn($modelProvider->model_tb_name, $baseKeys)) {
                        // continue loop with testing for this column
                        $Excluded_Records[] = $baseKeys;
                        continue;
                    }
                    $baseValues = $baseValues == 'null' ? null : $baseValues;
                    $where = [];
                    $where[] = [$baseKeys, $baseValues];
                    $Collection = $Collection->where($where);

                }
            }

            if ($isNotFilters and !empty($isNotFilters)) {

                foreach ($isNotFilters as $isNotKeys => $isNotValues) {

                    if (!Schema::hasColumn($modelProvider->model_tb_name, $isNotKeys)) {
                        // continue loop with testing for this column
                        $Excluded_Records[] = $baseKeys;
                        continue;
                    }
                    $isNotValues = $isNotValues == 'null' ? null : $isNotValues;
                    $where = [];
                    $where[] = [$isNotKeys, '!=', $isNotValues];
                    $Collection = $Collection->where($where);

                }
            }

            if ($customSearch and !empty($customSearch)) {
                $column = $customSearch['column'];
                $value = $customSearch['value'];
                $operator = $customSearch['operator'];
                $Collection = $Collection->CustomSearch($column, $value, $operator);
            }


            $Collection = $Collection->get()->toArray();
            if ($withMeta and !empty($withMeta)) {

                $innerArray = [];

                foreach ($Collection as $modelKey => $modelValue) {
                    $modeArray = $modelProvider->model_path::find($modelValue['id'])->toArray();

                    if ($modelProvider->meta_path and !empty($modelProvider->meta_path)) {

                        $metaData = $modelProvider->meta_path::where($modelProvider->meta_rel_key, $modelValue['id'])->get();

                        if ($metaData and !empty($metaData)) {
                            $metaArray = [];
                            foreach ($metaData as $metaKey => $metaValue) {
                                $metaArray[$metaValue->meta_key] = $metaValue->meta_value;
                            }
                            $init = array_merge($modeArray, $metaArray);
                            array_push($innerArray, $init);
                        }
                    }
                }

                $Collection = collect($innerArray);

            }

            if ($filterPlucksArray and !empty($filterPlucksArray)) {
                $Collection = collect($Collection);
                $Collection = $Collection->map(function ($item) use ($filterPlucksArray) {
                    return Arr::only($item, $filterPlucksArray);
                });
            }

            if ($restrictFilters and !empty($restrictFilters)) {
                $Collection = collect($Collection);
                $Collection = $Collection->map(function ($item) use ($restrictFilters) {
                    return Arr::except($item, $restrictFilters);
                });
            }

            if ($groupBy and !empty($groupBy)) {
                $Collection = collect($Collection);
                $Collection = $Collection->groupBy($groupBy);
            }

            if ($paginate and !empty($paginate)) {
                $Collection = collect($Collection);
                $Collection = $Collection->forPage($paginate['pageNo'], $paginate['perPage']); //Filter the page var
            }

            return $Collection = collect($Collection);

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }
    }

    public static function lbs_paginate($items, $perPage = 5, $page = null, $options = [], $er_check = false)
    {
        try {

            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            $items = $items instanceof Collection ? $items : Collection::make($items);
            return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }


    public static function lbs_get_model_key($request_key, $model, $model_id, $er_check = false)
    {
        try {
            $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
            if (!$modelProvider and empty($modelProvider)) {
                if ($er_check) {
                    return 'No model Found';
                } else {
                    return false;
                }
            }
            return $modelProvider->model_path::find($model_id)->{$request_key};
        } catch (\Exception $exception) {
            if ($er_check) {
                return $exception->getMessage();
            }
            return false;
        }

    }

    public static function lbs_get_meta($request, $model, $met_rel_key, $er_check = false)
    {
        $metaData = self::lbs_filterMetaOnly($request, true);
        $responseArray = [];
        $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
        if (!$modelProvider and empty($modelProvider)) {
            if ($er_check) {

                return 'No model Found';
            } else {
                return false;
            }
        }
        if (!empty($modelProvider->meta_path)) {
            if ($metaData and !empty($metaData)) {
                foreach ($metaData as $metaKey => $metaValue) {

                    $findMetaData = $modelProvider->meta_path::
                    where($modelProvider->meta_rel_key, $met_rel_key)
                        ->where('provider', $modelProvider->model)
                        ->where('meta_key', $metaKey)->first();
                    if ($findMetaData and !empty($findMetaData)) {
                        array_push($responseArray, [$metaKey => $findMetaData->meta_value]);
                    }
                }
                return $responseArray;
            }
        }
        return $responseArray;
    }

    public static function lbs_set_meta($request, $model, $met_rel_key, $er_check = false)
    {
        $metaData = self::lbs_filterMetaOnly($request, true);
        $modelProvider = self::lbs_model_provider($model, LbsConstants::STATUS_ACTIVE, $pluck = null, true);
        if (!$modelProvider and empty($modelProvider)) {
            if ($er_check) {
                return 'No model Found';
            } else {
                return false;
            }
        }
        if (!empty($modelProvider->meta_path)) {

            if ($metaData and !empty($metaData)) {
                foreach ($metaData as $metaKey => $metaValue) {

                    $insertMeta = new $modelProvider->meta_path();
                    $insertMeta->{$modelProvider->meta_rel_key} = $met_rel_key;
                    $insertMeta->meta_key = $metaKey;
                    $insertMeta->meta_value = $metaValue;
                    $insertMeta->provider = $modelProvider->model;
                    $insertMeta->save();
                }
                return 'pass';
            }
        }
        return null;
    }

}
