<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_id' // Untuk relasi dengan produk
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
