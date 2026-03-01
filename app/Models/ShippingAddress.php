<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone',
        'address',
        'city',
        'district',
        'ward',
        'is_default'
    ];

    public function getFullAddressAttribute()
    {
        return $this->address . ', ' .
            $this->ward . ', ' .
            $this->district . ', ' .
            $this->city;
    }
}

