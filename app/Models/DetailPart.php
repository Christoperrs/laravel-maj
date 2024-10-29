<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPart extends Model
{
    use HasFactory;
    protected $table = 'detail_part';
    protected $fillable = [
        'product_id',
        'part_id',
        'qty',
        'status',
        'created_by',
        'updated_by',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
