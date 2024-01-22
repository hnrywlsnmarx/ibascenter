<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanModel extends Model
{
    use HasFactory;
    protected $table = 'master_pekerjaan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'kode_pekerjaan',
        'nama_pekerjaan'
    ];
}
