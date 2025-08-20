<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsWithModel extends Model
{
    use HasFactory;

    protected $table = 'products_with_models';

    protected $fillable = [
        'category_id',
        'image',
    ];
}
