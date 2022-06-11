<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'overview',
        'email',
        'telephone',
        'price',
        'user_id',
        'quantity',
        'published',
        'category_id',
    ];
        
    public function files()
    {
        return $this->hasMany('App\File', 'product_id');
    }
}
