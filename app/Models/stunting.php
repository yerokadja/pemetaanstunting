<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stunting extends Model
{
    use HasFactory;

    protected  $guarded;
    protected  $keyType = 'string';
    protected  $primaryKey = 'id_stunting';
    protected  $table = 'stuntings';
    protected $fillable = ['kecamatan_id', 'jumlah_stunting', 'usia', 'berat_badan', 'tinggi_badan', 'tingkat_stunting'];
}
