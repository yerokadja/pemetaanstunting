<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_cluster extends Model
{
    use HasFactory;
    protected  $guarded;
    protected  $keyType = 'string';
    protected  $primaryKey = 'id_hasil ';
    protected  $table = 'hasil_clusters';
}
