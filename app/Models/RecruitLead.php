<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id', 'lead_status', 'candidate_meeting', 'created_by', 'updated_by', 'remark', 'position'
    ];

    /**
     * A recruit lead belongs to a candidate.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    /**
     * A recruit lead can have many recruit activities.
     */
    public function recruitActivities()
    {
        return $this->hasMany(RecruitActivity::class);
    }

    public function candidateResponses()
    {
        return $this->hasMany(CandidateResponse::class);
    }
}
