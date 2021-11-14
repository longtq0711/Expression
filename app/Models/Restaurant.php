<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'location',
        'owner_id'
    ];

    public function owner() 
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
