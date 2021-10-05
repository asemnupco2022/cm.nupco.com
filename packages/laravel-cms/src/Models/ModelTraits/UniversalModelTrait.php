<?php
namespace rifrocket\LaravelCms\Models\ModelTraits;

use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

trait UniversalModelTrait
{
    public function scopeActive($query)
    {
        return $query->where('status',LbsConstants::STATUS_ACTIVE);
    }

    public function scopeNew($query)
    {
        return $query->where('status',LbsConstants::STATUS_NEW);
    }

    public function scopeNotDel($query)
    {
        return $query->where('deleted_at', null);
    }

    public function scopeOnlyActive($query)
    {
        return $query->where('status',LbsConstants::STATUS_ACTIVE)->where('deleted_at', null);
    }
    public function scopeOnlyDeactivated($query)
    {
        return $query->where('status',LbsConstants::STATUS_DEACTIVATE)->where('deleted_at', null);
    }
    public function scopeOnlySuspended($query)
    {
        return $query->where('status',LbsConstants::STATUS_SUSPENDED)->where('deleted_at', null);
    }

    public function scopeOnlyActiveUser($query, $email)
    {
        $message='pass';
        $member=$query->where('email',$email)->first();

        if (!$member){
           return $message = 'email address not exist.';
        }

        if ($member->deleted_at != null){
            return  $message='This account does not exist anymore';
        }
        if ($member->status != LbsConstants::STATUS_ACTIVE && $member->status != LbsConstants::STATUS_NEW){
            return  $message= 'your account has been '.$member->status;

        }
        return $message;

    }

    public function scopeCustomSearch($query,$column,$value, $operator)
    {

            switch ($operator){

                case LbsConstants::SEARCH_CONDTION_BEGINNING:
                    return $query->where($column,'LIKE',"{$value}%");
                    break;

                case LbsConstants::SEARCH_CONDTION_ANYWHERE:
                    return $query->where($column,'LIKE',"%{$value}%");
                    break;

                default:
                    return $query;

            }

    }




}
