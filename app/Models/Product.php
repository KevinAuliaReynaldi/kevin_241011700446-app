<?php

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
        'Stock',
        'image'
    ];

    protected $casts = [
        'Price' => 'integer',
        'Stock' => 'integer'
    ];

    // Method untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return $this->getDefaultImageUrl();
        }

        // Cek file di public/images/products/
        $path = public_path('images/products/' . $this->image);
        if (file_exists($path)) {
            return asset('images/products/' . $this->image);
        }

        // Jika tidak ditemukan, return default berdasarkan nama produk
        return $this->getProductDefaultImage();
    }

    // Method untuk default image berdasarkan nama produk
    protected function getProductDefaultImage()
    {
        $productName = strtolower($this->Name);
        
        if (str_contains($productName, 'pertamax turbo')) {
            return 'https://via.placeholder.com/150/FF6B6B/FFFFFF?text=Pertamax+Turbo';
        } elseif (str_contains($productName, 'pertamax')) {
            return 'https://via.placeholder.com/150/4ECDC4/FFFFFF?text=Pertamax';
        } elseif (str_contains($productName, 'pertalite')) {
            return 'https://via.placeholder.com/150/45B7D1/FFFFFF?text=Pertalite';
        } elseif (str_contains($productName, 'solar')) {
            return 'https://via.placeholder.com/150/96CEB4/FFFFFF?text=Solar';
        } elseif (str_contains($productName, 'pertamax plus')) {
            return 'https://via.placeholder.com/150/F7DC6F/FFFFFF?text=Pertamax+Plus';
        } else {
            return 'https://via.placeholder.com/150/CCCCCC/FFFFFF?text=No+Image';
        }
    }

    // Method default image generic
    protected function getDefaultImageUrl()
    {
        return 'https://via.placeholder.com/150/CCCCCC/FFFFFF?text=No+Image';
    }

    // Append image_url ke response JSON
    protected $appends = ['image_url'];

    // Format response JSON
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->Name,
            'description' => $this->Description,
            'price' => $this->Price,
            'stock' => $this->Stock,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}