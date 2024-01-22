<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifitasModel extends Model
{
    use HasFactory;
    protected $table = 't_log_aktifitas_internal';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'nik',
        'email',
        'ip_address',
        'nama',
        'url',
        'action',
        'status',
        'caused_by'
    ];
}
