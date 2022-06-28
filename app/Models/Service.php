<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        'beneficiaire',
        'telephone',
        'montant',
        'user_id',
        'expire',
        'paid',
        'etat',
    ];
}
