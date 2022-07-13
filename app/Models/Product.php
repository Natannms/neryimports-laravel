<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'price',
        'image',
        'category_id',
        'short_description',
        'long_description',
        'rate',
        'imageSrc',
        'imageAlt',
        'href',
        'brand',
    ];
}
