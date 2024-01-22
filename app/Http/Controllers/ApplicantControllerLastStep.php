<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepFiveModel;
use App\Models\ApplicantStepFourModel;
use App\Models\ApplicantStepOneModel;
use App\Models\ApplicantStepThreeModel;
use App\Models\ApplicantStepTwoModel;
use App\Models\ApplicantStepUploadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ApplicantControllerLastStep extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ref_no = $request->input('noreftext');
        // $ref_no = 'ID29082022KTART00002';
        // dd($ref_no);

        $ctStepOne = ApplicantStepOneModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepTwo = ApplicantStepTwoModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepThree = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepFour = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepFive = ApplicantStepFiveModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepUpload = ApplicantStepUploadModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $data = DB::table('applicant_stepone')
            ->join('applicant_steptwo', 'applicant_stepone.nik', '=', 'applicant_steptwo.nik')
            ->join('applicant_stepthree', 'applicant_stepone.nik', '=', 'applicant_stepthree.nik')
            ->join('applicant_stepfour', 'applicant_stepone.nik', '=', 'applicant_stepfour.nik')
            ->join('applicant_stepfive', 'applicant_stepone.nik', '=', 'applicant_stepfive.nik')
            ->join('applicant_stepupload', 'applicant_stepone.nik', '=', 'applicant_stepupload.nik')
            ->select('*')
            ->where('applicant_stepone.nik', $nik)
            ->where('applicant_stepone.tokenreg', $tokenreg)
            ->where('applicant_stepfive.ref_no', $ref_no)
            ->first();

        $databank = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Last Step',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($ctStepOne != 0 && $ctStepTwo != 0 && $ctStepThree != 0 && $ctStepFour != 0 && $ctStepFive != 0 && $ctStepUpload != 0) {
            return view(
                'applicant.laststep',
                [
                    'data' => $data,
                    'databank' => $databank,
                ]
            );
        } else {
            return view(
                'applicant.attemptolaststep'
            );
        }
    }

    public function getByRefNo(Request $request)
    {
        // dd(request()->all());
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ref_no = $request->input('noreftext');
        // $ref_no = 'ID29082022KTART00002';
        // dd($ref_no);

        $ctStepOne = ApplicantStepOneModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepTwo = ApplicantStepTwoModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepThree = ApplicantStepThreeModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepFour = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepFive = ApplicantStepFiveModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $ctStepUpload = ApplicantStepUploadModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->count();

        $data = DB::table('applicant_stepone')
            ->join('applicant_steptwo', 'applicant_stepone.nik', '=', 'applicant_steptwo.nik')
            ->join('applicant_stepthree', 'applicant_stepone.nik', '=', 'applicant_stepthree.nik')
            ->join('applicant_stepfour', 'applicant_stepone.nik', '=', 'applicant_stepfour.nik')
            ->join('applicant_stepfive', 'applicant_stepone.nik', '=', 'applicant_stepfive.nik')
            ->join('applicant_stepupload', 'applicant_stepone.nik', '=', 'applicant_stepupload.nik')
            ->select('*')
            ->where('applicant_stepone.nik', $nik)
            ->where('applicant_stepone.tokenreg', $tokenreg)
            ->where('applicant_stepfive.ref_no', $ref_no)
            ->first();

        $databank = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Selecting Reference Number ' . $ref_no . ' in E-Form Last Step',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($ctStepOne != 0 && $ctStepTwo != 0 && $ctStepThree != 0 && $ctStepFour != 0 && $ctStepFive != 0 && $ctStepUpload != 0) {
            return view(
                'applicant.laststep',
                [
                    'data' => $data,
                    'databank' => $databank,
                ]
            );
        } else {
            return view(
                'applicant.attemptolaststep'
            );
        }
    }

    public function selectRefNo(Request $request)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ref_no_input = $request->input('noreftext');
        $ref_no = ApplicantStepFiveModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        $data = DB::table('applicant_stepone')
            ->join('applicant_steptwo', 'applicant_stepone.nik', '=', 'applicant_steptwo.nik')
            ->join('applicant_stepthree', 'applicant_stepone.nik', '=', 'applicant_stepthree.nik')
            ->join('applicant_stepfour', 'applicant_stepone.nik', '=', 'applicant_stepfour.nik')
            ->join('applicant_stepfive', 'applicant_stepone.nik', '=', 'applicant_stepfive.nik')
            ->join('applicant_stepupload', 'applicant_stepone.nik', '=', 'applicant_stepupload.nik')
            ->select('*')
            ->where('applicant_stepone.nik', $nik)
            ->where('applicant_stepone.tokenreg', $tokenreg)
            ->where('applicant_stepfive.ref_no', $ref_no_input)
            ->first();

        $databank = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Accessing E-Form Last Step',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view(
            'applicant.selectrefno',
            [
                'data' => $data,
                'databank' => $databank,
                'ref_no' => $ref_no
            ]
        );
    }

    public function toPDF(Request $request)
    {
        $tokenreg = session('tokenreg');
        $nik = session('nik');
        $email = session('email');
        $name = session('name');
        $ip_address = session('ip_address');
        $url = $request->fullUrl();

        $ref_no = $request->input('noreftext');
        // $ref_no = 'ID29082022KTART00002';
        // dd($ref_no);

        $data = DB::table('applicant_stepone')
            ->join('applicant_steptwo', 'applicant_stepone.nik', '=', 'applicant_steptwo.nik')
            ->join('applicant_stepthree', 'applicant_stepone.nik', '=', 'applicant_stepthree.nik')
            ->join('applicant_stepfour', 'applicant_stepone.nik', '=', 'applicant_stepfour.nik')
            ->join('applicant_stepfive', 'applicant_stepone.nik', '=', 'applicant_stepfive.nik')
            ->join('applicant_stepupload', 'applicant_stepone.nik', '=', 'applicant_stepupload.nik')
            ->select('*')
            ->where('applicant_stepone.nik', $nik)
            ->where('applicant_stepone.tokenreg', $tokenreg)
            ->where('applicant_stepfive.ref_no', $ref_no)
            ->first();

        $databank = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        $pdf = PDF::loadView(
            'applicant.laststeptopdf',
            [
                'data' => $data,
                'databank' => $databank
            ]
        )->setOptions([
            'defaultFont' => 'helvetica',
            'enable_remote' => true,
            'chroot' => public_path('public/assets/img')
        ]);

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Print Summary with Reference Number ' . $ref_no,
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ApplicantStepOneModel::where('nik', $nik)
            ->update([
                'flag_lock' => 1,
            ]);

        ApplicantStepTwoModel::where('nik', $nik)
            ->update([
                'flag_lock' => 1,
            ]);

        ApplicantStepThreeModel::where('nik', $nik)
            ->update([
                'flag_lock' => 1,
            ]);

        ApplicantStepFourModel::where('nik', $nik)
            ->update([
                'flag_lock' => 1,
            ]);

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $email,
            'ip_address' => $ip_address,
            'nama' => $name,
            'url' => $url,
            'action' => 'Lock Eform NIK ' . $nik . ' Profil',
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $pdf->download('resume' . "_" . $nik . "_" . $ref_no . ".pdf");
    }

    public function toCheck()
    {
        $nik = session('nik');
        $tokenreg = session('tokenreg');

        $data = DB::table('applicant_stepone')
            ->join('applicant_steptwo', 'applicant_stepone.nik', '=', 'applicant_steptwo.nik')
            ->join('applicant_stepthree', 'applicant_stepone.nik', '=', 'applicant_stepthree.nik')
            ->join('applicant_stepfour', 'applicant_stepone.nik', '=', 'applicant_stepfour.nik')
            ->join('applicant_stepfive', 'applicant_stepone.nik', '=', 'applicant_stepfive.nik')
            ->join('applicant_stepupload', 'applicant_stepone.nik', '=', 'applicant_stepupload.nik')
            ->select('*')
            ->where('applicant_stepone.nik', $nik)
            ->where('applicant_stepone.tokenreg', $tokenreg)
            ->first();

        $databank = ApplicantStepFourModel::where('nik', $nik)
            ->where('tokenreg', $tokenreg)
            ->get();

        return view(
            'applicant.laststeptopdf',
            [
                'data' => $data,
                'databank' => $databank
            ]
        );
    }
}
