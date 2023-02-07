<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'products', 'length' => 6, 'prefix' => 'PT-']);
        });
    }


        protected $fillable = [
            'product_name',
            'brand',
            'category_id',
            'price',
            'metric_units',
            'alert_stock',
        ];

        public $incrementing = false;
        
        public function category()
        {
            return $this->hasOne(Category::class,'category_id');
        }
}
