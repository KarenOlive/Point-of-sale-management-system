<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'purchases', 'length' => 8, 'prefix' => 'PCH-']);
        });
    }

    protected $fillable = [
        'supplier_id',
        'product',
        'quantity',
        'cost',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
