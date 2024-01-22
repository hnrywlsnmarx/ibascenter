<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepTwoModel;
use App\Models\HistoryApplicantStepTwoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicantControllerStepTwo extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $master_keluarga = DB::table('master_keluarga')
            ->get();

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ctStepTwo = ApplicantStepTwoModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepTwo == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepTwoModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('flag_lock', null)
                ->count();
        }

        if ($ctStepTwo == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $nama_saudara = '';
            $alamat_saudara = '';
            $no_hp_saudara = '';
            $steptwo = '';
            $hubungan = '';
        } else {
            $steptwo = ApplicantStepTwoModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                ->get();
            foreach ($steptwo as $st) {
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $nama_saudara = $st->nama_saudara;
                $alamat_saudara = $st->alamat_saudara;
                $no_hp_saudara = $st->no_hp_saudara;
                $hubungan = $st->hubungan;
            }
        }

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step Two',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.steptwo',
            [
                'ctStepTwo' => $ctStepTwo,
                'steptwo' => $steptwo,
                'nik' => $nik,
                'tokenreg' => $tokenreg,
                'nama_saudara' => $nama_saudara,
                'alamat_saudara' => $alamat_saudara,
                'no_hp_saudara' => $no_hp_saudara,
                'master_keluarga' => $master_keluarga,
                'hubungan' => $hubungan,
                'checkLock' => $checkLock
            ]
        );
    }

    public function store(Request $request)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'nama_saudara' => 'required',
            'hubungan' => 'required',
            'alamat_saudara' => 'required',
            'no_hp_saudara' => 'required'
        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step Two',
                'status' => 'Failed',
                'caused_by' => "Validator Error",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            ApplicantStepTwoModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step Two',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepTwoModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Create History Profile in E-Form Step Two',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('stepthree.index');
        }
    }

    public function update(Request $request, ApplicantStepTwoModel $steptwo)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'nama_saudara' => 'required',
            'alamat_saudara' => 'required',
            'no_hp_saudara' => 'required'
        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step Two',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $steptwo->update($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step Two',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepTwoModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Profile in E-Form Step Two',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('stepthree.index');
        }
    }
}
