<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $casts = [
        'order_details' => 'array'
    ];
    
    protected $fillable = [
        'resto_id',
        'user_id',
        'amount',
        'isComplete',
        'order_details'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'resto_id');
    }
}
