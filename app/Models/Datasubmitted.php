<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Datasubmitted extends Model
{
    use HasFactory;
    protected $table = 'datasubmitted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idarea',
        'nik',
        'nama',
        'jk',
        'usia',
        'rt',
        'rw',
        'tps',
        'ket',
        'created_by',
        'updated_by',
    ];
}
