@extends('layouts.app3')

@section('content')
<center><h6 class="mt-3"><b><u>Resume Permohonan KTA</u></b></h6></center>
<div class="container-sm mt-3">
    <form action="{{ route('getpdf') }}" method="post">
    @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 33.3333%;">No Referensi Pinjaman</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;"><input type="text" id="noreftext" name="noreftext" class="form-control form-control-sm" value="{{ $data->ref_no }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">NIK</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Token Registrasi</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->tokenreg }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Nama Sesuai KTP</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">NPWP</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->npwp_stone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">No Handphone</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Nama Gadis Ibu Kandung</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->mother_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Tempat Lahir</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Tanggal Lahir</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Status Pernikahan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->marital_status }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Jumlah Tanggungan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->julah_tanggungan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Alamat</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Desa</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->desa }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Kecamatan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->kecamatan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Kabupaten/Kota</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->kabupatenkota }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Provinsi</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->provinsi }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Kode Pos</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->kodepos }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Status Kepemilikan Hunian</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->housing }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->los_year }} tahun {{ $data->los_month }} bulan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 33.3333%;">Nama Saudara</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->nama_saudara }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">No Handphone Saudara</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->no_hp_saudara }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Alamat Saudara</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->alamat_saudara }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Pekerjaan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Nama Perusahaan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Lama Bekerja</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->lama_bekerja_tahun }} tahun {{ $data->lama_bekerja_bulan }} bulan</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Alamat Kantor</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->alamat_kantor }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Nomor Telepon Kantor</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->tel_kantor }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Sumber Penghasilan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->sumber_penghasilan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Penghasilan Perbulan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->penghasilan_perbulan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Memiliki Kartu Kredit</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->creditcard }}</td>
                                    </tr>
                                    @if($data->creditcard == 'Tidak')
                                        <tr>
                                            <td style="width: 33.3333%;">Bank Penerbit</td>
                                            <td style="width: 3.50874%;">:</td>
                                            <td style="width: 33.3333%;"> - </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                            <td style="width: 3.50874%;">:</td>
                                            <td style="width: 33.3333%;"> - </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 33.3333%;">Limit</td>
                                            <td style="width: 3.50874%;">:</td>
                                            <td style="width: 33.3333%;"> - </td>
                                        </tr>
                                        @else
                                            @foreach($databank as $dat)
                                                <tr>
                                                    <td style="width: 33.3333%;">Bank Penerbit</td>
                                                    <td style="width: 3.50874%;">:</td>
                                                    <td style="width: 33.3333%;">{{ $dat->bank_penerbit }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                                    <td style="width: 3.50874%;">:</td>
                                                    <td style="width: 33.3333%;">{{ $dat->lama_kepemilikan_tahun }} tahun {{ $data->lama_kepemilikan_bulan }} bulan</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 33.3333%;">Limit</td>
                                                    <td style="width: 3.50874%;">:</td>
                                                    <td style="width: 33.3333%;">{{ $dat->limit }}</td>
                                                </tr>
                                            @endforeach
                                    @endif
                                    <tr>
                                        <td style="width: 33.3333%;">Reference Number</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->ref_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Produk Pinjaman</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->produk_pinjaman }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Jumlah Pinjaman</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->jumlah_pinjaman }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Jangka Waktu</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->jangka_waktu }} Bulan</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Tujuan Pinjaman</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;">{{ $data->tujuan_pinjaman }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 33.3333%;">Fotocopy KTP</td>
                                        <button type="button" id="btnhidektp" class="btn btn-sm btn-danger" onclick="hideKTP()" style="display: none; float:right;">Close KTP</button>
                                        <center><img width="400" style="display: none;" id="imgktp" src="{{ asset('/public/storage/'.$data->path_prim."/".$data->copyktp) }}" alt="{{ asset('public/storage/'.$data->path_prim."/".$data->copyktp) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_prim."/".$data->copyktp }}</td>
                                        <td><button type="button" id="btnktp" class="btn btn-sm btn-success" onclick="showKTP()">Show</button></td>
                                    </tr>
                                    <tr> 
                                        <td style="width: 33.3333%;">NPWP</td>
                                        <button type="button" id="btnhidenpwp" class="btn btn-sm btn-danger" onclick="hideNPWP()" style="display: none; float:right;">Close NPWP</button>
                                        <center><img width="400" style="display: none;" id="imgnpwp" src="{{ asset('public/storage/'.$data->path_prim."/".$data->npwp) }}" alt="{{ asset('public/storage/'.$data->path_prim."/".$data->npwp) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_prim."/".$data->npwp }}</td>
                                        <td><button type="button" id="btnnpwp" class="btn btn-sm btn-success" onclick="showNPWP()">Show</button></td>
                                    </tr>
                                    <tr> 
                                        <td style="width: 33.3333%;">Kartu Keluarga</td>
                                        <button type="button" id="btnhidekk" class="btn btn-sm btn-danger" onclick="hideKK()" style="display: none; float:right;">Close KK</button>
                                        <center><img width="400" style="display: none;" id="imgkk" src="{{ asset('public/storage/'.$data->path_prim."/".$data->kk) }}" alt="{{ asset('public/storage/'.$data->path_prim."/".$data->kk) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_prim."/".$data->kk }}</td>
                                        <td><button type="button" id="btnkk" class="btn btn-sm btn-success" onclick="showKK()">Show</button></td>
                                    </tr>
                                    @if($data->slip_gaji != '')
                                    <tr> 
                                        <td style="width: 33.3333%;">Slip Gaji</td>
                                        <button type="button" id="btnhideslip" class="btn btn-sm btn-danger" onclick="hideSlip()" style="display: none; float:right;">Close Slip Gaji</button>
                                        <center><img width="400" style="display: none;" id="imgslip" src="{{ asset('public/storage/'.$data->path_supp."/".$data->slip_gaji) }}" alt="{{ asset('public/storage/'.$data->path_supp."/".$data->slip_gaji) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_supp."/".$data->slip_gaji }}</td>
                                        <td><button type="button" id="btnslip" class="btn btn-sm btn-success" onclick="showSlip()">Show</button></td>
                                    </tr>
                                    @else
                                    <tr> 
                                        <td style="width: 33.3333%;">Slip Gaji</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">No Data</td>
                                    </tr>
                                    @endif
                                    @if($data->mutasirekening != '')
                                    <tr>
                                        <td style="width: 33.3333%;">Mutasi Rekening</td>
                                        <button type="button" id="btnhidemutasi" class="btn btn-sm btn-danger" onclick="hideMutasi()" style="display: none; float:right;">Close Mutasi Rekening</button>
                                        <center><img width="400" style="display: none;" id="imgmutasi" src="{{ asset('public/storage/'.$data->path_supp."/".$data->mutasirekening) }}" alt="{{ asset('public/storage/'.$data->path_supp."/".$data->mutasirekening) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_supp."/".$data->mutasirekening }}</td>
                                        <td><button type="button" id="btnmutasi" class="btn btn-sm btn-success" onclick="showMutasi()">Show</button></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 33.3333%;">Mutasi Rekening</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">No Data</td>
                                    </tr>
                                    @endif
                                    @if($data->sip != '')
                                    <tr>
                                        <td style="width: 33.3333%;">SIP</td>
                                        <button type="button" id="btnhidesip" class="btn btn-sm btn-danger" onclick="hideSip()" style="display: none; float:right;">Close SIP</button>
                                        <center><img width="400" style="display: none;" id="imgsip" src="{{ asset('public/storage/'.$data->path_supp."/".$data->sip) }}" alt="{{ asset('public/storage/'.$data->path_supp."/".$data->sip) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_supp."/".$data->sip }}</td>
                                        <td><button type="button" id="btnsip" class="btn btn-sm btn-success" onclick="showSip()">Show</button></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 33.3333%;">SIP</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">No Data</td>
                                    </tr>
                                    @endif
                                    @if($data->siup != '')
                                    <tr>
                                        <td style="width: 33.3333%;">SIUP</td>
                                        <button type="button" id="btnhidesiup" class="btn btn-sm btn-danger" onclick="hideSiup()" style="display: none; float:right;">Close SIUP</button>
                                        <center><img width="400" style="display: none;" id="imgsiup" src="{{ asset('public/storage/'.$data->path_supp."/".$data->siup) }}" alt="{{ asset('public/storage/'.$data->path_supp."/".$data->siup) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_supp."/".$data->siup }}</td>
                                        <td><button type="button" id="btnsiup" class="btn btn-sm btn-success" onclick="showSiup()">Show</button></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 33.3333%;">SIUP</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">No Data</td>
                                    </tr>
                                    @endif
                                    @if($data->billingcc != '')
                                    <tr>
                                        <td style="width: 33.3333%;">Billing Kartu Kredit</td>
                                        <button type="button" id="btnhidebilling" class="btn btn-sm btn-danger" onclick="hideBilling()" style="display: none; float:right;">Close Billing Kartu Kredit</button>
                                        <center><img width="400" style="display: none;" id="imgbilling" src="{{ asset('public/storage/'.$data->path_supp."/".$data->billingcc) }}" alt="{{ asset('public/storage/'.$data->path_supp."/".$data->billingcc) }}"></center>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">{{ $data->path_supp."/".$data->billingcc }}</td>
                                        <td><button type="button" id="btnbilling" class="btn btn-sm btn-success" onclick="showBilling()">Show</button></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 33.3333%;">Billing Kartu Kredit</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 3.50874%;">No Data</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <a href="{{ url('kta') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali ke Beranda </a>
                            {{-- <a href="{{ url('topdf') }}" class="btn btn-primary" style="float: right;">Print </a> --}}
                            <button onclick="return confirm('Data anda akan terkunci dan tidak bisa dilakukan perubahan lagi setelah anda melakukan pencetakan Dokumen. Yakin?')" type="submit" class="btn btn-sm btn-primary pd-x-30 mg-r-5 mg-t-5" style="float: right;">Print</button>
                            <a href="{{ url('selectrefno') }}" class="btn btn-sm btn-success" style="margin-left: 50px;">Pilih Nomor Referensi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function showKTP() {
        document.getElementById('imgktp')
                .style.display = "block";

        document.getElementById('btnktp')
                .style.display = "none";
        
        document.getElementById('btnhidektp')
                .style.display = "block";
    }

    function hideKTP() {
        document.getElementById('imgktp')
                .style.display = "none";

        document.getElementById('btnktp')
                .style.display = "block";
        
        document.getElementById('btnhidektp')
                .style.display = "none";
    }

    function showNPWP() {
        document.getElementById('imgnpwp')
                .style.display = "block";

        document.getElementById('btnnpwp')
                .style.display = "none";
        
        document.getElementById('btnhidenpwp')
                .style.display = "block";
    }

    function hideNPWP() {
        document.getElementById('imgnpwp')
                .style.display = "none";

        document.getElementById('btnnpwp')
                .style.display = "block";
        
        document.getElementById('btnhidenpwp')
                .style.display = "none";
    }

    function showKK() {
        document.getElementById('imgkk')
                .style.display = "block";

        document.getElementById('btnkk')
                .style.display = "none";
        
        document.getElementById('btnhidekk')
                .style.display = "block";
    }

    function hideKK() {
        document.getElementById('imgkk')
                .style.display = "none";

        document.getElementById('btnkk')
                .style.display = "block";
        
        document.getElementById('btnhidekk')
                .style.display = "none";
    }

    function showSlip() {
        document.getElementById('imgslip')
                .style.display = "block";

        document.getElementById('btnslip')
                .style.display = "none";
        
        document.getElementById('btnhideslip')
                .style.display = "block";
    }

    function hideSlip() {
        document.getElementById('imgslip')
                .style.display = "none";

        document.getElementById('btnslip')
                .style.display = "block";
        
        document.getElementById('btnhideslip')
                .style.display = "none";
    }

    function showMutasi() {
        document.getElementById('imgmutasi')
                .style.display = "block";

        document.getElementById('btnmutasi')
                .style.display = "none";
        
        document.getElementById('btnhidemutasi')
                .style.display = "block";
    }

    function hideMutasi() {
        document.getElementById('imgmutasi')
                .style.display = "none";

        document.getElementById('btnmutasi')
                .style.display = "block";
        
        document.getElementById('btnhidemutasi')
                .style.display = "none";
    }

    function showSip() {
        document.getElementById('imgsip')
                .style.display = "block";

        document.getElementById('btnsip')
                .style.display = "none";
        
        document.getElementById('btnhidesip')
                .style.display = "block";
    }

    function hideSip() {
        document.getElementById('imgsip')
                .style.display = "none";

        document.getElementById('btnsip')
                .style.display = "block";
        
        document.getElementById('btnhidesip')
                .style.display = "none";
    }

    function showSiup() {
        document.getElementById('imgsiup')
                .style.display = "block";

        document.getElementById('btnsiup')
                .style.display = "none";
        
        document.getElementById('btnhidesiup')
                .style.display = "block";
    }

    function hideSiup() {
        document.getElementById('imgsiup')
                .style.display = "none";

        document.getElementById('btnsiup')
                .style.display = "block";
        
        document.getElementById('btnhidesiup')
                .style.display = "none";
    }

    function showBilling() {
        document.getElementById('imgbilling')
                .style.display = "block";

        document.getElementById('btnbilling')
                .style.display = "none";
        
        document.getElementById('btnhidebilling')
                .style.display = "block";
    }

    function hideBilling() {
        document.getElementById('imgbilling')
                .style.display = "none";

        document.getElementById('btnbilling')
                .style.display = "block";
        
        document.getElementById('btnhidebilling')
                .style.display = "none";
    }
</script>
@endsection