<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantStepFourModel extends Model
{
    use HasFactory;
    protected $table = 'applicant_stepfour';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable =
    [
        'nik',
        'tokenreg',
        'creditcard',
        'bank_penerbit',
        'lama_kepemilikan_tahun',
        'lama_kepemilikan_bulan',
        'limit',
        'limit_number',
    ];
}
