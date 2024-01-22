<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\IpUtils;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {

        $nikinput = Request::input('nik');
        $emailinput = Request::input('email');
        $nik = DB::table('users')
            ->select('nik')
            ->where('nik', '=', $nikinput)
            ->count();

        $email = DB::table('users')
            ->select('email')
            ->where('email', '=', $emailinput)
            ->count();

        $name = DB::table('users')
            ->select('name')
            ->where('nik', '=', $nikinput)
            ->count();

        $nameinput = DB::table('users')
            ->select('name')
            ->where('nik', '=', $nikinput)
            ->pluck('name')->first();

        $url = Request::fullUrl();
        $clientIP = Request::getClientIp(true);

        if ($nik > 0) {
            AktifitasModel::insert([
                'nik' => $nikinput,
                'email' => $emailinput,
                'ip_address' => $clientIP,
                'nama' => $nameinput,
                'url' => $url,
                'action' => 'Attempt to Register',
                'status' => 'Failed',
                'caused_by' => 'NIK already registered',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()
                ->with('error', 'NIK anda sudah pernah terdaftar dalam sistem');
        } else if ($email > 0) {
            AktifitasModel::insert([
                'nik' => $nikinput,
                'email' => $emailinput,
                'ip_address' => $clientIP,
                'nama' => $nameinput,
                'url' => $url,
                'action' => 'Attempt to Register',
                'status' => 'Failed',
                'caused_by' => 'Email already registered',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()
                ->with('error', 'Email anda sudah pernah terdaftar dalam sistem');
        } else {

            AktifitasModel::insert([
                'nik' => $nikinput,
                'email' => $emailinput,
                'ip_address' => $clientIP,
                'nama' => $data['name'],
                'url' => $url,
                'action' => 'Attempt to Register',
                'status' => 'Success',
                'caused_by' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return User::create([
                'nik' => $data['nik'],
                'tokenreg' => $data['tokenreg'],
                'name' => $data['name'],
                'email' => $data['email'],
                'kabupatenkota' => $data['kabupatenkota'],
                'no_hp' => $data['no_hp'],
                'password' => Hash::make($data['password']),
                'ip_address' => $clientIP,
            ]);
        }
    }

    public function getDataNIK($id = 0, $token = 0)
    {
        $data = DB::table('kta_requestor')
            ->where('nik', '=', $id)
            ->where('tokenreg', '=', $token)
            ->select('*')
            ->get();
        echo json_encode($data);
    }
}
