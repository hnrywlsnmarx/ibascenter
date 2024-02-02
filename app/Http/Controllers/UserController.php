<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\User;
use App\Models\Branchlist;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $pagination  = 3;
        $users    = User::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%");
        })->orderBy('created_at', 'desc')->paginate($pagination);

        $users->appends($request->only('keyword'));

        return view('users.index', [
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
        return view('users.create');
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
        $emailuser = $request->input('email');
        $no_hp = $request->input('no_hp');
        $username = $request->input('username');
        $password = bcrypt($request->input('password'));
        $role = $request->input('role');
        $status = $request->input('status');

        // dd($nikuser);

        $request->validate([
            'role' => 'required',
            'email' => 'required',
            'name' => 'required',
            'username' => 'required',
            'nik' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $user_bank = DB::table('users')
            ->select('nik')
            ->pluck('nik');

        // dd($user_bank);
        if ($user_bank->contains($nikuser)) {
            return redirect()->back()->withErrors("User sudah terdaftar")->withInput();
        } else {
            // User::create($request->all());

            User::insert([
                'nik' => $nikuser,
                'email' => $emailuser,
                'ip_address' => $ip_address,
                'name' => $namauser,
                'username' => $username, 
                'role' => $role,
				'password' => $password,
                'status' => $status,
                'no_hp' => $no_hp,
                'email_verified_at' => now(),
                'created_at' => now(),

            ]);

            AktifitasModel::insert([
                'nik' => $nik,
                'email' => $nik,
                'ip_address' => $ip_address,
                'nama' => $namaap,
                'url' => $url,
                'action' => 'Create User ' . $username,
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($user);
        return view(
            'users.show',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      

        $roleall = [];
        $rolelist = Role::select("id", "name")
            ->where('id', $user->role)
            ->orderBy('id', 'asc')
            ->get();
        foreach ($rolelist as $role) {
            $roleall[] = $role->id;
        }

        $statusall = [];
        $statuslist = DB::table('status')
            ->select('id', 'nama')
            ->where('id', $user->status)
            ->orderBy('id', 'asc')
            ->get();
        foreach ($statuslist as $status) {
            $statusall[] = $status->id;
        }
        //dd($branchall);
        //return view('users.create',compact('branchlist'));
        return view('users.edit', compact('user',  'rolelist', 'roleall', 'statuslist', 'statusall'));
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
