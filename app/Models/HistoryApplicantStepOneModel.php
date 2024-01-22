<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryApplicantStepOneModel extends Model
{
    use HasFactory;
    protected $table = 'history_applicant_stepone';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    // public $incrementing = false;
    protected $fillable =
    [
        'nik',
        'tokenreg',
        'kk_stone',
        'nama',
        'npwp_stone',
        'no_hp',
        'mother_name',
        'tempat_lahir',
        'tgl_lahir',
        'marital_status',
        'julah_tanggungan',
        'alamat',
        'desa',
        'kecamatan',
        'kabupatenkota',
        'provinsi',
        'kodepos',
        'housing',
        'los_year',
        'los_month'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
