<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function characteristics()
    {
        return $this->belongsToMany(ProductCharacteristic::class, 'product_product_characteristics', 'product_id', 'product_characteristic_id')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }


    public function getImageUrlAttribute()
    {
        $images = [];

        foreach (json_decode($this->images) as $image) {
            $images[] = url('storage/' . $image);
        }

        return $images;
    }

}
