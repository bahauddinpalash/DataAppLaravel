<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruit_lead_id', 'activity_type', 'activity_description', 'created_by', 'updated_by'
    ];

    /**
     * A recruit activity belongs to a recruit lead.
     */
    public function Lead()
    {
        return $this->belongsTo(RecruitLead::class, 'recruit_lead_id');
    }
}
