<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryApplicantStepTwoModel extends Model
{
    use HasFactory;
    protected $table = 'history_applicant_steptwo';
    protected $primaryKey = 'nik';
    protected $keyType = 'int';
    protected $fillable =
    [
        'nik',
        'tokenreg',
        'nama_saudara',
        'alamat_saudara',
        'hubungan',
        'no_hp_saudara'
    ];
}
