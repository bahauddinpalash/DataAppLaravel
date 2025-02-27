<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_type',
        'response_description',
        'received_by',
        'updated_by',
    ];

    /**
     * A candidate response belongs to a recruit lead.
     */
    public function recruitLead()
    {
        return $this->belongsTo(RecruitLead::class);
    }
}
