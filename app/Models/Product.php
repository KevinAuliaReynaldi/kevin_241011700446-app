<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Description', 
        'Price',
        'Stock'
    ];

    protected $casts = [
        'Price' => 'integer',
        'Stock' => 'integer'
    ];
}