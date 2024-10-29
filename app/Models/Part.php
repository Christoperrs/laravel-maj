<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Part extends Model
{
    use HasFactory;
    protected $table = 'parts';
    protected $fillable = [
        'name',
        'description',
        'qty',
        'status',
        'product_id',
        'created_by', 
        'updated_by',
        'qty_order',
        'qty_minimum'
    ];

    // Relasi belongsTo dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi many-to-many dengan Product melalui pivot 'detail_part'
    public function products()
    {
        return $this->belongsToMany(Product::class, 'detail_part', 'part_id', 'product_id')
                    ->withPivot('qty',  'status')
                    ->withTimestamps();
    }

    // Relasi dengan DetailPart
    public function detailParts()
    {
        return $this->hasMany(DetailPart::class, 'part_id');
    }

    // Relasi dengan Description
    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }

    // Otomatis set created_by dan updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function maintenanceDetails()
    {
        return $this->hasMany(MaintenanceDetail::class);
    }
}
