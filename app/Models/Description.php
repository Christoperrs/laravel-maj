<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'description',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
