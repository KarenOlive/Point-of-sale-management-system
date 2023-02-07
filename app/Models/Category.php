<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->code = IdGenerator::generate(['table' => 'categories', 'field'=> 'code', 'length'=> 6, 'prefix'=> 'CT-']);
    //     });
    // }

    protected $fillable = [
        'category_name',

    ];
public function products()
{
    return $this->belongsTo(Product::class,'category_id');
}
}
