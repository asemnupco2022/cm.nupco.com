<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class SupplierCommentTypes extends Model
{
    use HasFactory,UniversalModelTrait;

    use LogsActivity;
    const LOG_NAME='LOG SUPPLIER COMMENT';
    protected static $logName = SchedulerNotificationHistory::LOG_NAME;

    public static function supplierCommets()
    {
         return SupplierCommentTypes::OnlyActive()->pluck('comment','comment');
    }
}
