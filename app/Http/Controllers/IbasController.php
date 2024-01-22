<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\User;
use App\Models\Branchlist;
use App\Models\Datasubmitted;
use App\Models\Filefoto;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IbasController extends Controller
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
        $users    = Datasubmitted::when($request->keyword, function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->keyword}%");
        })->orderBy('created_at', 'desc')->paginate($pagination);

        $users->appends($request->only('keyword'));

        return view('ibas.index', [
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

    public function roleSearch(Request $request)
    {
        $role = [];

        if ($request->has('q')) {
            $search = $request->q;
            $role = Role::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $search = $request->q;
            $role = Role::select("id", "name")
                ->get();
        }
        return response()->json($role);
    }

    public function statusSearch(Request $request)
    {
        $status = [];

        if ($request->has('q')) {
            $search = $request->q;
            $status = DB::table('status')
                ->select('id', 'nama')
                ->where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $search = $request->q;
            $status = DB::table('status')
                ->select('id', 'nama')
                ->get();
        }
        return response()->json($status);
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
        return view('ibas.create');
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
        $nikuser = $request->input('nik');
        $namauser = $request->input('name');
        $jk = $request->input('jk');
        $usia = $request->input('usia');
        $idarea = $request->input('idarea');
        $rt = $request->input('rt');
        $rw = $request->input('rw');
        $tps = $request->input('tps');
        $ket = $request->input('ket');
        $created_by = $request->input('created_by');

        $tgl = Carbon::now();
        $formatYear = $tgl->format('Y');
        $formatMonth = $tgl->format('m');
        $formatDay = $tgl->format('d');
        $simpatisan = "simpatisan";
        $folder = $formatYear . "/" . $simpatisan . "/" . $nikuser;

        $namektp = $request->file('foto_ktp')->getClientOriginalName();
        $namektpstore = $nikuser . "_KTP_" . $namektp;
        $extktp = $request->file('foto_ktp')->getClientOriginalExtension();

        $namefoto = $request->file('foto_diri')->getClientOriginalName();
        $extfoto = $request->file('foto_diri')->getClientOriginalExtension();
        $namefotostore = $nikuser . "_FOTO_" . $namefoto;

        // dd($namektp = $request->file('foto_ktp'));
        // dd($nikuser);

        $request->validate([
            'nik' => 'required',
            'jk' => 'required',
            'name' => 'required',
            'idarea' => 'required',
            'usia' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'created_by' => 'required',
            'ket' => 'required',
            'tps' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,jpg|max:2048',
            'foto_diri' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);

        $user_bank = DB::table('datasubmitted')
            ->select('nik')
            ->pluck('nik');

        // dd($user_bank);
        if ($user_bank->contains($nikuser)) {
            return redirect()->back()->withErrors("Data sudah ada")->withInput();
        } else {
            // User::create($request->all());

            $ext = array('jpg', 'jpeg', 'JPG', 'JPEG');
            // dd($ext);


            $inarktp = in_array($extktp, $ext);
            $inarfoto = in_array($extfoto, $ext);

            if ($inarktp && $inarfoto) {
                $pathktp = $request->file('foto_ktp')->storeAs($folder, $namektpstore);
                // $ftpktp = Storage::disk('ftp')->put($folder . "/" . $namektpstore, fopen($request->file('copyktp'), 'r+'));
                $pathfoto = $request->file('foto_diri')->storeAs($folder, $namefotostore);
                // $ftpnpwp = Storage::disk('ftp')->put($folder . "/" . $namenpwpstore, fopen($request->file('npwp'), 'r+'));

                Datasubmitted::insert([
                    'nik' => $nikuser,
                    'idarea' => $idarea,
                    'nama' => $namauser,
                    'jk' => $jk,
                    'usia' => $usia,
                    'rt' => $rt,
                    'rw' => $rw,
                    'tps' => $tps,
                    'path' => $folder,
                    'foto_ktp' => $namektpstore,
                    'foto_diri' => $namefotostore,
                    'ket' => $ket,
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
                    'action' => 'Create Pemilih Kang Ibas -> ' . $namauser,
                    'status' => 'Success',
                    'caused_by' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->route('ibas.index')
                    ->with('success', 'Pemilih Kang Ibas created successfully.');
            } else {
                return redirect()->back()->withErrors("Format Foto tidak sesuai")->withInput();
            }
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
        $datas = Datasubmitted::get();

        foreach ($datas as $dat) {
            $idarea = $dat->idarea;
        }

        // dd($idarea);

        $desa = DB::table('area')
            ->select('namaarea')
            ->where('id', $idarea)
            ->pluck('namaarea')
            ->last();

        return view(
            'ibas.show',
            [
                'datas' => $datas,
                'desa' => $desa
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
        return view('ibas.edit', compact('user'));
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
