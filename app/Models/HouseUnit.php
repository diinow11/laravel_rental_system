<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'unit_label',
        'type',
        'rent',
        'deposit',
        'water_utility',
        'electricity_utility',
        'bedrooms',
        'bathrooms',
        'kitchens',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
