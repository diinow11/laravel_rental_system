<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function tenant()
{
    return $this->belongsTo(Tenant::class);
}

protected $fillable = [
    'tenant_id',
    'phone_number',
    'apartment',
    'house_unit',
    'rent_amount',
    'water_utility',
    'electricity_utility',
    'amount_due',
    'amount_paid',
    'due_date',
    'payment_status',
];

}
