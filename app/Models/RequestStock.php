<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStock extends Model
{
    use HasFactory;

    protected $table = 'request_stock'; // Specify the table name

    protected $fillable = ['id_part', 'qty_order', 'created_by', 'status'];

    public function part()
    {
        return $this->belongsTo(Part::class, 'id_part');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}