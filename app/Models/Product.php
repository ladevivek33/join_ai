<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'pname',
        'price',
        'qty',
        'image',
    ];
}
