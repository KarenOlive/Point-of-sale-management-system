<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'orders', 'length' => 8, 'prefix' => 'ODR-']);
        });
    }

    protected $fillable = [
        'name',
        'products',
        'quantity',
        'unitprice',
        'total_cost',
        'discount',

    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
