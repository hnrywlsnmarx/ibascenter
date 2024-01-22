<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryApplicantStepUploadModel extends Model
{
    use HasFactory;
    protected $table = 'history_applicant_stepupload';
    protected $primaryKey = 'nik';
    protected $keyType = 'int';
    protected $fillable =
    [
        'nik',
        'tokenreg',
        'path_prim',
        'path_supp',
        'copyktp',
        'npwp',
        'kk',
        'slip_gaji',
        'mutasirekening',
        'sip',
        'siup',
        'billingcc',
    ];
}
