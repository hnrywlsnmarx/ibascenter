<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepFiveModel;
use App\Models\ApplicantStepFourModel;
use App\Models\ApplicantStepOneModel;
use App\Models\ApplicantStepThreeModel;
use App\Models\ApplicantStepTwoModel;
use App\Models\HistoryApplicantStepFiveModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicantControllerStepFive extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ayeuna = Carbon::now();
        $yeuh = $ayeuna->format('Ymd');

        $product_kta = DB::table('master_product_kta')
            ->get();

        $master_bunga = DB::table('master_bunga')
            ->get();

        $nik = session('nik');
        $tokenreg = session('tokenreg');
        // $jenis_produk = $request->input('jns');
        // dd($jenis_produk);

        $tgl_input = '';

        $ctStepFive = ApplicantStepFiveModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $kabupatenkota = ApplicantStepOneModel::select('kabupatenkota')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('kabupatenkota')->first();

        $pekerjaan = ApplicantStepThreeModel::select('pekerjaan')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $ref_no = ApplicantStepFiveModel::select('ref_no')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('ref_no')->last();
        // dd($ref_no);

        $ktaapa = ApplicantStepFiveModel::select('produk_pinjaman')
            ->where('nik', $nik)
            ->where('ref_no', $ref_no)
            ->pluck('produk_pinjaman')->last();
        // dd($ktaapa);

        $ctDBR = 0;

        if ($ktaapa == 'KTA Retail') {
            $ctDBR = DB::table('dbr_usaha')
                ->where('ref_no', $ref_no)
                ->count();
        } else if ($ktaapa == 'KTA Payroll') {
            $ctDBR = DB::table('dbr_kta')
                ->where('ref_no', $ref_no)
                ->count();
        }

        // dd($ctDBR);

        if ($ctStepFive == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepFiveModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('ref_no', $ref_no)
                ->where('flag_lock', null)
                ->count();
        }

        $apprref_no =  DB::table('applicant_approval_status')
            ->select('ref_no')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('ref_no');
        // dd($apprref_no);

        $appr = DB::table('applicant_approval_status')
            ->where('ref_no', $ref_no)
            // ->where('flag_approval', 1)
            ->count();

        // dd($appr);

        if ($ctStepFive == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $ref_no = $ref_no;
            $appr = $appr;
            $apprref_no = $apprref_no;
            $kabupatenkota = $kabupatenkota;
            $pekerjaan = $pekerjaan;
            $tgl_input = '';
            $stepfive = '';
            $ctst = 0;
            $ctstret = 0;
            $produk_pinjaman = '';
            $jumlah_pinjaman = '';
            $jumlah_pinjaman_number = '';
            $jangka_waktu = '';
            $tujuan_pinjaman = '';

            $ctst = ApplicantStepFiveModel::where('tgl_input', '=', $yeuh)
                ->where('produk_pinjaman', '=', 'KTA Payroll')
                ->count();

            $ctstret = ApplicantStepFiveModel::where('tgl_input', '=', $yeuh)
                ->where('produk_pinjaman', '=', 'KTA Retail')
                ->count();
        } else {
            $stepfive = ApplicantStepFiveModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                // ->where('flag_approval', 0)
                ->get();

            foreach ($stepfive as $st) {
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $tgl_input = $st->tgl_input;
                $ref_no = $st->ref_no;
                $kabupatenkota = $kabupatenkota;
                $produk_pinjaman = $st->produk_pinjaman;
                $jumlah_pinjaman = $st->jumlah_pinjaman;
                $jumlah_pinjaman_number = $st->jumlah_pinjaman_number;
                $jangka_waktu = $st->jangka_waktu;
                $tujuan_pinjaman = $st->tujuan_pinjaman;
            }

            // dd($yeuh);

            $ctst = ApplicantStepFiveModel::where('tgl_input', '=', $yeuh)
                ->where('produk_pinjaman', '=', 'KTA Payroll')
                ->count();

            $ctstret = ApplicantStepFiveModel::where('tgl_input', '=', $yeuh)
                ->where('produk_pinjaman', '=', 'KTA Retail')
                ->count();

            // dd($ctst);
        }

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step Five',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.stepfive',
            [
                'product_kta' => $product_kta,
                'master_bunga' => $master_bunga,
                'kabupatenkota' => $kabupatenkota,
                'pekerjaan' => $pekerjaan,
                'ctStepFive' => $ctStepFive,
                'ctst' => $ctst,
                'ctstret' => $ctstret,
                'stepfive' => $stepfive,
                'nik' => $nik,
                'tokenreg' => $tokenreg,
                'ref_no' => $ref_no,
                'appr' => $appr,
                'tgl_input' => $tgl_input,
                'produk_pinjaman' => $produk_pinjaman,
                'jumlah_pinjaman' => $jumlah_pinjaman,
                'jumlah_pinjaman_number' => $jumlah_pinjaman_number,
                'jangka_waktu' => $jangka_waktu,
                'tujuan_pinjaman' => $tujuan_pinjaman,
                'apprref_no' => $apprref_no,
                'checkLock' => $checkLock,
                'ctDBR' => $ctDBR

            ]
        );
    }

    public function edit(Request $request, ApplicantStepFiveModel $stepfive)
    {

        $nik = session('nik');
        $tokenreg = session('tokenreg');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $kabupatenkota = ApplicantStepOneModel::select('kabupatenkota')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('kabupatenkota')->first();

        $pekerjaan = ApplicantStepThreeModel::select('pekerjaan')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $master_bunga = DB::table('master_bunga')
            ->where('produk_kta', $stepfive->produk_pinjaman)
            ->get();

        $product_kta = DB::table('master_product_kta')
            ->get();

        $produk_pinjaman = DB::table('master_product_kta')
            ->where('kode', $stepfive->produk_pinjaman)
            ->pluck('kode')->first();

        $jangka_waktu = DB::table('master_bunga')
            ->where('jangka_waktu', $stepfive->jangka_waktu)
            ->pluck('jangka_waktu')->first();

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing Edit E-Form Step Five',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.editstepfive',
            [
                'stepfive' => $stepfive,
                'product_kta' => $product_kta,
                'produk_pinjaman' => $produk_pinjaman,
                'master_bunga' => $master_bunga,
                'jangka_waktu' => $jangka_waktu

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
        $ref_no = $request->ref_no;
        $angsuran_perbulan_number = $request->input('angsuran_perbulan_number');

        $kabupatenkota = ApplicantStepOneModel::select('kabupatenkota')
            ->where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('kabupatenkota')->first();

        $ref_noexist = ApplicantStepFiveModel::select('ref_no')
            ->pluck('ref_no');

        // dd($angsuran_perbulan_number);

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'tgl_input' => 'required',
            'ref_no' => 'required',
            'kabupatenkota' => 'required',
            'produk_pinjaman' => 'required',
            'jumlah_pinjaman' => 'required',
            'jumlah_pinjaman_number' => 'required',
            'jangka_waktu' => 'required',
            'tujuan_pinjaman' => 'required',
            'angsuran_perbulan' => 'required',
            'angsuran_perbulan_number' => 'required',
            'flag_approval' => 'required',
            'flag_disbursement' => 'required',
        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Creating Data ' . $ref_no . ' in E-Form Step Five',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($ref_noexist->contains($ref_no)) {
                return redirect()->back()->withErrors("No Referensi sudah terdaftar")->withInput();
            } else if ($angsuran_perbulan_number == 'NaN') {
                return redirect()->back()->withErrors("Terjadi kesalahan pada server. Silahkan coba kembali.")->withInput();
            } else {
                ApplicantStepFiveModel::create($request->all());

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Creating Data ' . $ref_no . ' in E-Form Step Five',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                HistoryApplicantStepFiveModel::create($request->all());
                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Create History Profile in E-Form Step Five',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                ApplicantStepOneModel::where('nik', $nik)
                    ->update([
                        'flag_lock' => null,
                    ]);

                ApplicantStepTwoModel::where('nik', $nik)
                    ->update([
                        'flag_lock' => null,
                    ]);

                ApplicantStepThreeModel::where('nik', $nik)
                    ->update([
                        'flag_lock' => null,
                    ]);

                ApplicantStepFourModel::where('nik', $nik)
                    ->update([
                        'flag_lock' => null,
                    ]);

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Unlock Eform NIK ' . $nik . ' Profil',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // return redirect()->route('stepupload.index');
                return redirect()->back()->with('success', 'Data tersimpan');
            }
        }
    }

    public function update(Request $request, ApplicantStepFiveModel $stepfive)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();
        $ref_no = $request->ref_no;
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'tgl_input' => 'required',
            'jumlah_pinjaman' => 'required',
            'jumlah_pinjaman_number' => 'required',
            'bunga' => 'required',
            'jangka_waktu' => 'required',
            'tujuan_pinjaman' => 'required'

        ]);
        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data ' . $ref_no . ' in E-Form Step Five',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $stepfive->update($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Data ' . $ref_no . ' in E-Form Step Five',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            HistoryApplicantStepFiveModel::create($request->all());
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Profile in E-Form Step Five',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Data tersimpan');
        }
    }

    public function getDataBunga($prdkkta = 0, $jgkwkt = 0)
    {
        $data = DB::table('master_bunga')
            ->where('produk_kta', '=', $prdkkta)
            ->where('jangka_waktu', '=', $jgkwkt)
            ->select('*')
            ->get();
        echo json_encode($data);
    }
}
