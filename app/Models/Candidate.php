<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'contact_number', 'total_experience', 'relevant_experience', 'current_salary', 
        'expected_salary', 'highest_qualification', 'notice_period', 'interview_availability', 
        'marital_status', 'visa_type', 'visa_expiry_date', 'current_location', 'job_change_reason', 
        'nationality', 'age', 'cv', 'position', 'created_by', 'updated_by'
    ];

    /**
     * A candidate can have many recruit leads.
     */
    public function recruitLeads()
    {
        return $this->hasMany(RecruitLead::class);
    }
}
