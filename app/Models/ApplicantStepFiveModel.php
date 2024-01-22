<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantStepFiveModel extends Model
{
    use HasFactory;
    protected $table = 'applicant_stepfive';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable =
    [
        'nik',
        'tokenreg',
        'tgl_input',
        'ref_no',
        'kabupatenkota',
        'produk_pinjaman',
        'jumlah_pinjaman',
        'jumlah_pinjaman_number',
        'jangka_waktu',
        'tujuan_pinjaman',
        'angsuran_perbulan',
        'angsuran_perbulan_number',
        'flag_approval',
        'flag_disbursement',
    ];
}
