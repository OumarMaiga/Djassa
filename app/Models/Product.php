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
        'price',
        'user_id',
        'quantity',
        'published',
        'rayon_id',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'discount',
        'poids',
        'poids_unite_mesure',
        'litre',
        'litre_unite_mesure',
        'marque',
        'composition',
        'emballage',
        'pays_production',
        'conservation',
        'valeur_nutritionnelle',
        'sodium',
        'potassium',
        'magnesium',
        'fluorure',
        'silicium_siO2',
        'cendres',
        'bicarbonate',
        'sels_minéraux_totaux_sels_minéraux',
        'nitrate',
        'strontium',
        'sulfate',
        'designation_legale',
        'distributeur',
        'numero_article',
        'duree_conservation',
    ];

    public function discount_price()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }
        
    public function files()
    {
        return $this->hasMany('App\File', 'product_id');
    }
}
