<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BdmLead extends Model
{
    use HasFactory;
    // protected $table = 'bdmleads';  
    protected $fillable = [
        'client_id',
        'lead_status',
        'client_meeting',
        'created_by',
        'updated_by',
        'remark',
    ];
    protected $casts = [
        'client_meeting' => 'datetime',  // This ensures client_meeting is treated as a Carbon object
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function salesActivities()
    {
        return $this->hasMany(SalesActivity::class);
    }

    public function clientResponses()
    {
        return $this->hasMany(ClientResponse::class);
    }
}
