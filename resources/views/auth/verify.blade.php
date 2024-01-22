@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Segera Lakukan Verifikasi Email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Kami telah mengirimkan Link untuk melakukan Verifikasi Email. Mohon untuk segera memeriksa email anda dan lakukan Verifikasi Email agar anda bisa melanjutkan proses Permohonan KTA. Jika anda tidak menerima Email Konfirmasi
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik disini untuk meminta Email Konfirmasi yang lain</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
