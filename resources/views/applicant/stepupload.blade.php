@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
@if($checkLock != 0)
    <div class="container mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        {{-- <h4 class="content-title mb-2">Selamat Datang, {{ Auth::user()->name }}</h4> --}}
        <h6>Form Upload Dokumen</h6>
        @foreach($errors->all() as $error)
            <div>
            <font color='red' style="font-weight: bold;">{{$error}}</font>
            </div>
        @endforeach
        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if($ctStepUpload == 0)
                    <form action="{{ route('stepupload.store') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @else
                    @foreach($stepupload as $st)
                        <form action="{{ route('stepupload.update', $st->nik) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @endforeach
                @endif
                    @csrf  
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <b><u>Upload data - data Utama</u></b><br>
                            <div class="row mb-3 mt-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $tokenreg }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="pekerjaan" id="pekerjaan" class="form-control" required placeholder="Pekerjaan" readonly value="{{ $pekerjaan }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="havingcreditcard" id="havingcreditcard" class="form-control" required placeholder="havingcreditcard" readonly value="{{ $havingcreditcard }}">  
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Unggah Foto KTP</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="copyktp" id="copyktp" class="form-control form-control-sm" value="{{ $copyktp }}"> 
                                    <input type="hidden" name="textktp" id="textktp" class="form-control" required placeholder="textktp" readonly value="{{ $copyktp }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Unggah Foto NPWP</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="npwp" id="npwp" class="form-control form-control-sm" value="{{ $npwp }}">
                                    <input type="hidden" name="textnpwp" id="textnpwp" class="form-control" required placeholder="textnpwp" readonly value="{{ $npwp }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Unggah Foto KK</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="kk" id="kk" class="form-control form-control-sm" value="{{ $kk }}">  
                                    <input type="hidden" name="textkk" id="textkk" class="form-control" required placeholder="textkk" readonly value="{{ $kk }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary pd-x-30 mg-r-5 mg-t-5" style="float: right;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            @if($ctStepUpload != 0)
                @foreach($stepupload as $st)
                    <form action="{{ route('updatesupp', $st->nik) }}" method="POST" enctype="multipart/form-data" class="form-inline">
                        @method('PUT')
                @endforeach
            @else
                    {{-- @foreach($stepupload as $st) --}}
                        <form action="{{ route('updatesupp', $nik) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    {{-- @endforeach --}}
            @endif
                    @csrf  
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <b><u>Upload data - data pendukung</u></b><br>
                            <div class="row mb-3 mt-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $tokenreg }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="pekerjaan" id="pekerjaan" class="form-control" required placeholder="Pekerjaan" readonly value="{{ $pekerjaan }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="havingcreditcard" id="havingcreditcard" class="form-control" required placeholder="havingcreditcard" readonly value="{{ $havingcreditcard }}">  
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Unggah Foto Slip Gaji<br><small style="color: red;"><b>(*wajib upload jika pekerjaan anda ASN atau Karyawan Swasta atau Karyawan BUMN)</b></small> </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="slip_gaji" id="slip_gaji" class="form-control form-control-sm" value="{{ $slip_gaji }}">
                                        <input type="hidden" name="textslip" id="textslip" class="form-control" required placeholder="textextslip" readonly value="{{ $slip_gaji }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Unggah Foto Mutasi Rekening (3 Bulan terakhir)<br><small style="color: red;"><b>(*wajib upload jika pekerjaan anda Pengusaha)</b></small></label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="mutasirekening" id="mutasirekening" class="form-control form-control-sm" value="{{ $mutasirekening }}">  
                                        <input type="hidden" name="textmutasi" id="textmutasi" class="form-control" required placeholder="textmutasi" readonly value="{{ $mutasirekening }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Unggah Foto SIP (Surat Ijin Praktek)<br><small style="color: red;"><b>(*wajib upload jika pekerjaan anda Profesional)</b></small> </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="sip" id="sip" class="form-control form-control-sm" value="{{ $sip }}">  
                                        <input type="hidden" name="textsip" id="textsip" class="form-control" required placeholder="textsip" readonly value="{{ $sip }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Unggah Foto SIUP (Surat Ijin Usaha/Profesi)<br><small style="color: red;"><b>(*wajib upload jika pekerjaan anda Pengusaha)</b></small></label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="siup" id="siup" class="form-control form-control-sm" value="{{ $siup }}">  
                                        <input type="hidden" name="textsiup" id="textsiup" class="form-control" required placeholder="textsiup" readonly value="{{ $siup }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0">Unggah Foto Billing Kartu Kredit<br><small style="color: red;"><b>(*wajib upload jika anda mempunyai Kartu Kredit)</b></small></label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="billingcc" id="billingcc" class="form-control form-control-sm" value="{{ $billingcc }}"> 
                                        <input type="hidden" name="textbilling" id="textbilling" class="form-control" required placeholder="textbilling" readonly value="{{ $billingcc }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary pd-x-30 mg-r-5 mg-t-5" style="float: right;">Submit</button>
                    </div>
                </div>
            </div>
            </form>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <table class="table" style="width: 70%;">
                                <tr style="font-size: smaller">
                                    <td>Foto KTP</td>
                                    <td>:</td>
                                    <td>{{ $copyktp }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto KK</td>
                                    <td>:</td>
                                    <td>{{ $kk }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto NPWP</td>
                                    <td>:</td>
                                    <td>{{ $npwp }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto Slip Gaji</td>
                                    <td>:</td>
                                    <td>{{ $slip_gaji }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto Mutasi Rekening</td>
                                    <td>:</td>
                                    <td>{{ $mutasirekening }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto SIP</td>
                                    <td>:</td>
                                    <td>{{ $sip }}</td>
                                </tr>
                                <tr style="font-size: smaller">
                                    <td>Foto SIUP</td>
                                    <td>:</td>
                                    <td>{{ $siup }}</td>
                                </tr>
                                <tr style="font-size: smaller;">
                                    <td>Foto Billing Kartu Kredit</td>
                                    <td>:</td>
                                    <td>{{ $billingcc }}</td>
                                    {{-- <td><a class="btn btn-sm btn-primary" onclick="showUpdateBill()">Edit</a></td>
                                    <tr id="idbil" style="display: none; font-size: smaller;">
                                        <td>Upload Ulang Billing Kartu Kredit</td>
                                        <td>:</td>
                                        <td><input type="file" class="form-control form-control-sm"></td>
                                    </tr> --}}
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bck" class="mb-3 mt-3">
                <a href="{{ url('stepfive') }}" class="btn btn-sm btn-warning" style="float: left;" id="btnbackfirst">Kembali ke Step 5</a>
                {{-- @if( $path_supp == '') --}}
                    {{-- <a href="{{ url('selectrefno') }}" class="btn btn-primary mb-3" style="float: right; pointer-events: none;" id="btnbackfirst" disabled>Lanjutkan ke Summary</a> --}}
                {{-- @else --}}
                    <a href="{{ url('selectrefno') }}" class="btn btn-sm btn-primary mb-3" style="float: right;" id="btnnextfrst">Summary</a>
                {{-- @endif --}}
            </div>
        </div>
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


<script>
    function showUpdateBill(){
        document.getElementById('idbil').style.display = "block";
    }
</script>
@endsection