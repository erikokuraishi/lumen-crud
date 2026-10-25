<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Product -> nama tabel otomatis = products

    // kolom yang boleh diisi
    protected $fillable = array(
        'name',
        'sku',
        'description',
        'category',
        'brand',
        'price',
        'stock',
        'status'
    );

    // untuk melakukan update field created_at dan updated_at secara otomatis
    public $timestamps = true;
}