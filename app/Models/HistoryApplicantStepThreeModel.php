<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryApplicantStepThreeModel extends Model
{
    use HasFactory;
    protected $table = 'history_applicant_stepthree';
    protected $primaryKey = 'nik';
    protected $keyType = 'int';

    protected $fillable =
    [
        'nik',
        'tokenreg',
        'pekerjaan',
        'jabatan',
        'bidang_usaha',
        'nama_perusahaan',
        'lama_bekerja_tahun',
        'lama_bekerja_bulan',
        'alamat_kantor',
        'tel_kantor',
        'sumber_penghasilan',
        'penghasilan_perbulan',
        'penghasilan_perbulan_number',
    ];

    public function pekerjaans()
    {
      return $this->belongsTo('App\Models\PekerjaanModel');
    }
  
    public function hasPekerjaan($pekerjaan)
    {
      if ($this->pekerjaans()->where('master_pekerjaan', $pekerjaan)->first()) {
        return true;
      }
      return false;
    }

}
