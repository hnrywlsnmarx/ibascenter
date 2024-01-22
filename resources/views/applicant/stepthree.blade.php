@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
@if($checkLock != 0)
    <div class="container mt-3">
        {{-- <h4 class="content-title mb-2">Selamat Datang, {{ Auth::user()->name }}</h4> --}}
        <h6>Data Pekerjaan Pemohon</h6>
        @foreach($errors->all() as $error)
            <div>
                <font color='red' style="font-weight: bold;">{{$error}}</font>
            </div>
        @endforeach
        @if($ctStepThree == 0)
            <form action="{{ route('stepthree.store') }}" method="POST">
        @else
            @foreach($stepthree as $st)
                <form action="{{ route('stepthree.update', $st->nik) }}" method="POST">
                    @method('PUT')
            @endforeach
        @endif
            @csrf  
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $tokenreg }}">  
                                </div>
                                <div class="col-md-12 mb-0">
                                    <label class="form-label mg-b-0">Pekerjaan</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" required style="width: 190;" name="pekerjaan" id="pekerjaan" onchange="onSelectPekerjaan()">
                                        <option value="" selected disabled>- Pilih Pekerjaan -</option>
                                        @foreach($master_pekerjaan as $prod)
                                            @if(( $pekerjaan == $prod->kode_pekerjaan ))
                                                <option value="{{ $prod->kode_pekerjaan }}" selected="true">{{ $prod->nama_pekerjaan }}</option>
                                            @else
                                                <option value="{{ $prod->kode_pekerjaan }}">{{ $prod->nama_pekerjaan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="bidus" style="display: none;">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Bidang Usaha</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" style="width: 300;" name="bidang_usaha" id="bidang_usaha">
                                        <option value="" selected disabled>- Pilih Bidang Usaha -</option>
                                        @foreach($master_bidang_usaha as $prod)
                                            @if(( $bidang_usaha == $prod->kode_bidang_usaha ))
                                                <option value="{{ $prod->kode_bidang_usaha }}" selected="true">{{ $prod->nama_bidang_usaha }}</option>
                                            @else
                                                <option value="{{ $prod->kode_bidang_usaha }}">{{ $prod->nama_bidang_usaha }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="jab" style="display: none;">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jabatan</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" style="width: 170;" name="jabatan" id="jabatan">
                                        <option value="" selected disabled>- Pilih Jabatan -</option>
                                        @foreach($master_jabatan as $prod)
                                            @if(( $jabatan == $prod->kode_jabatan ))
                                                <option value="{{ $prod->kode_jabatan }}" selected="true">{{ $prod->nama_jabatan }}</option>
                                            @else
                                                <option value="{{ $prod->kode_jabatan }}">{{ $prod->nama_jabatan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required placeholder="Nama Perusahaan" value="{{ $nama_perusahaan }}">  
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Lama Bekerja</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="lama_bekerja_tahun" id="lama_bekerja_tahun" class="form-control" required value="{{ $lama_bekerja_tahun }}" placeholder="Tahun">
                                </div>
                                tahun
                                <div class="col-md-4">
                                    <input type="text" name="lama_bekerja_bulan" id="lama_bekerja_bulan" class="form-control" required value="{{ $lama_bekerja_bulan }}" placeholder="Bulan">
                                </div>
                                bulan
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alamat" class="form-label mg-b-0">Alamat Perusahaan/Tempat Usaha</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" required id="alamat_kantor" name="alamat_kantor">{{ $alamat_kantor }}</textarea>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">No Telepon Perusahaan</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="tel_kantor" id="tel_kantor" class="form-control" required value="{{ $tel_kantor }}" placeholder="No Telepon Perusahaan">  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Sumber Penghasilan</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 220;" name="sumber_penghasilan" id="sumber_penghasilan">
                                        <option value="" selected disabled>- Pilih Sumber Penghasilan -</option>
                                        @if($sumber_penghasilan == "Gaji")
                                        <option value="Gaji" selected="true">Gaji</option>
                                        <option value="Usaha">Usaha</option>
                                        @elseif($sumber_penghasilan == "Usaha")
                                        <option value="Gaji">Gaji</option>
                                        <option value="Usaha" selected="true">Usaha</option>
                                        @else
                                        <option value="Gaji">Gaji</option>
                                        <option value="Usaha">Usaha</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Penghasilan Perbulan</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="penghasilan_perbulan" id="penghasilan_perbulan" class="form-control" required value="{{ $penghasilan_perbulan_number }}" placeholder="Penghasilan Perbulan" onblur="formatRupiah()" autofocus onkeyup="formatnumber(this)" onfocus="formatnumber(this)">
                                </div>
                                <input type="hidden" name="penghasilan_perbulan_number" id="penghasilan_perbulan_number" class="form-control" required value="{{ $penghasilan_perbulan_number }}"  placeholder="Penghasilan Perbulan Number">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Memiliki Rekening BWS</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 110;" name="have_bws_acc" id="have_bws_acc">
                                        <option value="" selected="true">- Pilih Opsi -</option>
                                        @if($have_bws_acc == 'Ya')
                                        <option value="Ya" selected>Ya</option>
                                        <option value="Tidak">Tidak</option>
                                        @elseif($have_bws_acc == 'Tidak')
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak" selected>Tidak</option>
                                        @else
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" style="display: block;" id="hiderek">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Nomor Rekening</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="number" name="acc_no" id="acc_no" class="form-control" value="{{ $acc_no }}" required placeholder="Nomor Rekening">
                                </div>
                            </div>
                            <a href="{{ url('steptwo') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali ke Step 2</a>
                            <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Selanjutnya</button>
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
    function formatRupiah(){
        const val = document.getElementById('penghasilan_perbulan').value;
        const asli = document.getElementById('penghasilan_perbulan_number').value = val;
        const formatter = new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(val);
        var form = formatter;
        // console.log(form)
        $('[name="penghasilan_perbulan"]').val(form);
    }
</script>

<script>
    function onSelectPekerjaan(){
        const val = document.getElementById('pekerjaan').value;
        const jabat = document.getElementById('jabatan');
        const bidusa = document.getElementById('bidang_usaha');
        // alert(val);

        if(val != 'Pengusaha'){
            document.getElementById('jab').style.display = "block";
            document.getElementById('bidus').style.display = "none";
            jabat.required = false;
        } else if(val == 'Pengusaha') {
            document.getElementById('bidus').style.display = "block";
            document.getElementById('jab').style.display = "none";
            bidusa.required = false;
        }
    }
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
        $(document).ready(function(){
        $("#have_bws_acc").change(function(){
            if($(this).val() == "Ya"){
                $("#hiderek").show();
                
            } else if($(this).val() == "Tidak"){
                //  $("#bank_penerbit").value = 0;
                $("#hiderek").hide();
                $('[name="acc_no"]').val(0);
            }
            
        });
    });
    </script>
@endsection

