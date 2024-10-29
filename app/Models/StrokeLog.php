<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrokeLog extends Model
{
    use HasFactory;

    protected $fillable = ['part_no', 'machine', 'process', 'current_stroke', 'accumulative_stroke', 'log_date', 'status']; // Add 'status' here
}


