<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenancePart extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'part_id', 'condition', 'user_id', 'checked_at', 'note'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
