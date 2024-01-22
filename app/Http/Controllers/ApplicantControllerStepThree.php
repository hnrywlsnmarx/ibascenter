<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepThreeModel;
use App\Models\HistoryApplicantStepThreeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicantControllerStepThree extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $master_pekerjaan = DB::table('master_pekerjaan')
            ->get();

        $master_jabatan = DB::table('master_jabatan')
            ->get();
        $master_bidang_usaha = DB::table('master_bidang_usaha')
            ->get();


        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ctStepThree = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepThree == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepThreeModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('flag_lock', null)
                ->count();
        }

        

        if ($ctStepThree == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $stepthree = '';
            $pekerjaan = '';
            $jabatan = '';
            $bidang_usaha = '';
            $nama_perusahaan = '';
            $lama_bekerja_tahun = '';
            $lama_bekerja_bulan = '';
            $alamat_kantor = '';
            $tel_kantor = '';
            $sumber_penghasilan = '';
            $penghasilan_perbulan = '';
            $penghasilan_perbulan_number = '';
            $have_bws_acc = '';
            $acc_no = '';
        } else {
            $stepthree = ApplicantStepThreeModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                ->get();
            foreach ($stepthree as $st) {
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $pekerjaan = $st->pekerjaan;
                $jabatan = $st->jabatan;
                $bidang_usaha = $st->bidang_usaha;
                $nama_perusahaan = $st->nama_perusahaan;
                $lama_bekerja_tahun = $st->lama_bekerja_tahun;
                $lama_bekerja_bulan = $st->lama_bekerja_bulan;
                $alamat_kantor = $st->alamat_kantor;
                $tel_kantor = $st->tel_kantor;
                $sumber_penghasilan = $st->sumber_penghasilan;
                $penghasilan_perbulan = $st->penghasilan_perbulan;
                $penghasilan_perbulan_number = $st->penghasilan_perbulan_number;
                $have_bws_acc = $st->have_bws_acc;
                $acc_no = $st->acc_no;
            }
        }

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step Three',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.stepthree',
            [
                'master_bidang_usaha' => $master_bidang_usaha,
                'master_pekerjaan' => $master_pekerjaan,
                'master_jabatan' => $master_jabatan,
                'stepthree' => $stepthree,
                'ctStepThree' => $ctStepThree,
                'checkLock' => $checkLock,
                'nik' => $nik,
                'tokenreg' => $tokenreg,
                'pekerjaan' => $pekerjaan,
                'jabatan' => $jabatan,
                'bidang_usaha' => $bidang_usaha,
                'nama_perusahaan' => $nama_perusahaan,
                'lama_bekerja_tahun' => $lama_bekerja_tahun,
                'lama_bekerja_bulan' => $lama_bekerja_bulan,
                'alamat_kantor' => $alamat_kantor,
                'tel_kantor' => $tel_kantor,
                'sumber_penghasilan' => $sumber_penghasilan,
                'penghasilan_perbulan' => $penghasilan_perbulan,
                'penghasilan_perbulan_number' => $penghasilan_perbulan_number,
                'have_bws_acc' => $have_bws_acc,
                'acc_no' => $acc_no
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
            'pekerjaan' => 'required',
            'jabatan' => 'required_if:pekerjaan,Karyawan Swasta,Karyawan BUMN,ASN,Buruh/Outsource,Lainnya',
            'bidang_usaha' => 'required_if:pekerjaan,==,Profesional/Pengusaha',
            'nama_perusahaan' => 'required',
            'lama_bekerja_tahun' => 'required',
            'lama_bekerja_bulan' => 'required',
            'alamat_kantor' => 'required',
            'tel_kantor' => 'required',
            'sumber_penghasilan' => 'required',
            'penghasilan_perbulan' => 'required',
            'penghasilan_perbulan_number' => 'required',
            'have_bws_acc' => 'required',
            'acc_no' => 'required'
        ]);

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step Three',
                'status' => 'Failed',
                'caused_by' => 'Field not Filled',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            ApplicantStepThreeModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data in E-Form Step Three',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepThreeModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Create History Profile in E-Form Step Three',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('stepfour.index');
        }
    }

    public function update(Request $request, ApplicantStepThreeModel $stepthree)
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
            'pekerjaan' => 'required',
            'jabatan' => 'required_if:pekerjaan,Karyawan Swasta,Karyawan BUMN,ASN,Buruh/Outsource,Lainnya',
            'bidang_usaha' => 'required_if:pekerjaan,==,Profesional/Pengusaha',
            'nama_perusahaan' => 'required',
            'lama_bekerja_tahun' => 'required',
            'lama_bekerja_bulan' => 'required',
            'alamat_kantor' => 'required',
            'tel_kantor' => 'required',
            'sumber_penghasilan' => 'required',
            'penghasilan_perbulan' => 'required',
            'penghasilan_perbulan_number' => 'required',
            'have_bws_acc' => 'required',
            'acc_no' => 'required'

        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step Three',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $stepthree->update($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data in E-Form Step Three',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepThreeModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Profile in E-Form Step Three',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('stepfour.index');
        }
    }
}
