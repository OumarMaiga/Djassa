<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'firstname',
        'lastname',
        'email',
        'telephone',
        'quantity',
        'user_id',
        'paid',
        'delivered',
        'montant_du',
        'montant_payer',
    ];
}
