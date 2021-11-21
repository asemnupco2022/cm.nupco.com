<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class PoSapMasterTmp extends Model
{
    use HasFactory, UniversalModelTrait;

    protected $fillable = [
        "table_type",
        "po_number",
        "po_item",
        "unique_hash",
        "execution_done",
        "supplier_comment",
        "notified",
        "unique_line",
        "meta",
        "json_data",
        "status",
        "suspendReason",
    ];

    public function sapMasterTmp()
    {
       return $this->belongsTo(PoSapMaster::class, 'unique_line', 'unique_line');
    }
}
