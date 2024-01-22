@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
<div class="container mt-3">
    @if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif
@foreach($errors->all() as $error)
    <div>
        <font color='red' style="font-weight: bold;">{{$error}}</font>
    </div>
@endforeach
<div class="container mt-3">
    <h6><b>Edit Data Permohonan Pinjaman</b></h6>
    <form action="{{ route('stepfive.update',$stepfive->id) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="bg-gray-100">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $stepfive->nik }}" readonly>  
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="tokenreg" readonly value="{{ $stepfive->tokenreg }}">  
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="tgl_input" id="tgl_input" class="form-control" required placeholder="tgl_input" readonly value="{{ $stepfive->tgl_input }}">  
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Reference Number</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="ref_no" id="ref_no" class="form-control" required placeholder="Reference Number" readonly value="{{ $stepfive->ref_no }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="radio-inline form-label mg-b-0">Produk Pinjaman</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" required style="width: 200;" name="produk_pinjaman" id="produk_pinjaman" disabled>
                                    <option value="" selected="true">- Pilih Produk Pinjaman -</option>
                                    @foreach($product_kta as $prod)
                                        @if($produk_pinjaman == $prod->kode)
                                            <option value="{{ $prod->kode }}" selected="true">{{ $prod->produk }}</option>
                                        @else
                                            <option value="{{ $prod->kode }}">{{ $prod->produk }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="jns" id="jns" class="form-control" required placeholder="Reference Number" readonly value="{{ $stepfive->produk_pinjaman }}"> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Jumlah Pinjaman</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" required value="{{ $stepfive->jumlah_pinjaman_number }}" placeholder="Jumlah Pinjaman" onblur="formatRupiah()" onkeyup="formatnumber(this)" onfocus="formatduit(this)" autofocus>
                            </div>
                            <input type="hidden" name="jumlah_pinjaman_number" id="jumlah_pinjaman_number" class="form-control" required value="{{ $stepfive->jumlah_pinjaman_number }}"  placeholder="Pinjaman">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="radio-inline form-label mg-b-0">Lama Pinjaman</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" required style="width: 180;" name="jangka_waktu" id="jangka_waktu" onchange="onselectjangka()">
                                    {{-- <option value="0" disabled="true" selected="true">- Pilih Jangka Waktu -</option> --}}
                                    @foreach($master_bunga as $prod)
                                        @if($jangka_waktu == $prod->jangka_waktu)
                                            <option value="{{ $prod->jangka_waktu }}" selected="true">{{ $prod->jangka_waktu }}</option>
                                        @else
                                            <option value="{{ $prod->jangka_waktu }}">{{ $prod->jangka_waktu }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Bunga (%)</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="bunga" id="bunga" class="form-control" required placeholder="Bunga" style="width:100;" readonly onblur="countAngsuran()">
                            </div>    
                            {{-- <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-dark" style="float: right;" onclick="countAngsuran()">Hitung Angsuran</button>
                            </div> --}}
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="angsuran_perbulan" id="angsuran_perbulan" class="form-control" required placeholder="Angsuran" readonly>
                            <input type="hidden" name="angsuran_perbulan_number" id="angsuran_perbulan_number" class="form-control" required placeholder="Angsuran" readonly>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="radio-inline form-label mg-b-0">Tujuan Pinjaman</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" required style="width: 220;" name="tujuan_pinjaman" id="tujuan_pinjaman">
                                    <option value=""selected="true">- Pilih Tujuan Pinjaman -</option>
                                    @if($stepfive->tujuan_pinjaman == "Travelling")
                                    <option value="Travelling" selected="true">Travelling</option>
                                    <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                    <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                    @elseif($stepfive->tujuan_pinjaman == "Pembelian Barang Konsumtif")
                                    <option value="Travelling">Travelling</option>
                                    <option value="Pembelian Barang Konsumtif" selected="true">Pembelian Barang Konsumtif</option>
                                    <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                    @elseif($stepfive->tujuan_pinjaman == "Kegiatan Konsumtif Lainnya")
                                    <option value="Travelling">Travelling</option>
                                    <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                    <option value="Kegiatan Konsumtif Lainnya" selected="true">Kegiatan Konsumtif Lainnya</option>
                                    @else
                                    <option value="Travelling">Travelling</option>
                                    <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                    <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('stepfive.index') }}"> Back</a>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success pd-x-30 mg-r-5 mg-t-5" style="float: right;">Submit</button>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    </form>
</div>
{{-- @endforeach --}}

<script>
    function formatRupiah(){
        const val = document.getElementById('jumlah_pinjaman').value;
        const asli = document.getElementById('jumlah_pinjaman_number').value = val;
        const formatter = new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(val);
        var form = formatter;
        // console.log(form)
        $('[name="jumlah_pinjaman"]').val(form);
        if(val > 50000000){
            alert('Limit Pinjaman Maksimal Rp 50.000.000,00');
            $('[name="jumlah_pinjaman"]').val(0);
            document.getElementById('jumlah_pinjaman').focus();
        }
    }
</script>

<script type="text/javascript">
    function onselectjangka(){
        var idProduk = document.getElementById("produk_pinjaman");
        var valProduk = idProduk.options[idProduk.selectedIndex].value;
        var idJangka = document.getElementById("jangka_waktu");
        var valJangka = idJangka.options[idJangka.selectedIndex].value;
        var url = '/get-databunga/'+ valProduk +'/'+ valJangka;
        // alert(valJangka);

        if(valJangka == 0){
            $('[name="bunga"]').val(0);
        } else {
            $.ajax({
            url : url,   
            method : "get",   
            dataType : 'JSON',
            success: function(data){
                return {
                    results: $.map(data, function (item) {
                        // console.log(item.bunga);
                        $('[name="bunga"]').val(item.bunga);
                    })
                };
            },
              error: function(jqXHR, textStatus, errorThrown){
                alert("Gagal memperoleh data"+ errorThrown);  
            }
        });
    }

    document.getElementById("bunga").focus();
}
</script>

<script type="text/javascript">
    function countAngsuran(){
        var bunga = document.getElementById("bunga").value;
        var perbunga = bunga/100;
        var bungaRate = perbunga/12;
        var idJangka = document.getElementById("jangka_waktu");
        var valJangka = idJangka.options[idJangka.selectedIndex].value;
        var jml_pinjaman = document.getElementById("jumlah_pinjaman_number").value;
        var futureValue = 0;

        if(valJangka == '- Pilih Jangka Waktu -'){
            alert('- Pilih Jangka Waktu -');
        } else {
            var pmt = ((jml_pinjaman - futureValue) * bungaRate / (1 - Math.pow((1+bungaRate), -valJangka)));
        // var angsuranFixed = 1000000;
            var toLocalePMT = pmt.toLocaleString("id-ID", {style:"decimal"});
            // new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(val);
            // console.log(toLocalePMT)
            $('[name="angsuran_perbulan"]').val(toLocalePMT);
            $('[name="angsuran_perbulan_number"]').val(pmt);
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
    function formatduit(objek) {
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
@endsection