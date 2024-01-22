<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\ApplicantStepFiveModel;
use App\Models\ApplicantStepFourModel;
use App\Models\ApplicantStepOneModel;
use App\Models\ApplicantStepThreeModel;
use App\Models\ApplicantStepTwoModel;
use App\Models\ApplicantStepUploadModel;
use App\Models\Quickcount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KTAController extends Controller
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
        $ip_address = session('ip_address');
        $name = session('name');
        $url = $request->fullUrl();
        $device_status = '';
        $role = session('role');

        // dd($role);

        $ctArgasunya = DB::table('sourcekpu')
            ->where('desa', 'ARGASUNYA')
            ->count();

        $ctKalijaga = DB::table('sourcekpu')
            ->where('desa', 'KALIJAGA')
            ->count();

        $ctIbasArgasunya = DB::table('datasubmitted')
            ->where('idarea', '2')
            ->count();

        $ctIbasKalijaga = DB::table('datasubmitted')
            ->where('idarea', '1')
            ->count();

        $quick_count = Quickcount::get();

        if ($role == 'administrator') {
            return view(
                'kta.index',
                [
                    "ctArgasunya" => $ctArgasunya,
                    'ctKalijaga' => $ctKalijaga,
                    "ctIbasArgasunya" => $ctIbasArgasunya,
                    "ctIbasKalijaga" => $ctIbasKalijaga,
                    "quick_count" => $quick_count,
                    // "stepfour" => $stepfour,
                    // "stepfive" => $stepfive,
                    // "stepupload" => $stepupload,
                    // 'device_status' => $device_status,
                    // "ipreg" => $ipreg,
                    // 'ref_no' => $ref_no,
                    // 'listRef' => $listRef,
                    // 'ctDBR' => $ctDBR,
                    // 'lastDBR' => $lastDBR,
                    // 'pekerjaan' => $pekerjaan,
                    // 'ctScoring' => $ctScoring,
                    // 'resultScoring' => $resultScoring,
                    // 'ctApproval' => $ctApproval,
                    // 'ctDisbursement' => $ctDisbursement,
                    // 'statusApproval' => $statusApproval,
                    // 'commentApproval' => $commentApproval,
                    // 'checkLockOne' => $checkLockOne,
                    // 'checkLockTwo' => $checkLockTwo,
                    // 'checkLockThree' => $checkLockThree,
                    // 'checkLockFour' => $checkLockFour,
                    // 'statusappr' => $statusappr
                ]
            );
        } else {
        }
    }
}
