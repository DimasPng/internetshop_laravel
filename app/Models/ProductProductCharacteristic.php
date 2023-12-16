<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProductCharacteristic extends Model
{
    use HasFactory;
    protected $table = 'product_product_characteristics';
    protected $guarded = false;
}
