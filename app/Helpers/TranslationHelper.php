<?php


namespace App\Helpers;


use App\Models\LbsTranslation;
use Illuminate\Support\Facades\App;

class TranslationHelper
{
    static function  translate($key, $lang = null, $lang_model=null, $lang_model_name=null){
        if($lang == null){
            $lang = App::getLocale();
        }

        $translation_def = LbsTranslation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('lang_key', $key)->first();
        if($translation_def == null){
            $translation_def = new LbsTranslation;
            $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
            $translation_def->lang_key = $key;
            $translation_def->lang_value = $key;

            if($lang_model){
                $translation_def->lang_model = $lang_model;
            }
            if($lang_model_name){
                $translation_def->lang_model_name = $lang_model_name;
            }
            $translation_def->save();
        }

        //Check for session lang
        $translation_locale = LbsTranslation::where('lang_key', $key)->where('lang', $lang);

        if($lang_model){
            $translation_locale = $translation_locale->where('lang_model', $lang_model);
        }
        if($lang_model_name){
            $translation_locale = $translation_locale->where('lang_model_name', $lang_model_name);
        }
        $translation_locale = $translation_locale->first();

        if($translation_locale != null && $translation_locale->lang_value != null){
            return $translation_locale->lang_value;
        }
        elseif($translation_def->lang_value != null){
            return $translation_def->lang_value;
        }
        else{
            return $key;
        }
    }

}
