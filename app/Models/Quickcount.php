<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Quickcount extends Model
{
    use HasFactory;
    protected $table = 'quick_count';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notps',
        'desa',
        'nama_saksi',
        'suara_ibas',
        'suara_masuk',
        'suara_sah',
        'suara_abstain',
        'suara_tidak_sah',
        'path',
        'foto_c1',
        'foto_c1_1',
        'foto_c1_2',
        'foto_c1_3',
        'created_by',
    ];
}
