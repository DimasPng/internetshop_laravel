<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProductCharacteristic extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'product_product_characteristics';
    protected $guarded = false;
}
