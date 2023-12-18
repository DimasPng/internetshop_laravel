<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCharacteristic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_characteristics';
    protected $guarded = false;
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_characteristics', 'product_characteristic_id', 'product_id');
    }

}
