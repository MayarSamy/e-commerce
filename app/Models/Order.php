<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'Sub_Total',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_details',
            'order_id',
            'product_id'
        )
            ->withPivot('price', 'quantity', 'total')
            ->withTimestamps();
    }
}
