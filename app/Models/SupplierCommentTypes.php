<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class SupplierCommentTypes extends Model
{
    use HasFactory,UniversalModelTrait;

    public static function supplierCommets()
    {
         return SupplierCommentTypes::OnlyActive()->pluck('comment','comment');
    }
}
