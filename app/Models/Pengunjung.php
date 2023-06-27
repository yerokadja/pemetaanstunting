<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Pengunjung extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected  $guarded;
    protected  $keyType     = 'string';
    protected  $primaryKey  = 'id_pengunjung';
    protected  $table       = 'pengunjungs';
    protected $fillable     = ['nama', 'tempat_lahir', 'tanggal_lahir', 'email', 'password'];
    protected $hidden = [
        'password',
    ];
}
