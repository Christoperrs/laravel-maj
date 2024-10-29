<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPictureProduct extends Model
{
    use HasFactory;

    protected $table = 'detail_picture_product';

    protected $primaryKey = 'id_detail_gambar'; // Specify the primary key

    protected $fillable = [
        'path_gambar',
        'id_product',
    ];
}