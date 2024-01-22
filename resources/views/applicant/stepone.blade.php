@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
@if($checkLock != 0)
    <div class="container mt-3">
        {{-- <h4 class="content-title mb-2">Selamat Datang, {{ Auth::user()->name }}</h4> --}}
        <h6>Data Pribadi Pemohon</h6>
        @foreach($errors->all() as $error)
            <div>
                <font color='red' style="font-weight: bold;">{{$error}}</font>
            </div>
        @endforeach
        @if($ctStepOne == 0)
            <form action="{{ route('stepone.store') }}" method="POST">
        @else
            @foreach($stepone as $st)
                <form action="{{ route('stepone.update', $st->nik) }}" method="POST">
                    @method('PUT')
            @endforeach
        @endif
            @csrf  
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-gray-100">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Nama Sesuai KTP</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="nama" id="nama" class="form-control" required value="{{ $nama }}" placeholder="Nama Sesuai KTP" readonly>  
                                        <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required value="{{ $tokenreg }}" placeholder="Token reg" readonly>  
                                        
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">No KTP</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="nik" id="nik" class="form-control" required value="{{ $nik }}" placeholder="NIK" readonly>  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">No Kartu Keluarga</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="kk_stone" id="kk_stone" class="form-control" required value="{{ $kk_stone }}" placeholder="KK" onblur="validatekk()" onkeyup="formatnumber(this)">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">NPWP</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="npwp_stone" id="npwp_stone" value="{{ $npwp_stone }}" class="form-control" required placeholder="NPWP" onblur="validate()" onkeyup="formatnumber(this)">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">No Telepon/Handphone</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" required value="{{ $no_hp }}" placeholder="No Telepon/Handphone" readonly>  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Nama Gadis Ibu Kandung</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="mother_name" id="mother_name" class="form-control" required  placeholder="Nama Gadis Ibu Kandung" value="{{ $mother_name }}">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Tempat Lahir</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required  placeholder="Tempat Lahir" value="{{ $tempat_lahir }}">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-gray-100">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Tanggal Lahir</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="tgl_lahir date form-control" required id="tgl_lahir" type="text" name="tgl_lahir" value="{{ $tgl_lahir }}">			
                                        <input type="hidden" id="tgl_lahir_hid" name="tgl_lahir_hid" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="radio-inline form-label mg-b-0">Status Pernikahan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select class="form-control" style="width: 200;" name="marital_status" id="marital_status" required>
                                            <option value="" selected disabled>- Pilih Status Pernikahan -</option>
                                            @if($marital_status == "Belum Menikah")
                                            <option value="Belum Menikah" selected="true">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Duda/Janda">Duda/Janda</option>

                                            @elseif($marital_status == "Menikah")
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah" selected="true">Menikah</option>
                                            <option value="Duda/Janda">Duda/Janda</option>

                                            @elseif($marital_status == "Duda/Janda")
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Duda/Janda" selected="true">Duda/Janda</option>

                                            @else
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Duda/Janda">Duda/Janda</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Jumlah Tanggungan (Orang)</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="julah_tanggungan" id="julah_tanggungan" class="form-control" required  placeholder="Jumlah Tanggungan" value="{{ $julah_tanggungan }}">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Provinsi</label>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <select class="form-control" required style="width: 200;" name="provinsi" id="provinsi">
                                            <option value="" selected="true">- Pilih Provinsi -</option>
                                            @foreach($master_provinsi as $prod)
                                                @if($provinsi == $prod->name)
                                                    <option value="{{ $prod->name }}" selected>{{ $prod->name }}</option>
                                                @else
                                                    <option value="{{ $prod->name }}">{{ $prod->name }}</option>
                                                @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" name="provinsi" id="provinsi" class="form-control" required  placeholder="Provinsi" value="{{ $provinsi }}">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Kabupaten/Kota</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="kabupatenkota" id="kabupatenkota" class="form-control" required  placeholder="Kabupaten/Kota" value="{{ $kabupatenkota }}" readonly>  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Kecamatan</label>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <select class="form-control" required style="width: 200;" name="kecamatan" id="kecamatan" onchange="selectdesa();">
                                            <option value="" selected="true">- Pilih Kecamatan -</option>
                                            @foreach($master_kecamatan as $prod)
                                                @if($kecamatan == $prod->name)
                                                    <option value="{{ $prod->name }}" selected>{{ $prod->name }}</option>
                                                @else
                                                    <option value="{{ $prod->name }}">{{ $prod->name }}</option>
                                                @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" name="kecamatan" id="kecamatan" class="form-control" required  placeholder="Kecamatan" value="{{ $kecamatan }}">  
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-gray-100">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Desa/Kelurahan</label>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <select class="form-control" required style="width: 200;" name="desa" id="desa">
                                            <option value="" selected="true">- Pilih Desa/Kelurahan -</option>
                                            @foreach($master_kelurahan as $prod)
                                                @if($desa == $prod->name)
                                                    <option value="{{ $prod->name }}" selected>{{ $prod->name }}</option>
                                                @else
                                                    <option value="{{ $prod->name }}">{{ $prod->name }}</option>
                                                @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" name="desa" id="desa" class="form-control" required  placeholder="Desa/Kelurahan" value="{{ $desa }}">   
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">RT/RW</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="rt" id="rt" class="form-control" required  placeholder="RT" value="{{ $rt }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="rw" id="rw" class="form-control" required  placeholder="RW" value="{{ $rw }}"> 
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="alamat" class="form-label mg-b-0">Alamat</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" required id="alamat" name="alamat">{{ $alamat }}</textarea>
                                    </div>  
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Kode Pos</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="number" name="kodepos" id="kodepos" class="form-control" required  placeholder="Kode Pos" value="{{ $kodepos }}">  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="radio-inline form-label mg-b-0">Status Kepemilikan Hunian</label>
                                    </div>
                                    <select class="form-control"  style="width: 200;" name="housing" id="housing" required>
                                        <option value="" selected disabled>- Pilih Status Hunian -</option>
                                        @foreach($master_housing as $prod)
                                            @if($housing == $prod->kode_housing )
                                                <option value="{{ $prod->kode_housing }}" selected="true">{{ $prod->nama_housing }}</option>
                                            @else
                                                <option value="{{ $prod->kode_housing }}">{{ $prod->nama_housing }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Lama Tinggal</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="los_year" id="los_year" class="form-control" required  placeholder="Tahun" value="{{ $los_year }}">
                                    </div>
                                    tahun
                                    <div class="col-md-4">
                                        <input type="text" name="los_month" id="los_month" class="form-control" required  placeholder="Bulan" value="{{ $los_month }}">
                                    </div>
                                    bulan
                                </div>
                                {{-- <a href="{{ url('steptwo') }}" class="btn btn-primary" style="float: right;">Selanjutnya</a> --}}
                                <a href="{{ url('kta') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali ke Beranda</a>
                                <button type="submit" class="btn btn-sm btn-primary" style="float: right;">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@else
    <div class="container mt-3">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <center><p style="font-weight: bolder;">TERKUNCI</p></center>
                </div>
            </div>
        </div>
    </div>
@endif

<script type="text/javascript">
    $('#tgl_lahir').datepicker({  
       format: 'dd-mm-yyyy',
        todayHighlight: true
     });

    //  $('.to_date').datepicker({  
    //     format: 'dd-mm-yyyy',
    //     todayHighlight: true,
    //  });

     $('#tgl_lahir').on('changeDate', function(e){
        $(this).next('input[type=hidden]').val(moment(e.date).format('YYYYMMDD'));
     });

    //  $('.to_date').on('changeDate', function(e){
    //     $(this).next('input[type=hidden]').val(moment(e.date).format('YYYYMMDD'));
    //  });
     
</script>

<script>
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

</script>

<script>
    function validate()
    {
      var npwp = document.getElementById('npwp_stone').value;
  
      if(npwp == "" || npwp == null)
      {
        alert('Kolom NPWP harus diisi.');
        return false;
      }
  
      if(npwp.length > 15 || npwp.length < 15){
        alert('NPWP harus 15 karakter');
        $('[name="npwp_stone"]').val("");
        return false;
      }
    // console.log(npwp.length);
    }
</script>

<script>
    function validatekk()
    {
      var kk = document.getElementById('kk_stone').value;
  
      if(kk == "" || kk == null)
      {
        alert('Kolom KK harus diisi.');
        return false;
      }
  
      if(kk.length > 16 || kk.length < 16){
        alert('KK harus 16 karakter');
        $('[name="kk_stone"]').val("");
        return false;
      }
    // console.log(npwp.length);
    }
</script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(function() {
        $('#provinsi').on('change', function() {
            let provinceId = $('#provinsi').val();
            // Send ID to Controller
            $.ajax({
                type: 'POST',
                url: "{{ route('getRegency') }}",
                data: {provinceId: provinceId},
                cache: false,
                success: function(msg) {
                    $('#kabupatenkota').html(msg);
                    $('#kecamatan').html('');
                    $('#desa').html('');
                },
                error: function(err) {
                    console.log('error: ', err);
                },
            });
        });
    });
    
    // $(function() {
    //     $('#kabupatenkota').on('change', function() {
    //         let regencyId = $('#kabupatenkota').val();
    //         // Send ID to Controller
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('getDistrict') }}",
    //             data: {regencyId: regencyId},
    //             cache: false,
    //             success: function(msg) {
    //                 $('#kecamatan').html(msg);     
    //                 $('#desa').html('');
    //             },
    //             error: function(err) {
    //                 console.log('error: ', err);
    //             },
    //         });
    //     });
    // });
    // $(function() {
    //     $('#kecamatan').on('change', function() {
    //         let districtId = $('#kecamatan').val();
    //         // Send ID to Controller
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('getVillage') }}",
    //             data: {districtId: districtId},
    //             cache: false,
    //             success: function(msg) {
    //                 $('#desa').html(msg);
    //             },
    //             error: function(err) {
    //                 console.log('error: ', err);
    //             },
    //         });
    //     });
    // });
</script>
@endsection

