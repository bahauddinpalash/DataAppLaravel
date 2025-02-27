<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'bdm_lead_id',
        'response_type',
        'response_description',
        'received_by',
        'updated_by',
    ];

    public function bdmLead()
    {
        return $this->belongsTo(BdmLead::class);
    }
}
