<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'bdm_lead_id',
        'activity_type',
        'activity_description',
        'created_by',
        'updated_by',
    ];

    public function Lead()
    {
        return $this->belongsTo(BdmLead::class, 'bdm_lead_id');
    }
}
