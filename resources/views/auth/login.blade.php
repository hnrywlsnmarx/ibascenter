@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                <center>{{ session()->get('error') }}</center>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                <center>{{ session()->get('success') }}</center>
            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgb(169, 220, 199); color: rgb(0, 0, 0);"><center><b>Login wong login</b></center></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <input id="ip_address" type="hidden" class="form-control" name="ip_address" value="{{ Request::getClientIp(true) }}" required autocomplete="ip_address" autofocus>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="captcha" class="col-md-4 col-form-label text-md-end">Captcha</label>
                                <div class="col-md-6">
                                    <div class="col-md-6 captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success" class="reload" id="reload" onclick="reloadCap()">
                                            &#x21bb;
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="captcha" class="col-md-4 col-form-label text-md-end">Enter Captcha</label>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" required name="captcha">
                                        <br>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <center><b>Wrong Captcha!</b></center>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success" style="float: right;">
                                        {{ __('Login') }}
                                    </button>
                                    {{-- <a class="btn btn-sm btn-danger" href="{{ url('registrasi') }}" style="float: right;">
                                        Belum punya akun? Daftar disini
                                    </a> --}}
                                </div>
                                {{-- <div class="col-md-8 offset-md-4 mt-3" >
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-sm btn-success" href="{{ route('password.request') }}" style="float: right;">
                                            Lupa Password
                                        </a>
                                    @endif
                                     --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function reloadCap(){
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    }
</script>
