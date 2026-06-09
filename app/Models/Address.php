<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'city',
        'state',
        'country',
         'email',
        'pincode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}