<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'logo',
        'address',
        'client_service_number',
        'created_by',
        'updated_by',
        'remarks',
    ];

    public function leads()
    {
        return $this->hasMany(BdmLead::class);
    }
}
