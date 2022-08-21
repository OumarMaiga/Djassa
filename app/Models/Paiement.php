<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'montant',
        'user_id',
        'service_id',
        'commande_id',
        'etat',
        'from',
        'currency',
        'description',
        'transaction_id',
        'channels',
        'customer_name',
        'customer_surname',
        'customer_email',
        'customer_phone_number',
        'customer_address',
        'customer_city',
        'customer_country',
        'customer_state',
        'customer_zip_code'
    ];
}
