<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'house_unit_id',
        'name',
        'email',
        'phone',
        'id_number',
        'tenancy_agreement',
        'scanned_id',
    ];

    protected $hidden = [
        'remember_token',
    ];



    public function apartment()
    {
        return $this->belongsTo(\App\Models\Apartment::class);
    }

    public function houseUnit()
    {
        return $this->belongsTo(\App\Models\HouseUnit::class);
    }

    public function invoices()
{
    return $this->hasMany(\App\Models\Invoice::class);
}
}
