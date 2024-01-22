<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankModel extends Model
{
    use HasFactory;
    protected $table = 'master_bank';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'kode_bank',
        'nama_bank'
    ];
}
