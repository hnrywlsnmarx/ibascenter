@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                <center><b>{{ session()->get('error') }}</b></center>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                <center>{{ session()->get('success') }}</center>
            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgb(50, 86, 248); color: white;"><center><b>Registrasi</b></center></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validate()">
                            @csrf
                            <div class="row mb-3">
                                <center><small><b style="color: blue">NIK yang anda gunakan untuk mendapatkan akses menuju halaman ini</b></small></center>
                                <label for="nik" class="col-md-4 col-form-label text-md-end"><b>*</b> {{ __('NIK') }}</label>
                                <div class="col-md-6">
                                    <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus onkeyup="formatnumber(this)">

                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <center><small><b style="color: blue">Token Registrasi yang anda terima pada email anda</b></small></center>
                                <label for="tokenreg" class="col-md-4 col-form-label text-md-end"><b>*</b> {{ __('Token Registrasi') }}</label>
                                <div class="col-md-6">
                                    <input id="tokenreg" type="text" class="form-control @error('tokenreg') is-invalid @enderror" name="tokenreg" value="{{ old('tokenreg') }}" required autocomplete="tokenreg" autofocus onblur="getData()">

                                    @error('tokenreg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus readonly>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="kabupatenkota" class="col-md-4 col-form-label text-md-end">{{ __('Kabupaten/Kota') }}</label>
                                <div class="col-md-6">
                                    <input id="kabupatenkota" type="text" class="form-control @error('kabupatenkota') is-invalid @enderror" name="kabupatenkota" value="{{ old('kabupatenkota') }}" required autocomplete="kabupatenkota" autofocus readonly>
                                    @error('kabupatenkota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" readonly>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-md-4 col-form-label text-md-end">{{ __('No Handphone') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" autofocus readonly>

                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnreg">
                                        {{ __('Register') }}
                                    </button>
                                    <a class="btn btn-sm btn-danger" href="{{ url('logon') }}" style="float: right;">
                                        Sudah punya akun? Login disini
                                    </a>
                                </div>
                            </div>
                        </form>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function validate()
    {
      var nik = document.getElementById('nik').value;
  
      if(nik == "" || nik == null)
      {
        alert('Kolom NIK harus diisi.');
        return false;
      }
  
      if(nik.length > 16 || nik.length < 16){
        alert('NIK harus 16 karakter');
        // $('[name="nik"]').val("");
        return false;
      }
    }
  
      function formatnumber(objek) {
        a = objek.value;
        b = a.replace(/[^\d]/g,'');
        c = '';
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
          j = j + 1;
          if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i-1,1) + '' + c;
          } else {
            c = b.substr(i-1,1) + c;
          }
        }
        objek.value = c;
      }

      function getData(){
        var nikinput = document.getElementById('nik').value;
        var tokeninput = document.getElementById('tokenreg').value;
        var url = '/get-datanik/' + nikinput +'/'+ tokeninput;

        if(nikinput == ''){
            // $('[name="nik"]').val("Jangan kosongin aku :(");
        }else if(tokeninput == ''){
            // $('[name="tokenreg"]').val("Aku juga jangan kosongin :(");
        }else{
            $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(data){
                if(data.length > 0){
                    return {
                    results: $.map(data, function (item) {
                        $('[name="name"]').css("color","black").css("background","white").val(item.nama);
                        $('[name="email"]').css("color","black").css("background","white").val(item.email);
                        $('[name="no_hp"]').css("color","black").css("background","white").val(item.no_hp);
                        $('[name="kabupatenkota"]').css("color","black").css("background","white").val(item.kabupatenkota);
                        document.getElementById("btnreg").disabled = false;
                    })
                };
                } else {
                    $('[name="name"]').css("color","white").css("background-color","red").val("No Data");
                    $('[name="email"]').css("color","white").css("background-color","red").val("No Data");
                    $('[name="no_hp"]').css("color","white").css("background-color","red").val("No Data");
                    $('[name="kabupatenkota"]').css("color","white").css("background-color","red").val("No Data");
                    document.getElementById("btnreg").disabled = true;
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("Gagal memperoleh data");
              }
        });
        }
      }
  </script>


