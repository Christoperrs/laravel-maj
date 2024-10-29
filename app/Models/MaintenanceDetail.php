<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'maintenance_id',
        'part_id',
        'description_id',
        'condition',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function description()
    {
        return $this->belongsTo(Description::class);
    }
}
