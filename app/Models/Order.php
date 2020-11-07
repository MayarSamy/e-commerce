<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //protected $primaryKey = 'order_id';

    protected $fillable = [
        'sub_Total',
        'user_id',
        'grand-Total',
        'discounts'
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
            'product_id',
            'product_name'
        )
            ->withPivot('price', 'quantity', 'total')
            ->withTimestamps();
    }
}
