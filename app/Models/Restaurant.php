<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'restaurants';

    protected $appends = ['slug', 'ordersSlug'];

    protected $fillable = [
        'name',
        'location',
        'owner_id'
    ];

    public function owner() 
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'resto_id');
    }

    public function getSlugAttribute() 
    {
        return route('restos.menu', $this->id);
    }

    public function getOrdersSlugAttribute() 
    {
        return route('restos.orders', $this->id);
    }
}
