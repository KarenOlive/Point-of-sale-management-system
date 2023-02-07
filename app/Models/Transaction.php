<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IdAsUuidTrait;

class Transaction extends Model
{

    use IdAsUuidTrait;
    protected $fillable = [

        'order_id',
        'totalamount',
        'amount_paid',
        'change',
        'payment_method',
        'user_id',
        'purchase_id',
    ];

    protected $keyType = 'string';


}
