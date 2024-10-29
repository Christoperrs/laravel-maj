<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $table = 'penanggulangan_problems'; // Define the table name

    protected $fillable = [
        'Id_dies',
        'shift_problem',
        'penanggulangan',
        'item_penggantian',
        'qty',
        'pic',
        'progres',
        'status',
        'approved_foreman',
        'approved_section',
    ];

    public function foreman()
    {
        return $this->belongsTo(User::class, 'approved_foreman', 'id');
    }

    // Define the relationship to the user for the section approver
    public function section()
    {
        return $this->belongsTo(User::class, 'approved_section', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'pic', 'id'); // Mengaitkan kolom 'pic' dengan 'id' di tabel users
    }
    
    // Define relationship with Product (assuming Id_dies is product_id)
    public function product()
    {
        return $this->belongsTo(Product::class, 'Id_dies', 'id');
    }

    // Define relationship with Part (assuming item_penggantian is part_id)
    public function part()
    {
        return $this->belongsTo(Part::class, 'item_penggantian', 'id');
    }
}
