<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'address_id',
        'name',
        'email',
        'phone',
        'address',
        'total',
        'payment_method',
        'payment_status',
        'transaction_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
        public function deliveryAddress()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
