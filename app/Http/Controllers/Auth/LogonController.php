<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Mail\SendPermitMail;

use App\Models\AktifitasModel;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Session;



class LogonController extends Controller

{

    // public function __construct()

    // {

    // $this->middleware(['auth', 'verified']);

    // $this->middleware('auth');

    // }



    //

    public function index()

    {

        if (Auth::check()) {

            return redirect('kta');
        } else {

            return view("auth.login");
        }
    }



    public function reloadCaptcha()

    {

        return response()->json(['captcha' => captcha_img()]);
    }



    public function login(Request $request)

    {

        $ipinput = $request->ip_address;

        // dd($ipinput);

        $usernameinput = $request->username;

        // $passwordinput = bcrypt($request->password);

        $passwordinput = $request->password;

        $captchainput = $request->captcha;

        $url = $request->fullUrl();

        $ua = $request->userAgent();



        $details = [

            'title' => 'Percobaan Login menggunakan Perangkat Baru',

            'body' => 'Anda terdeteksi melakukan percobaan untuk login dengan menggunakan perangkat baru',

            'akun' => $usernameinput,

            'waktu' => now(),

            'ip_address' => $ipinput,

            'browser' => $ua

        ];



        $getuserx = $this->getUsers($usernameinput);

        // dd($getuserx);

        if ($getuserx->isEmpty()) {

            AktifitasModel::insert([

                'nik' => 'Unrecognized NIK',

                'email' => $usernameinput,

                'ip_address' => $ipinput,

                'nama' => 'Unrecognized Name',

                'url' => $url,

                'action' => 'Attempt to Login',

                'status' => 'Failed',

                'caused_by' => 'Unrecognized User',

                'created_at' => now(),

                'updated_at' => now(),

            ]);

            return redirect()->back()

                ->with('error', 'User tidak terdaftar dalam sistem');
        } else {

            $id = $getuserx[0]->id;

            $nik = $getuserx[0]->nik;

            $role = $getuserx[0]->role;

            $username = $getuserx[0]->username;

            $name = $getuserx[0]->name;

            $email = $getuserx[0]->email;

            $no_hp = $getuserx[0]->no_hp;

            $ip_address = $getuserx[0]->ip_address;



            // dd($getuserx[0]->nik);

        }



        $val = $request->validate([

            'username' => 'required',

            'password' => 'required',



        ]);



        $valcaptcha = $request->validate(['captcha' => 'captcha|required']);



        $userCT = DB::table('users')

            ->where('username', '=', $usernameinput)

            ->count();



        if (Auth::attempt($val) && $ipinput != $ip_address) {

            Session::put('id', $id);

            Session::put('nik', $nik);

            Session::put('name', $name);

            Session::put('role', $role);

            Session::put('email', $email);

            Session::put('no_hp', $no_hp);

            Session::put('ip_address', $ip_address);



            AktifitasModel::insert([

                'nik' => $nik,

                'email' => $email,

                'ip_address' => $ip_address,

                'nama' => $name,

                'url' => $url,

                'action' => 'Attempt to Login',

                'status' => 'Success',

                'caused_by' => 'New Device Login',

                'created_at' => now(),

                'updated_at' => now(),

            ]);

            // Mail::to($email)->send(new SendPermitMail($details));

            return redirect('/kta');
        } else if (!Auth::Attempt($val)) {

            Session::flash('error', 'Email atau Password Salah');

            AktifitasModel::insert([

                'nik' => $nik,

                'email' => $email,

                'ip_address' => $ip_address,

                'nama' => $name,

                'url' => $url,

                'action' => 'Attempt to Login',

                'status' => 'Failed',

                'caused_by' => 'Wrong Password or Email',

                'created_at' => now(),

                'updated_at' => now(),

            ]);

            return redirect('/');
        } else {

            Session::put('id', $id);

            Session::put('nik', $nik);

            Session::put('name', $name);

            Session::put('role', $role);

            Session::put('email', $email);

            Session::put('no_hp', $no_hp);

            Session::put('ip_address', $ip_address);



            AktifitasModel::insert([

                'nik' => $nik,

                'email' => $email,

                'ip_address' => $ip_address,

                'nama' => $name,

                'url' => $url,

                'action' => 'Attempt to Login',

                'status' => 'Succes',

                'caused_by' => '',

                'created_at' => now(),

                'updated_at' => now(),

            ]);

            return redirect('/kta');
        }
    }



    private function getUsers($email)

    {

        $report = DB::table('users')

            ->where('username', $email)

            ->get();



        return $report;
    }



    public function logouts(Request $request)

    {

        $nik = session('nik');

        $email = session('email');

        $name = session('name');

        $ip_address = session('ip_address');

        $url = $request->fullUrl();

        $ip_address = session('ip_address');

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();



        AktifitasModel::insert([

            'nik' => $nik,

            'email' => $email,

            'ip_address' => $ip_address,

            'nama' => $name,

            'url' => $url,

            'action' => 'Attempt to Logout',

            'status' => 'Success',

            'caused_by' => '',

            'created_at' => now(),

            'updated_at' => now(),

        ]);

        return redirect('/');
    }



    public function startLogin()

    {

        if (Auth::check()) {

            return redirect('kta');
        } else {

            return view("auth.login");
        }
    }



    public function actionlogin(Request $request)

    {

        $data = [

            'email' => $request->input('email'),

            'password' => $request->input('password'),

        ];



        if (Auth::Attempt($data)) {

            return redirect('kta');
        } else {

            Session::flash('error', 'Email atau Password Salah');

            return redirect('/');
        }
    }
}
