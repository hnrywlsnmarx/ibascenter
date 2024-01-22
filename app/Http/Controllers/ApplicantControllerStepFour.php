<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepFourModel;
use App\Models\HistoryApplicantStepFourModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicantControllerStepFour extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $master_bank = DB::table('master_bank')
            ->get();

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ctStepFour = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepFour == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepFourModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('flag_lock', null)
                ->count();
        }

        // dd($checkLock);

        // dd($checkLock);

        $tablestepfour = ApplicantStepFourModel::where('nik', '=', $nik)
            ->where('tokenreg', '=', $tokenreg)
            // ->where('id', $id)
            ->get();

        $idstepfour = ApplicantStepFourModel::where('nik', '=', $nik)
            ->where('tokenreg', '=', $tokenreg)
            ->select('id')
            ->pluck('id');

        if ($ctStepFour == 0) {
            $id = '';
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $stepfour = '';
            $creditcard = '';
            $bank_penerbit = '';
            $lama_kepemilikan_tahun = '';
            $lama_kepemilikan_bulan = '';
            $limit = '';
            $limit_number = '';
        } else {
            $stepfour = ApplicantStepFourModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                ->get();
            foreach ($stepfour as $st) {
                $id = $st->id;
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $creditcard = $st->creditcard;
                $bank_penerbit = $st->bank_penerbit;
                $lama_kepemilikan_tahun = $st->lama_kepemilikan_tahun;
                $lama_kepemilikan_bulan = $st->lama_kepemilikan_bulan;
                $limit = $st->limit;
                $limit_number = $st->limit_number;
            }

            // dd($limit);
        }

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step Four',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.stepfour',
            [
                'master_bank' => $master_bank,
                'stepfour' => $stepfour,
                'tablestepfour' => $tablestepfour,
                'ctStepFour' => $ctStepFour,
                'checkLock' => $checkLock,
                'id' => $id,
                'nik' => $nik,
                'tokenreg' => $tokenreg,
                'creditcard' => $creditcard,
                'bank_penerbit' => $bank_penerbit,
                'lama_kepemilikan_tahun' => $lama_kepemilikan_tahun,
                'lama_kepemilikan_bulan' => $lama_kepemilikan_bulan,
                'limit' => $limit,
                'limit_number' => $limit_number
            ]
        );
    }

    public function edit(Request $request, ApplicantStepFourModel $stepfour)
    {
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $master_bank = DB::table('master_bank')
            ->get();

        $bank_penerbit = DB::table('master_bank')
            ->select('kode_bank')
            ->where('kode_bank', $stepfour->bank_penerbit)
            ->pluck('kode_bank')->first();

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing Edit E-Form Step Four',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.editstepfour',
            [
                'stepfour' => $stepfour,
                'master_bank' => $master_bank,
                'bank_penerbit' => $bank_penerbit
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
        $bank = $request->bank_penerbit;
        $url = $request->fullUrl();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'creditcard' => 'required',
            'bank_penerbit' => 'required',
            'lama_kepemilikan_tahun' => 'required',
            'lama_kepemilikan_bulan' => 'required',
            'limit' => 'required',
            'limit_number' => 'required'
        ]);

        // $data = [];

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data ' . $bank . ' in E-Form Step Four',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            ApplicantStepFourModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data ' . $bank . ' in E-Form Step Four',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepFourModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Create History Profile in E-Form Step Four',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Data tersimpan');
        }
    }

    public function update(Request $request, ApplicantStepFourModel $stepfour)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $bank = $request->bank_penerbit;
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        // dd($bank);
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            // 'creditcard' => 'required',
            'bank_penerbit' => 'required',
            'lama_kepemilikan_tahun' => 'required',
            'lama_kepemilikan_bulan' => 'required',
            'limit' => 'required',
            'limit_number' => 'required'

        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data ' . $bank . ' in E-Form Step Four',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $stepfour->update($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data ' . $bank . ' in E-Form Step Four',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepFourModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Profile in E-Form Step Four',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Update sukses');
        }
    }
}
