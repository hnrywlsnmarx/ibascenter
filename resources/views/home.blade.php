@extends('layouts.appwelcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Landing Page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Email anda sudah terverifikasi. Lakukan Logout terlebih dahulu untuk memastikan Session anda tercatat dalam sistem, kemudian Silahkan klik link <a href="{{ url('logon') }}">ini</a> untuk login --}}
                    Email anda sudah terverifikasi. <u style="color: red; font-weight: bolder;">Harap simpan link (https://bws.kta-online.com) dan Lakukan Logout</u> <b style='font-size: smaller;'>(terletak di pojok kanan atas layar perangkat anda)</b> terlebih dahulu untuk memastikan Session anda tercatat dalam sistem, kemudian Silahkan Login kembali.

                    {{-- <br>
                    <br>
                    Jika anda tidak menerima Email Konfirmasi
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik disini untuk meminta Email Konfirmasi yang lain</button>.
                    </form> --}}
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
