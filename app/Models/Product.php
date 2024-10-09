<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    // Menambahkan relasi ke model Part
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
    
    public function maintenanceParts()
    {
        return $this->hasMany(MaintenancePart::class);
    }
}