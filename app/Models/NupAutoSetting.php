<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class NupAutoSetting extends Model
{
    use HasFactory,UniversalModelTrait;

    protected $fillable
    = [
        'setting_for_table',
        'first_notification',
        'second_notification',
        'thired_notification',
        'fourth_notification',
        'supply_ratio',
        'setting_switch',
        'test_email',
    ];

    const CONS_COLUMNS = [
        'setting_for_table'=>true,
        'first_notification'=>true,
        'second_notification'=>true,
        'thired_notification'=>true,
        'fourth_notification'=>true,
        'supply_ratio'=>true,
        'setting_switch'=>true,
        'test_email' => true,
    ];
}
