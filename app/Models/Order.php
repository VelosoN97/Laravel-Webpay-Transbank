<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy_order',
        'session_id',
        'amount',
        'status',
        'authorization_code',
        'payment_type',
        'transaction_date',
        'raw_response',
    ];

    protected $casts = [
        'raw_response' => 'array',
        'transaction_date' => 'datetime',
    ];
    
}
