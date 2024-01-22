<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\User;
use App\Models\Branchlist;
use App\Models\Datasubmitted;
use App\Models\Filefoto;
use App\Models\Quickcount;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuickCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:administrator');
        //$this->middleware('role:staff');
    }

    public function index(Request $request)
    {
        $pagination  = 10;
        $users    = Quickcount::when($request->keyword, function ($query) use ($request) {
            $query->where('desa', 'like', "%{$request->keyword}%");
        })->orderBy('created_at', 'desc')->paginate($pagination);

        $users->appends($request->only('keyword'));

        return view('quick.index', [
            'nik'    => 'NIK',
            'users' => $users,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }



    public function branchSearch(Request $request)
    {
        $branch = [];

        if ($request->has('q')) {
            $search = $request->q;
            $branch = Branchlist::select("branch_code", "branch_name")
                ->where('branch_name', 'LIKE', "%$search%")
                ->orderBy('branch_code', 'asc')
                ->get();
        } else {
            $search = $request->q;
            $branch = Branchlist::select("branch_code", "branch_name")
                ->orderBy('branch_code', 'asc')
                ->get();
        }
        return response()->json($branch);
    }

    public function saksiSearch(Request $request)
    {
        $saksi = User::select("nik", "name")
            ->where('role', 'saksi')
            ->get();
        return response()->json($saksi);
    }

    public function tpsSearch($desa)
    {
        // dd($desa);

        $tps = DB::table('tps')
            ->select('id', 'notps', 'desa')
            ->where('desa', $desa)
            ->get();

        return response()->json($tps);
    }

    public function getTps(Request $request)
    {
        $desaValue = $request->desaValue;
        $tps = DB::table('tps')
            ->where('desa', $desaValue)->get();
        // dd($regencies);
        $option = "<option>- Pilih TPS -</option>";
        foreach ($tps as $t) {
            $option .= "<option value='$t->id'>$t->notps | $t->desa</option>";
        }

        echo $option;
    }

    public function nikSearch(Request $request)
    {
        $nik = [];

        if ($request->has('q')) {
            $search = $request->q;
            $nik = DB::connection('mysql2')
                ->table('data_employee')
                ->select('id', 'name', 'branch_id')
                ->where('id', 'LIKE', "%$search%")
                ->get();
        } else {
            $search = $request->q;
            $nik = DB::connection('mysql2')
                ->table('data_employee')
                ->select('id', 'name', 'branch_id')
                ->get();
        }
        return response()->json($nik);
    }

    public function getDataNIK($id = 0)
    {
        $data = DB::connection('mysql2')
            ->table('data_employee')
            ->join('master_branch', 'data_employee.branch_id', '=', 'master_branch.id')
            ->join('auth_user', 'data_employee.id', '=', 'auth_user.username')
            ->where('data_employee.id', '=', $id)
            ->select('data_employee.id', 'data_employee.name', 'data_employee.branch_id', 'master_branch.id as branchehr', 'master_branch.name as namacabehr', 'auth_user.email')
            ->get();
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $saksis = User::where('role', 'saksi')->get();

        return view(
            'quick.create',
            [
                'saksis' => $saksis,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $username = $request->email;
        $password = $request->password;
        $ip_address = $request->ip_address;
        $url = $request->fullUrl();

        $nik = session('nik');
        $namaap = session('name');
        $notps = $request->input('notps');
        $desa = $request->input('desa');
        $nama_saksi = $request->input('nama_saksi');
        $suara_masuk = $request->input('suara_masuk');
        $suara_ibas = $request->input('suara_ibas');
        $suara_sah = $request->input('suara_sah');
        $suara_tidak_sah = $request->input('suara_tidak_sah');
        $suara_abstain = $request->input('suara_abstain');
        $ket = $request->input('ket');
        $created_by = $request->input('created_by');

        $tpsname = DB::table('tps')
            ->select('notps')
            ->where('id', $notps)
            ->pluck('notps')
            ->last();

        $saksi_name = User::select('name')
            ->where('nik', $nama_saksi)
            ->pluck('name')
            ->last();

        // dd($notps);

        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $quick_count = "quick_count";
        $folder = $formatYear . "/" . $quick_count . "/" . $desa . "/"  . $tpsname;

        $namec1 = $request->file('foto_c1')->getClientOriginalName();
        $namec1store = "C1_" . $desa . '_' . $tpsname . "_" . $namec1;
        $extc1 = $request->file('foto_c1')->getClientOriginalExtension();

        $namec1_1 = $request->file('foto_c1_1')->getClientOriginalName();
        $namec1_1store = "C1_1_" . $desa . '_' . $tpsname . "_" . $namec1_1;
        $extc1_1 = $request->file('foto_c1_1')->getClientOriginalExtension();

        $namec1_2 = $request->file('foto_c1_2')->getClientOriginalName();
        $namec1_2store = "C1_2_" . $desa . '_' . $tpsname . "_" . $namec1_2;
        $extc1_2 = $request->file('foto_c1_2')->getClientOriginalExtension();

        $namec1_3 = $request->file('foto_c1_3')->getClientOriginalName();
        $namec1_3store = "C1_3_" . $desa . '_' . $tpsname . "_" . $namec1_3;
        $extc1_3 = $request->file('foto_c1_3')->getClientOriginalExtension();

        // dd($namektp = $request->file('foto_ktp'));
        // dd($nikuser);

        $request->validate([
            'desa' => 'required',
            'notps' => 'required',
            'nama_saksi' => 'required',
            'suara_masuk' => 'required',
            'suara_ibas' => 'required',
            'suara_sah' => 'required',
            'suara_tidak_sah' => 'required',
            'created_by' => 'required',
            'suara_abstain' => 'required',
            'foto_c1' => 'required|image|mimes:jpeg,jpg|max:2048',
            'foto_c1_1' => 'required|image|mimes:jpeg,jpg|max:2048',
            'foto_c1_2' => 'required|image|mimes:jpeg,jpg|max:2048',
            'foto_c1_3' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);



        // $user_bank = DB::table('datasubmitted')
        //     ->select('nik')
        //     ->pluck('nik');

        // dd($user_bank);
        // if ($user_bank->contains($nikuser)) {
        //     return redirect()->back()->withErrors("Data sudah ada")->withInput();
        // } else {
        // User::create($request->all());

        $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
        // dd($ext);


        $inarc1 = in_array($extc1, $ext);
        $inarc1_1 = in_array($extc1_1, $ext);
        $inarc1_2 = in_array($extc1_2, $ext);
        $inarc1_3 = in_array($extc1_3, $ext);

        if ($inarc1 && $inarc1_1 && $inarc1_2 && $inarc1_3) {
            $pathc1 = $request->file('foto_c1')->storeAs($folder, $namec1store);
            // $ftpktp = Storage::disk('ftp')->put($folder . "/" . $namektpstore, fopen($request->file('copyktp'), 'r+'));
            $pathc1_1 = $request->file('foto_c1_1')->storeAs($folder, $namec1_1store);
            // $ftpnpwp = Storage::disk('ftp')->put($folder . "/" . $namenpwpstore, fopen($request->file('npwp'), 'r+'));
            $pathc1_2 = $request->file('foto_c1_2')->storeAs($folder, $namec1_2store);
            $pathc1_3 = $request->file('foto_c1_3')->storeAs($folder, $namec1_3store);

            Quickcount::insert([
                'notps' => $tpsname,
                'desa' => $desa,
                'nama_saksi' => $saksi_name,
                'suara_masuk' => $suara_masuk,
                'suara_ibas' => $suara_ibas,
                'suara_sah' => $suara_sah,
                'suara_tidak_sah' => $suara_tidak_sah,
                'suara_abstain' => $suara_abstain,
                'path' => $folder,
                'foto_c1' => $namec1store,
                'foto_c1_1' => $namec1_1store,
                'foto_c1_2' => $namec1_2store,
                'foto_c1_3' => $namec1_3store,
                'created_by' => $created_by,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $nik,
                'ip_address' => $ip_address,
                'nama' => $namaap,
                'url' => $url,
                'action' => 'Saksi ' . $saksi_name . ' membuat data Quick Count di ' . $tpsname . ' Desa ' . $desa,
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('quick.index')
                ->with('success', 'data quick count created successfully.');
        } else {
            return redirect()->back()->withErrors("Format Foto tidak sesuai")->withInput();
            // }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        // dd($id);
        $datas = Quickcount::get();        
       
        return view(
            'quick.show',
            [
                'datas' => $datas,
                // 'desa' => $desa
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Datasubmitted $user)
    {



        //dd($branchall);
        //return view('users.create',compact('branchlist'));
        return view('quick.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $username = $request->email;
        $password = $request->password;
        $ip_address = $request->ip_address;
        $url = $request->fullUrl();

        $nik = session('nik');
        $request->validate([
            'role' => 'required',
            'email' => 'required',
            'name' => 'required',
            'branch_code' => 'required',
            'nik' => 'required',
            'namacab' => 'required',
            'kodecab' => 'required',
            'status' => 'required'
        ]);

        $user->update($request->all());

        AktifitasModel::insert([
            'nik' => $nik,
            'email' => $nik,
            'ip_address' => $ip_address,
            'nama' => $nik,
            'url' => $url,
            'action' => 'Update User ' . $username,
            'status' => 'Success',
            'caused_by' => '',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
