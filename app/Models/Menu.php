<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'description',
        'price', 
        'category_id',
        'resto_id'
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}
