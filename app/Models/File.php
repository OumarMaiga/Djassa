<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libelle',
        'file_path',
        'type',
        'product_id',
        'user_id',
        'rayon_id',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'service_id',
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
