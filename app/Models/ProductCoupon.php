<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCoupon extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $casts = [
       'start_date' => 'datetime',
        'expire_date' => 'datetime',
    ];

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    protected $searchable = [
        'columns' => [
            'product_coupons.code' => 10,
            'product_coupons.description' => 10,
        ],
    ];

}
