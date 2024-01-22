<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepOneModel;
use App\Models\HistoryApplicantStepOneModel;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class ApplicantControllerStepOne extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {

        $master_housing = DB::table('master_housing')
            ->get();

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $kabupatenkota = session('kabupatenkota');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        // dd($checkLock);

        $ctStepOne = ApplicantStepOneModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepOne == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepOneModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('flag_lock', null)
                ->count();
        }

        if ($ctStepOne == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $kk_stone = '';
            $nama = session('name');
            $no_hp = session('no_hp');
            $npwp_stone = '';
            $stepone = '';
            $mother_name = '';
            $tempat_lahir = '';
            $tgl_lahir = '';
            $marital_status = '';
            $julah_tanggungan = '';
            $alamat = '';
            $rt = '';
            $rw = '';
            $desa = '';
            $kecamatan = '';
            $kabupatenkota = session('kabupatenkota');
            $provinsi = '';
            $kodepos = '';
            $housing = '';
            $los_year = '';
            $los_month = '';

            $master_provinsi = DB::table('provinces')
                ->get();

            $master_kabupaten = DB::table('regencies')
                ->get();

            $kabid =  DB::table('regencies')
                ->select('id')
                ->where('name', 'like', '%' . $kabupatenkota . '%')
                ->pluck('id');
            // dd($kabid);

            $master_kecamatan = DB::table('districts')
                ->whereIn('regency_id', $kabid)
                ->get();
            // dd($master_kecamatan);

            $kecid =  DB::table('districts')
                ->select('id')
                ->where('name', 'like', '%' . $kecamatan . '%')
                ->pluck('id');

            // dd($kecid);

            $master_kelurahan = DB::table('villages')
                ->whereIn('district_id', $kecid)
                ->get();
            // dd($master_kelurahan);
        } else {
            // dd($nik);
            $stepone = ApplicantStepOneModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                ->get();
            foreach ($stepone as $st) {

                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $kk_stone = $st->kk_stone;
                $nama = $st->nama;
                $no_hp = $st->no_hp;
                $npwp_stone = $st->npwp_stone;
                $mother_name = $st->mother_name;
                $tempat_lahir = $st->tempat_lahir;
                $tgl_lahir = $st->tgl_lahir;
                $marital_status = $st->marital_status;
                $julah_tanggungan = $st->julah_tanggungan;
                $alamat = $st->alamat;
                $rt = $st->rt;
                $rw = $st->rw;
                $desa = $st->desa;
                $kecamatan = $st->kecamatan;
                $kabupatenkota = $st->kabupatenkota;
                $provinsi = $st->provinsi;
                $kodepos = $st->kodepos;
                $housing = $st->housing;
                $los_year = $st->los_year;
                $los_month = $st->los_month;
            }

            $master_provinsi = DB::table('provinces')
                ->get();

            $provid = DB::table('provinces')
                ->select('id')
                ->where('name', 'like', '%' . $provinsi . '%')
                ->pluck('id')->first();
            // dd($provid);

            $master_kabupaten = DB::table('regencies')
                ->where('province_id', $provid)
                ->get();
            // dd($master_kabupaten);

            $kabid =  DB::table('regencies')
                ->select('id')
                ->where('name', 'like', '%' . $kabupatenkota . '%')
                ->pluck('id');
            // dd($kabid);

            $master_kecamatan = DB::table('districts')
                ->whereIn('regency_id', $kabid)
                ->get();
            // dd($master_kecamatan);

            $kecid =  DB::table('districts')
                ->select('id')
                ->where('name', 'like', '%' . $kecamatan . '%')
                ->pluck('id');

            // dd($kecid);

            $master_kelurahan = DB::table('villages')
                ->whereIn('district_id', $kecid)
                ->get();
            // dd($master_kelurahan);
        }

        // dd($provinsi);

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step One',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.stepone',
            [
                'master_provinsi' => $master_provinsi,
                'master_kabupaten' => $master_kabupaten,
                'master_kecamatan' => $master_kecamatan,
                'master_kelurahan' => $master_kelurahan,
                'master_housing' => $master_housing,
                'ctStepOne' => $ctStepOne,
                'stepone' => $stepone,
                'nik' => $nik,
                'kk_stone' => $kk_stone,
                'tokenreg' => $tokenreg,
                'nama' => $nama,
                'no_hp' => $no_hp,
                'npwp_stone' => $npwp_stone,
                'mother_name' => $mother_name,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tgl_lahir,
                'marital_status' => $marital_status,
                'julah_tanggungan' => $julah_tanggungan,
                'alamat' => $alamat,
                'rt' => $rt,
                'rw' => $rw,
                'desa' => $desa,
                'kecamatan' => $kecamatan,
                'kabupatenkota' => $kabupatenkota,
                'provinsi' => $provinsi,
                'kodepos' => $kodepos,
                'housing' => $housing,
                'los_year' => $los_year,
                'los_month' => $los_month,
                'checkLock' => $checkLock
            ]
        );
    }

    public function store(Request $request)
    {

        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'kk_stone' => 'required',
            'tokenreg' => 'required',
            'nama' => 'required',
            'npwp_stone' => 'required',
            'no_hp' => 'required',
            'mother_name' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir_hid' => 'required',
            'marital_status' => 'required',
            'julah_tanggungan' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupatenkota' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required',
            'housing' => 'required',
            'los_year' => 'required',
            'los_month' => 'required'
        ]);

        if ($validator->fails()) {
            // $errorString = implode(",",$validator->messages()->all());
            // dd($validator->errors());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step One',
                'status' => 'Failed',
                'caused_by' => "Validator Error",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            ApplicantStepOneModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step One',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepOneModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Create History Profile in E-Form Step One',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('steptwo.index');
        }
    }

    public function update(Request $request, ApplicantStepOneModel $stepone)
    {
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'kk_stone' => 'required',
            'tokenreg' => 'required',
            'nama' => 'required',
            'npwp_stone' => 'required',
            'no_hp' => 'required',
            'mother_name' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'marital_status' => 'required',
            'julah_tanggungan' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupatenkota' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required',
            'housing' => 'required',
            'los_year' => 'required',
            'los_month' => 'required'
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step One',
                'status' => 'Failed',
                'caused_by' => "Validator Error",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $stepone->update($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step One',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepOneModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Profile in E-Form Step One',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('steptwo.index');
        }
    }
}
