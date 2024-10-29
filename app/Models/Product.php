<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'line', 
        'barcode', 
        'image', 
        'customer', 
        'model', 
        'part_no', 
        'no_job', 
        'process', 
        'machine', 
        'tension',
        'frequency_production',
        'created_by', 
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
    

    // Relasi hasMany dengan Part
    public function parts()
    {
        return $this->belongsToMany(Part::class, 'detail_part', 'product_id', 'part_id')
                    ->withPivot('qty', 'status')
                    ->withTimestamps();
    }

    public function detailPictures()
    {
        return $this->hasMany(DetailPictureProduct::class, 'id_product');
    }
    // Relasi dengan Maintenance
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
    public function detailParts()
    {
        return $this->hasMany(DetailPart::class, 'product_id');
    }

}
