<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepOneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimulasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('auth');
    }
    //
    public function index(Request $request)
    {

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $ip_address = session('ip_address');
        $name = session('name');
        $url = $request->fullUrl();
        $id = session('id');
        // dd($id);
        $ctStepOne = ApplicantStepOneModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepOne == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $name = session('name');
            $no_hp = session('no_hp');
            $stepone = '';
            $npwp = '';
            $stepone = '';
            $mother_name = '';
            $tempat_lahir = '';
            $tgl_lahir = '';
            $marital_status = '';
            $julah_tanggungan = '';
            $alamat = '';
            $desa = '';
            $kecamatan = '';
            $kabupatenkota = '';
            $provinsi = '';
            $kodepos = '';
            $housing = '';
            $los_year = '';
            $los_month = '';

            $bunga = DB::table('master_bunga')
                ->get();

            $product_kta = DB::table('master_product_kta')
                ->get();
        } else {
            $bunga = DB::table('master_bunga')
                ->get();

            $product_kta = DB::table('master_product_kta')
                ->get();
            $stepone = ApplicantStepOneModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->get();
            foreach ($stepone as $st) {
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $name = $st->nama;
                $no_hp = $st->no_hp;
                $npwp = $st->npwp;
                $mother_name = $st->mother_name;
                $tempat_lahir = $st->tempat_lahir;
                $tgl_lahir = $st->tgl_lahir;
                $marital_status = $st->marital_status;
                $julah_tanggungan = $st->julah_tanggungan;
                $alamat = $st->alamat;
                $desa = $st->desa;
                $kecamatan = $st->kecamatan;
                $kabupatenkota = $st->kabupatenkota;
                $provinsi = $st->provinsi;
                $kodepos = $st->kodepos;
                $housing = $st->housing;
                $los_year = $st->los_year;
                $los_month = $st->los_month;
            }
        }

        $bunga = DB::table('master_bunga')
            ->get();

        $product_kta = DB::table('master_product_kta')
            ->get();

            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Accessing Halaman Simulasi',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return view('simulasi.index', [
            'product_kta' => $product_kta,
            'bunga' => $bunga,
            'nik' => $nik,
            'tokenreg' => $tokenreg,
            'name' => $name,
            'no_hp' => $no_hp,
            'npwp' => $npwp,
            'mother_name' => $mother_name,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir,
            'marital_status' => $marital_status,
            'julah_tanggungan' => $julah_tanggungan,
            'alamat' => $alamat,
            'desa' => $desa,
            'kecamatan' => $kecamatan,
            'kabupatenkota' => $kabupatenkota,
            'provinsi' => $provinsi,
            'kodepos' => $kodepos,
            'housing' => $housing,
            'los_year' => $los_year,
            'los_month' => $los_month

        ]);
    }

    public function bungaSearch(Request $request)
    {
        $kode = [];

        if ($request->has('q')) {
            $search = $request->q;
            $kode = DB::table('master_product_kta')
                ->select('*')
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $search = $request->q;
            $kode = DB::table('master_product_kta')
                ->select('*')
                ->get();
        }
        return response()->json($kode);
    }

    public function getDataJangka($id = 0)
    {
        $data = DB::table('master_bunga')
            ->join('master_product_kta', 'master_bunga.produk_kta', '=', 'master_product_kta.kode')
            ->where('master_product_kta.kode', '=', $id)
            ->select('*')
            ->get();
        echo json_encode($data);
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
