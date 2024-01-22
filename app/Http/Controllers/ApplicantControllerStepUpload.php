<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepFourModel;
use App\Models\ApplicantStepThreeModel;
use App\Models\ApplicantStepUploadModel;
use App\Models\HistoryApplicantStepUploadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ApplicantControllerStepUpload extends Controller
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

        $ctStepUpload = ApplicantStepUploadModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        if ($ctStepUpload == 0) {
            $checkLock = 1;
        } else {
            $checkLock = ApplicantStepUploadModel::where('nik', $nik)
                ->where('tokenreg', $tokenreg)
                ->where('flag_lock', null)
                ->count();
        }
        // $pekerjaan = '';
        $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();
        // dd($pekerjaan);

        $havingcreditcard = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('creditcard')->first();
        // dd($havingcreditcard);

        if ($ctStepUpload == 0) {
            $nik = session('nik');
            $tokenreg = session('tokenreg');
            $pekerjaan = $pekerjaan;
            $havingcreditcard = $havingcreditcard;
            $stepupload = '';
            $path_prim = '';
            $path_supp = '';
            $copyktp = '';
            $npwp = '';
            $kk = '';
            $slip_gaji = '';
            $mutasirekening = '';
            $sip = '';
            $siup = '';
            $billingcc = '';
        } else {
            $stepupload = ApplicantStepUploadModel::where('nik', '=', $nik)
                ->where('tokenreg', '=', $tokenreg)
                ->get();
            // $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            //     ->where('tokenreg', $tokenreg)
            //     ->pluck('pekerjaan')->first();

            foreach ($stepupload as $st) {
                $nik = $st->nik;
                $tokenreg = $st->tokenreg;
                $path_prim = $st->path_prim;
                $path_supp = $st->path_supp;
                $copyktp = $st->copyktp;
                $npwp = $st->npwp;
                $kk = $st->kk;
                $slip_gaji = $st->slip_gaji;
                $mutasirekening = $st->mutasirekening;
                $sip = $st->sip;
                $siup = $st->siup;
                $billingcc = $st->billingcc;
            }
        }

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Step Upload',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.stepupload',
            [
                'ctStepUpload' => $ctStepUpload,
                'stepupload' => $stepupload,
                'nik' => $nik,
                'tokenreg' => $tokenreg,
                'pekerjaan' => $pekerjaan,
                'havingcreditcard' => $havingcreditcard,
                'path_prim' => $path_prim,
                'path_supp' => $path_supp,
                'copyktp' => $copyktp,
                'npwp' => $npwp,
                'kk' => $kk,
                'slip_gaji' => $slip_gaji,
                'mutasirekening' => $mutasirekening,
                'sip' => $sip,
                'siup' => $siup,
                'billingcc' => $billingcc,
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
        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $primary = 'primary';
        $folder = $formatYear . "/" . $formatMonth . "/" . $formatDay . "/" . $nik . "/" . $primary;

        $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $havingcreditcard = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('creditcard')->first();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'pekerjaan' => 'required',
            'havingcreditcard' => 'required',
            'copyktp' => 'required|image|mimes:jpeg|max:512',
            'npwp' => 'required|image|mimes:jpeg|max:512',
            'kk' => 'required|image|mimes:jpeg|max:512',

        ]);

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Uploading Data in E-Form Step Upload',
                'status' => 'Failed',
                'caused_by' => "Validator error",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
            // dd($ext);
            $namektp = $request->file('copyktp')->getClientOriginalName();
            $namektpstore = $nik . "_CopyKTP_" . $namektp;
            $extktp = $request->file('copyktp')->getClientOriginalExtension();

            $namenpwp = $request->file('npwp')->getClientOriginalName();
            $extnpwp = $request->file('npwp')->getClientOriginalExtension();
            $namenpwpstore = $nik . "_NPWP_" . $namenpwp;

            $namekk = $request->file('kk')->getClientOriginalName();
            $extkk = $request->file('kk')->getClientOriginalExtension();
            $namekkstore = $nik . "_KK_" . $namekk;

            $inarktp = in_array($extktp, $ext);
            $inarnpwp = in_array($extnpwp, $ext);
            $inarkk = in_array($extkk, $ext);

            if ($inarktp && $inarnpwp && $inarkk) {
                $pathktp = $request->file('copyktp')->storeAs($folder, $namektpstore);
                $ftpktp = Storage::disk('ftp')->put($folder . "/" . $namektpstore, fopen($request->file('copyktp'), 'r+'));
                $pathnpwp = $request->file('npwp')->storeAs($folder, $namenpwpstore);
                $ftpnpwp = Storage::disk('ftp')->put($folder . "/" . $namenpwpstore, fopen($request->file('npwp'), 'r+'));
                $pathkk = $request->file('kk')->storeAs($folder, $namekkstore);
                $ftpkk = Storage::disk('ftp')->put($folder . "/" . $namekkstore, fopen($request->file('kk'), 'r+'));

                $stepupload = new ApplicantStepUploadModel;
                $stepupload->nik = $request->input('nik');
                $stepupload->tokenreg = $request->input('tokenreg');
                $stepupload->path_prim = $folder;
                $stepupload->copyktp = $namektpstore;
                $stepupload->npwp = $namenpwpstore;
                $stepupload->kk = $namekkstore;
                $stepupload->save();

                // dd('wow');
                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Uploading Primary Data in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $historystepupload = new HistoryApplicantStepUploadModel();
                $historystepupload->nik = $request->input('nik');
                $historystepupload->tokenreg = $request->input('tokenreg');
                $historystepupload->path_prim = $folder;
                $historystepupload->copyktp = $namektpstore;
                $historystepupload->npwp = $namenpwpstore;
                $historystepupload->kk = $namekkstore;
                $historystepupload->save();

                // HistoryApplicantStepUploadModel::create($request->all());
                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Create History Primary Documents Profile in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->back()->with('success', 'Data tersimpan');
            }
        }
    }

    public function storesupp(Request $request)
    {

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();
        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $supporting = 'supporting';
        $folder = $formatYear . "/" . $formatMonth . "/" . $formatDay . "/" . $nik . "/" . $supporting;

        $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $havingcreditcard = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('creditcard')->first();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'pekerjaan' => 'required',
            'havingcreditcard' => 'required',
            'slip_gaji' => 'required_if:pekerjaan,Karyawan Swasta,Karyawan BUMN,ASN|image|mimes:jpeg|max:512',
            'mutasirekening' => 'required_if:pekerjaan,Profesional,Pengusaha|image|mimes:jpeg|max:512',
            'sip' => 'required_if:pekerjaan,==,Profesional|image|mimes:jpeg|max:512',
            'siup' => 'required_if:pekerjaan,==,Pengusaha|image|max:512',
            'billingcc' => 'required_if:havingcreditcard,==,Ya|image|mimes:jpeg|max:512',
        ]);

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Uploading Supporting Data in E-Form Step Upload',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
            if ($request->file('slip_gaji') != '') {
                $nameslip = $request->file('slip_gaji')->getClientOriginalName();
                $extslip = $request->file('slip_gaji')->getClientOriginalExtension();
                $nameslipstore = $nik . "_SLIP_" . $nameslip;
            } else {
                $nameslipstore = '';
            }

            if ($request->file('mutasirekening') != '') {
                $namemutasi = $request->file('mutasirekening')->getClientOriginalName();
                $extmutasi = $request->file('mutasirekening')->getClientOriginalExtension();
                $namemutasistore = $nik . "_MutasiRekening_" . $namemutasi;
            } else {
                $namemutasistore = '';
            }

            if ($request->file('sip') != '') {
                $namesip = $request->file('sip')->getClientOriginalName();
                $extsip = $request->file('sip')->getClientOriginalExtension();
                $namesipstore = $nik . "_SIP_" . $namesip;
            } else {
                $namesipstore = '';
            }

            if ($request->file('siup') != '') {
                $namesiup = $request->file('siup')->getClientOriginalName();
                $extsiup = $request->file('sip')->getClientOriginalExtension();
                $namesiupstore = $nik . "_SIUP_" . $namesiup;
            } else {
                $namesiupstore = '';
            }

            if ($request->file('billingcc') != '') {
                $namebilling = $request->file('billingcc')->getClientOriginalName();
                $extbilling = $request->file('billingcc')->getClientOriginalExtension();
                $namebillingstore = $nik . "_BillingCC_" . $namebilling;
            } else {
                $namebillingstore = '';
            }

            $inarslip = in_array($extslip, $ext);
            $inarmutasi = in_array($extmutasi, $ext);
            $inarsip = in_array($extsip, $ext);
            $inarsiup = in_array($extsiup, $ext);
            $inarbilling = in_array($extbilling, $ext);

            if ($inarslip && $inarmutasi && $inarsip && $inarsiup && $inarbilling) {
                $pathslip = $request->file('slip_gaji')->storeAs($folder, $nameslipstore);
                $ftpslip = Storage::disk('ftp')->put($folder . "/" . $nameslipstore, fopen($request->file('slip_gaji'), 'r+'));
                $pathmutasi = $request->file('mutasirekening')->storeAs($folder, $namemutasistore);
                $ftpmutasi = Storage::disk('ftp')->put($folder . "/" . $namemutasistore, fopen($request->file('mutasirekening'), 'r+'));
                $pathsip = $request->file('sip')->storeAs($folder, $namesipstore);
                $ftpsip = Storage::disk('ftp')->put($folder . "/" . $namesipstore, fopen($request->file('sip'), 'r+'));
                $pathsiup = $request->file('siup')->storeAs($folder, $namesiupstore);
                $ftpsiup = Storage::disk('ftp')->put($folder . "/" . $namesiupstore, fopen($request->file('siup'), 'r+'));
                $pathbilling = $request->file('billingcc')->storeAs($folder, $namebillingstore);
                $ftpbilling = Storage::disk('ftp')->put($folder . "/" . $namebillingstore, fopen($request->file('billingcc'), 'r+'));

                $stepupload = new ApplicantStepUploadModel;
                $stepupload->nik = $request->input('nik');
                $stepupload->tokenreg = $request->input('tokenreg');
                $stepupload->path_supp = $folder;
                $stepupload->slip_gaji = $nameslipstore;
                $stepupload->mutasirekening = $namemutasistore;
                $stepupload->sip = $namesipstore;
                $stepupload->siup = $namesiupstore;
                $stepupload->billingcc = $namebillingstore;
                $stepupload->save();

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Uploading Data in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $historystepupload = new HistoryApplicantStepUploadModel();
                $historystepupload->nik = $request->input('nik');
                $historystepupload->tokenreg = $request->input('tokenreg');
                $historystepupload->path_supp = $folder;
                $historystepupload->slip_gaji = $nameslipstore;
                $historystepupload->mutasirekening = $namemutasistore;
                $historystepupload->sip = $namesipstore;
                $historystepupload->siup = $namesiupstore;
                $historystepupload->billingcc = $namebillingstore;
                $historystepupload->save();

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Create History Supporting Documents Profile in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->back()->with('success', 'Data tersimpan');
            }
        }
    }

    public function update(Request $request, ApplicantStepUploadModel $stepupload)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();
        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $primary = 'primary';
        $folder = $formatYear . "/" . $formatMonth . "/" . $formatDay . "/" . $nik . "/" . $primary;

        $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $havingcreditcard = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('creditcard')->first();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'pekerjaan' => 'required',
            'havingcreditcard' => 'required',
            'copyktp' => 'required|image|mimes:jpeg|max:512',
            'npwp' => 'required|image|mimes:jpeg|max:512',
            'kk' => 'required|image|mimes:jpeg|max:512',

        ]);

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Updating Primary Data in E-Form Step Upload',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (Storage::exists($folder)) {
                $ext = ['jpg', 'jpeg', 'JPG', 'JPEG'];
                // dd($ext);
                Storage::deleteDirectory($folder);
                $namektp = $request->file('copyktp')->getClientOriginalName();
                $namektpstore = $nik . "_CopyKTP_" . $namektp;
                $extktp = $request->file('copyktp')->getClientOriginalExtension();

                $namenpwp = $request->file('npwp')->getClientOriginalName();
                $extnpwp = $request->file('npwp')->getClientOriginalExtension();
                $namenpwpstore = $nik . "_NPWP_" . $namenpwp;

                $namekk = $request->file('kk')->getClientOriginalName();
                $extkk = $request->file('kk')->getClientOriginalExtension();
                $namekkstore = $nik . "_KK_" . $namekk;

                $inarktp = in_array($extktp, $ext);
                $inarnpwp = in_array($extnpwp, $ext);
                $inarkk = in_array($extkk, $ext);

                if ($inarktp && $inarnpwp && $inarkk) {
                    $pathktp = $request->file('copyktp')->storeAs($folder, $namektpstore);
                    $ftpktp = Storage::disk('ftp')->put($folder . "/" . $namektpstore, fopen($request->file('copyktp'), 'r+'));
                    $pathnpwp = $request->file('npwp')->storeAs($folder, $namenpwpstore);
                    $ftpnpwp = Storage::disk('ftp')->put($folder . "/" . $namenpwpstore, fopen($request->file('npwp'), 'r+'));
                    $pathkk = $request->file('kk')->storeAs($folder, $namekkstore);
                    $ftpkk = Storage::disk('ftp')->put($folder . "/" . $namekkstore, fopen($request->file('kk'), 'r+'));

                    $stepupload->nik = $request->input('nik');
                    $stepupload->tokenreg = $request->input('tokenreg');
                    $stepupload->path_prim = $folder;
                    $stepupload->copyktp = $namektpstore;
                    $stepupload->npwp = $namenpwpstore;
                    $stepupload->kk = $namekkstore;
                    $stepupload->update();

                    AktifitasModel::insert([
                        'nik' => $nik,
                        'email' => $email,
                        'ip_address' => $ip_address,
                        'nama' => $name,
                        'url' => $url,
                        'action' => 'Updating Primary Data in E-Form Step Upload',
                        'status' => 'Success',
                        'caused_by' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $historystepupload = new HistoryApplicantStepUploadModel();
                    $historystepupload->nik = $request->input('nik');
                    $historystepupload->tokenreg = $request->input('tokenreg');
                    $historystepupload->path_prim = $folder;
                    $historystepupload->copyktp = $namektpstore;
                    $historystepupload->npwp = $namenpwpstore;
                    $historystepupload->kk = $namekkstore;
                    $historystepupload->save();

                    AktifitasModel::insert([
                        'nik' => $nik,
                        'email' => $email,
                        'ip_address' => $ip_address,
                        'nama' => $name,
                        'url' => $url,
                        'action' => 'Update History Primary Documents Profile in E-Form Step Upload',
                        'status' => 'Success',
                        'caused_by' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Data terupdate');

                    // dd('wow');
                }
            } else {
                $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
                // dd($ext);
                $namektp = $request->file('copyktp')->getClientOriginalName();
                $namektpstore = $nik . "_CopyKTP_" . $namektp;
                $extktp = $request->file('copyktp')->getClientOriginalExtension();

                $namenpwp = $request->file('npwp')->getClientOriginalName();
                $extnpwp = $request->file('npwp')->getClientOriginalExtension();
                $namenpwpstore = $nik . "_NPWP_" . $namenpwp;

                $namekk = $request->file('kk')->getClientOriginalName();
                $extkk = $request->file('kk')->getClientOriginalExtension();
                $namekkstore = $nik . "_KK_" . $namekk;

                $inarktp = in_array($extktp, $ext);
                $inarnpwp = in_array($extnpwp, $ext);
                $inarkk = in_array($extkk, $ext);

                if ($inarktp && $inarnpwp && $inarkk) {
                    $pathktp = $request->file('copyktp')->storeAs($folder, $namektpstore);
                    $ftpktp = Storage::disk('ftp')->put($folder . "/" . $namektpstore, fopen($request->file('copyktp'), 'r+'));
                    $pathnpwp = $request->file('npwp')->storeAs($folder, $namenpwpstore);
                    $ftpnpwp = Storage::disk('ftp')->put($folder . "/" . $namenpwpstore, fopen($request->file('npwp'), 'r+'));
                    $pathkk = $request->file('kk')->storeAs($folder, $namekkstore);
                    $ftpkk = Storage::disk('ftp')->put($folder . "/" . $namekkstore, fopen($request->file('kk'), 'r+'));

                    $stepupload->nik = $request->input('nik');
                    $stepupload->tokenreg = $request->input('tokenreg');
                    $stepupload->path_prim = $folder;
                    $stepupload->copyktp = $namektpstore;
                    $stepupload->npwp = $namenpwpstore;
                    $stepupload->kk = $namekkstore;

                    $stepupload->update();

                    AktifitasModel::insert([
                        'nik' => $nik,
                        'email' => $email,
                        'ip_address' => $ip_address,
                        'nama' => $name,
                        'url' => $url,
                        'action' => 'Updating Primary Data in E-Form Step Upload',
                        'status' => 'Success',
                        'caused_by' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    HistoryApplicantStepUploadModel::create($request->all());
                    AktifitasModel::insert([
                        'nik' => $nik,
                        'email' => $email,
                        'ip_address' => $ip_address,
                        'nama' => $name,
                        'url' => $url,
                        'action' => 'Update History Primary Documents Profile in E-Form Step Upload',
                        'status' => 'Success',
                        'caused_by' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    return redirect()->back()->with('success', 'Data terupdate');

                    // dd('wow');
                }
            }
        }
    }

    public function updatesupp(Request $request, ApplicantStepUploadModel $stepupload)
    {

        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();
        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $supporting = 'supporting';
        $folder = $formatYear . "/" . $formatMonth . "/" . $formatDay . "/" . $nik . "/" . $supporting;

        $pekerjaan = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('pekerjaan')->first();

        $havingcreditcard = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->pluck('creditcard')->first();

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'tokenreg' => 'required',
            'pekerjaan' => 'required',
            'havingcreditcard' => 'required',
            'slip_gaji' => 'required_if:pekerjaan,Karyawan Swasta,Karyawan BUMN,ASN|image|mimes:jpeg|max:512',
            'mutasirekening' => 'required_if:pekerjaan,Profesional,Pengusaha|image|mimes:jpeg|max:512',
            'sip' => 'required_if:pekerjaan,==,Profesional|image|mimes:jpeg|max:512',
            'siup' => 'required_if:pekerjaan,==,Pengusaha|image|max:512',
            'billingcc' => 'required_if:havingcreditcard,==,Ya|image|mimes:jpeg|max:512',
        ]);

        if ($validator->fails()) {
            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $email,
                'ip_address' => $ip_address,
                'nama' => $name,
                'url' => $url,
                'action' => 'Uploading Supporting Data in E-Form Step Upload',
                'status' => 'Failed',
                'caused_by' => $validator->errors(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (Storage::exists($folder)) {
                Storage::deleteDirectory($folder);

                $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
                if ($request->file('slip_gaji') != '') {
                    $extslip = $request->file('slip_gaji')->getClientOriginalExtension();
                } else {
                    $extslip = 'jpg';
                }

                if ($request->file('mutasirekening') != '') {
                    $extmutasi = $request->file('mutasirekening')->getClientOriginalExtension();
                } else {
                    $extmutasi = 'jpg';
                }

                if ($request->file('sip') != '') {
                    $extsip = $request->file('sip')->getClientOriginalExtension();
                } else {
                    $extsip = 'jpg';
                }

                if ($request->file('siup') != '') {
                    $extsiup = $request->file('siup')->getClientOriginalExtension();
                } else {
                    $extsiup = 'jpg';
                }

                if ($request->file('billingcc') != '') {
                    $extbilling = $request->file('billingcc')->getClientOriginalExtension();
                } else {
                    $extbilling = 'jpg';
                }

                $inarslip = in_array($extslip, $ext);
                $inarmutasi = in_array($extmutasi, $ext);
                $inarsip = in_array($extsip, $ext);
                $inarsiup = in_array($extsiup, $ext);
                $inarbilling = in_array($extbilling, $ext);

                if ($request->file('slip_gaji') != '') {
                    if ($inarslip) {
                        $nameslip = $request->file('slip_gaji')->getClientOriginalName();
                        $nameslipstore = $nik . "_SLIP_" . $nameslip;
                        $pathslip = $request->file('slip_gaji')->storeAs($folder, $nameslipstore);
                        $ftpslip = Storage::disk('ftp')->put($folder . "/" . $nameslipstore, fopen($request->file('slip_gaji'), 'r+'));
                    }
                } else {
                    $nameslipstore = '';
                    $extslip = 'jpg';
                }

                if ($request->file('mutasirekening') != '') {
                    if ($inarmutasi) {
                        $namemutasi = $request->file('mutasirekening')->getClientOriginalName();
                        $namemutasistore = $nik . "_MutasiRekening_" . $namemutasi;
                        $pathmutasi = $request->file('mutasirekening')->storeAs($folder, $namemutasistore);
                        $ftpmutasi = Storage::disk('ftp')->put($folder . "/" . $namemutasistore, fopen($request->file('mutasirekening'), 'r+'));
                    }
                } else {
                    $namemutasistore = '';
                    $extmutasi = 'jpg';
                }

                if ($request->file('sip') != '') {
                    if ($inarsip) {
                        $namesip = $request->file('sip')->getClientOriginalName();
                        $namesipstore = $nik . "_SIP_" . $namesip;
                        $pathsip = $request->file('sip')->storeAs($folder, $namesipstore);
                        $ftpsip = Storage::disk('ftp')->put($folder . "/" . $namesipstore, fopen($request->file('sip'), 'r+'));
                    }
                } else {
                    $namesipstore = '';
                    $extsip = 'jpg';
                }

                if ($request->file('siup') != '') {
                    if ($inarsiup) {
                        $namesiup = $request->file('siup')->getClientOriginalName();
                        $namesiupstore = $nik . "_SIUP_" . $namesiup;
                        $pathsiup = $request->file('siup')->storeAs($folder, $namesiupstore);
                        $ftpsiup = Storage::disk('ftp')->put($folder . "/" . $namesiupstore, fopen($request->file('siup'), 'r+'));
                    }
                } else {
                    $namesiupstore = '';
                    $extsiup = 'jpg';
                }

                if ($request->file('billingcc') != '') {
                    if ($inarbilling) {
                        $namebilling = $request->file('billingcc')->getClientOriginalName();
                        $namebillingstore = $nik . "_BillingCC_" . $namebilling;
                        $pathbilling = $request->file('billingcc')->storeAs($folder, $namebillingstore);
                        $ftpbilling = Storage::disk('ftp')->put($folder . "/" . $namebillingstore, fopen($request->file('billingcc'), 'r+'));
                    }
                } else {
                    $namebillingstore = '';
                    $extbilling = 'jpg';
                }

                // dd($extmutasi);


                ApplicantStepUploadModel::where('nik', $nik)
                    ->where('tokenreg', $tokenreg)
                    ->update([
                        'path_supp' => $folder,
                        'slip_gaji' => $nameslipstore,
                        'mutasirekening' => $namemutasistore,
                        'sip' => $namesipstore,
                        'siup' => $namesiupstore,
                        'billingcc' => $namebillingstore,
                    ]);

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Uploading Supporting Data in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $historystepupload = new HistoryApplicantStepUploadModel();
                $historystepupload->nik = $request->input('nik');
                $historystepupload->tokenreg = $request->input('tokenreg');
                $historystepupload->path_supp = $folder;
                $historystepupload->slip_gaji = $nameslipstore;
                $historystepupload->mutasirekening = $namemutasistore;
                $historystepupload->sip = $namesipstore;
                $historystepupload->siup = $namesiupstore;
                $historystepupload->billingcc = $namebillingstore;
                // dd($namebillingstore);
                $historystepupload->save();

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Create History Supporting Documents Profile in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->back()->with('success', 'Data terupdate');
            } else {

                $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
                if ($request->file('slip_gaji') != '') {
                    $extslip = $request->file('slip_gaji')->getClientOriginalExtension();
                } else {
                    $extslip = 'jpg';
                }

                if ($request->file('mutasirekening') != '') {
                    $extmutasi = $request->file('mutasirekening')->getClientOriginalExtension();
                } else {
                    $extmutasi = 'jpg';
                }

                if ($request->file('sip') != '') {
                    $extsip = $request->file('sip')->getClientOriginalExtension();
                } else {
                    $extsip = 'jpg';
                }

                if ($request->file('siup') != '') {
                    $extsiup = $request->file('siup')->getClientOriginalExtension();
                } else {
                    $extsiup = 'jpg';
                }

                if ($request->file('billingcc') != '') {
                    $extbilling = $request->file('billingcc')->getClientOriginalExtension();
                } else {
                    $extbilling = 'jpg';
                }

                $inarslip = in_array($extslip, $ext);
                $inarmutasi = in_array($extmutasi, $ext);
                $inarsip = in_array($extsip, $ext);
                $inarsiup = in_array($extsiup, $ext);
                $inarbilling = in_array($extbilling, $ext);

                if ($request->file('slip_gaji') != '') {
                    if ($inarslip) {
                        $nameslip = $request->file('slip_gaji')->getClientOriginalName();
                        $nameslipstore = $nik . "_SLIP_" . $nameslip;
                        $pathslip = $request->file('slip_gaji')->storeAs($folder, $nameslipstore);
                        $ftpslip = Storage::disk('ftp')->put($folder . "/" . $nameslipstore, fopen($request->file('slip_gaji'), 'r+'));
                    }
                } else {
                    $nameslipstore = '';
                    $extslip = 'jpg';
                }

                if ($request->file('mutasirekening') != '') {
                    if ($inarmutasi) {
                        $namemutasi = $request->file('mutasirekening')->getClientOriginalName();
                        $namemutasistore = $nik . "_MutasiRekening_" . $namemutasi;
                        $pathmutasi = $request->file('mutasirekening')->storeAs($folder, $namemutasistore);
                        $ftpmutasi = Storage::disk('ftp')->put($folder . "/" . $namemutasistore, fopen($request->file('mutasirekening'), 'r+'));
                    }
                } else {
                    $namemutasistore = '';
                    $extmutasi = 'jpg';
                }

                if ($request->file('sip') != '') {
                    if ($inarsip) {
                        $namesip = $request->file('sip')->getClientOriginalName();
                        $namesipstore = $nik . "_SIP_" . $namesip;
                        $pathsip = $request->file('sip')->storeAs($folder, $namesipstore);
                        $ftpsip = Storage::disk('ftp')->put($folder . "/" . $namesipstore, fopen($request->file('sip'), 'r+'));
                    }
                } else {
                    $namesipstore = '';
                    $extsip = 'jpg';
                }

                if ($request->file('siup') != '') {
                    if ($inarsiup) {
                        $namesiup = $request->file('siup')->getClientOriginalName();
                        $namesiupstore = $nik . "_SIUP_" . $namesiup;
                        $pathsiup = $request->file('siup')->storeAs($folder, $namesiupstore);
                        $ftpsiup = Storage::disk('ftp')->put($folder . "/" . $namesiupstore, fopen($request->file('siup'), 'r+'));
                    }
                } else {
                    $namesiupstore = '';
                    $extsiup = 'jpg';
                }

                if ($request->file('billingcc') != '') {
                    if ($inarbilling) {
                        $namebilling = $request->file('billingcc')->getClientOriginalName();
                        $namebillingstore = $nik . "_BillingCC_" . $namebilling;
                        $pathbilling = $request->file('billingcc')->storeAs($folder, $namebillingstore);
                        $ftpbilling = Storage::disk('ftp')->put($folder . "/" . $namebillingstore, fopen($request->file('billingcc'), 'r+'));
                    }
                } else {
                    $namebillingstore = '';
                    $extbilling = 'jpg';
                }

                // dd($extmutasi);


                ApplicantStepUploadModel::where('nik', $nik)
                    ->where('tokenreg', $tokenreg)
                    ->update([
                        'path_supp' => $folder,
                        'slip_gaji' => $nameslipstore,
                        'mutasirekening' => $namemutasistore,
                        'sip' => $namesipstore,
                        'siup' => $namesiupstore,
                        'billingcc' => $namebillingstore,
                    ]);

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Uploading Supporting Data in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $historystepupload = new HistoryApplicantStepUploadModel();
                $historystepupload->nik = $request->input('nik');
                $historystepupload->tokenreg = $request->input('tokenreg');
                $historystepupload->path_supp = $folder;
                $historystepupload->slip_gaji = $nameslipstore;
                $historystepupload->mutasirekening = $namemutasistore;
                $historystepupload->sip = $namesipstore;
                $historystepupload->siup = $namesiupstore;
                $historystepupload->billingcc = $namebillingstore;
                // dd($namebillingstore);
                $historystepupload->save();

                AktifitasModel::insert([
                    'nik' => $nik,
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'nama' => $name,
                    'url' => $url,
                    'action' => 'Create History Supporting Documents Profile in E-Form Step Upload',
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->back()->with('success', 'Data terupdate');
            }
        }
    }
}
