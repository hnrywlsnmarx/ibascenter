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
        <h6>Permohonan Pinjaman</h6>
        @foreach($errors->all() as $error)
            <div>
                <font color='red' style="font-weight: bold;">{{$error}}</font>
            </div>
        @endforeach
        <form action="{{ route('stepfive.store') }}" method="POST">
        @csrf
        <div class="row">
            @if($ctStepFive == 0)
                <div class="col-lg-4 col-md-4">
            @else 
                @if($appr == 0)
                    <div class="col-lg-4 col-md-4" style="display: none;">
                @else
                    <div class="col-lg-4 col-md-4">
                @endif
            @endif
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="tokenreg" readonly value="{{ $tokenreg }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tgl_input" id="tgl_input" class="form-control" required placeholder="tgl_input" readonly value="{{ $tgl_input }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="ref_no" id="ref_no" class="form-control" required placeholder="Reference Number" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="ctst" id="ctst" class="form-control" required placeholder="ctst" readonly value="{{ $ctst }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="ctstret" id="ctstret" class="form-control" required placeholder="ctst" readonly value="{{ $ctstret }}">  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="kabupatenkota" id="kabupatenkota" class="form-control" required placeholder="kabupatenkota" readonly value="{{ $kabupatenkota }}">  
                                </div>
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Produk Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 200;" name="produk_pinjaman" id="produk_pinjaman" onblur="createRefNo()">
                                        <option value="" selected="true">- Pilih Produk Pinjaman -</option>
                                        {{-- @foreach($product_kta as $prod)
                                            @if($produk_pinjaman == $prod->kode)
                                                <option value="{{ $prod->kode }}">{{ $prod->produk }}</option>
                                            @else
                                                <option value="{{ $prod->kode }}">{{ $prod->produk }}</option>
                                            @endif
                                        @endforeach --}}
                                        @if($pekerjaan != 'Pengusaha')
                                            <option value="KTA Payroll">KTA Payroll</option>                                        
                                        @else
                                            <option value="KTA Retail">KTA Retail</option>   
                                        @endif
                                    </select>
                                    <input type="hidden" name="jns" id="jns" class="form-control" required placeholder="Reference Number" readonly value="{{ $produk_pinjaman }}"> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Memiliki Rekening BWS</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 110;" name="produk_pinjaman" id="produk_pinjaman" onblur="createRefNo()">
                                        <option value="" selected="true">- Pilih Opsi -</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jumlah Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" required placeholder="Jumlah Pinjaman" onblur="formatRupiah()" onkeyup="formatnumber(this)" onfocus="formatnumber(this)">
                                </div>
                                <input type="hidden" name="jumlah_pinjaman_number" id="jumlah_pinjaman_number" class="form-control" required value="{{ $jumlah_pinjaman_number }}"  placeholder="Pinjaman">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Lama Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" style="width: 180;" name="jangka_waktu" id="jangka_waktu" onchange="onselectjangka()">
                                        <option value="" selected="true">- Pilih Jangka Waktu -</option>
                                        {{-- @foreach($master_bunga as $prod)
                                            @if($jangka_waktu == $prod->jangka_waktu)
                                                <option value="{{ $prod->jangka_waktu }}" selected="true">{{ $prod->jangka_waktu }}</option>
                                            @else
                                                <option value="{{ $prod->jangka_waktu }}">{{ $prod->jangka_waktu }}</option>
                                            @endif
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Bunga (%)</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="bunga" id="bunga" class="form-control" placeholder="Bunga" style="width:100;" readonly onblur="countAngsuran()">
                                </div>    
                                {{-- <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-dark" style="float: right;" onclick="countAngsuran()">Hitung Angsuran</button>
                                </div> --}}
                            </div>
                        
                            <div class="col-md-12">
                                <input type="hidden" name="angsuran_perbulan" id="angsuran_perbulan" class="form-control" required placeholder="Angsuran" readonly>
                                <input type="hidden" name="angsuran_perbulan_number" id="angsuran_perbulan_number" class="form-control" required placeholder="Angsuran perbulan number" readonly>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Tujuan Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 220;" name="tujuan_pinjaman" id="tujuan_pinjaman" onchange="onpilihtujuan()">
                                        <option value=""selected="true">- Pilih Tujuan Pinjaman -</option>
                                        @if($tujuan_pinjaman == "Travelling")
                                        <option value="Travelling" >Travelling</option>
                                        <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                        <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                        @elseif($tujuan_pinjaman == "Pembelian Barang Konsumtif")
                                        <option value="Travelling">Travelling</option>
                                        <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                        <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                        @elseif($tujuan_pinjaman == "Kegiatan Konsumtif Lainnya")
                                        <option value="Travelling">Travelling</option>
                                        <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                        <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                        @else
                                        <option value="Travelling">Travelling</option>
                                        <option value="Pembelian Barang Konsumtif">Pembelian Barang Konsumtif</option>
                                        <option value="Kegiatan Konsumtif Lainnya">Kegiatan Konsumtif Lainnya</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="flag_approval" id="flag_approval" class="form-control" required placeholder="Bunga" value="0" style="width:100;" readonly>
                            <input type="hidden" name="flag_disbursement" id="flag_disbursement" class="form-control" required placeholder="Bunga" value="0" style="width:100;" readonly>
                            {{-- <a href="{{ url('stepfour') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali</a> --}}
                            <button type="submit" class="btn btn-success btn-sm pd-x-30 mg-r-5 mg-t-5" style="float: right;">Submit</button>
                        </div>
                    </div>
                </div>  
            </div>
            @if($ctStepFive == 0)
                <div class="col-lg-8 col-md-8">
            @else
                @if($appr == 0)
                    <div class="col-lg-12 col-md-12">
                @else
                    <div class="col-lg-8 col-md-8">
                @endif
            @endif
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <u class="mb-2">Data Pinjaman</u>
                            <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                                <tr style="font-size: smaller">
                                    <th>Reference No</th>
                                    <th>Produk Pinjaman</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Jangka Waktu</th>
                                    <th>Tujuan Pinjaman</th>
                                    <th>Action</th>
                                </tr>
                                @if($ctStepFive != 0)
                                    @foreach ($stepfive as $st)
                                    <tr style="font-size: smaller">
                                        <td>{{ $st->ref_no }}</td>
                                        <td>{{ $st->produk_pinjaman }}</td>
                                        <td>{{ $st->jumlah_pinjaman }}</td>
                                        <td>{{ $st->jangka_waktu }}</td>
                                        <td>{{ $st->tujuan_pinjaman }}</td>
                                        @if($apprref_no->contains($st->ref_no))
                                            <td><button type="button" class="btn btn-sm btn-danger" disabled>LOCK</button></td>
                                        @else
                                            @if($ctDBR == 0)
                                                <td><a class="btn btn-sm btn-primary" href="{{ route('stepfive.edit', $st->id) }}">Edit</a></td>
                                            @else
                                            <td><button type="button" class="btn btn-sm btn-danger" disabled>LOCK</button></td>
                                            @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                @else
                                    <tr style="font-size: smaller">
                                        <td>No Data</td>
                                        <td>No Data</td>
                                        <td>No Data</td>
                                        <td>No Data</td>
                                        <td>No Data</td>
                                        <td>No Data</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <div id="bck" class="mt-3">
        <a href="{{ url('stepfour') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali ke Step 4</a>
        <a href="{{ url('stepupload') }}" class="btn btn-sm btn-primary" style="float: right;" id="btnbackfirst">Upload Dokumen</a>
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
@endif
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){	       
        $('#produk_pinjaman').change(function(){
            var id=$(this).val();
            var url = '/get-datajangka/' + id
            var html = '';   
                if(id == 0){
                    html += '<option value="- Pilih Jangka Waktu -">- Pilih Jangka Waktu -</option>';
                    $('#jangka_waktu').html(html);
                    
                    $('[name="jumlah_pinjaman"]').val(0);
                    $('[name="tujuan_pinjaman"]').val("");
                    $('[name="bunga"]').val(0);
                } else {
                    $.ajax({
                    url : url,
                    method : "get",
                    data : {produk_kta: id},
                    async : true,    
                    dataType : 'json',    
                    success: function(data){    
                        var html = '';    
                        var i;
                        for(i=0; i<data.length; i++){
                            if(data[i].jangka_waktu.length > 2){
                                html += '<option value="- Pilih Jangka Waktu -">'+data[i].jangka_waktu+'</option>';    
                                $('[name="bunga"]').val(0);
                            } else {
                                html += '<option value='+data[i].jangka_waktu+'>'+data[i].jangka_waktu+'</option>';           
                            }
                        }   
                        $('#jangka_waktu').html(html);
                    }
                });   
                return false;
            } 
        });        
    });
</script>
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
<script>
    function createRefNo(){
        var id = document.getElementById('produk_pinjaman').value;
        var tgl_input = document.getElementById('tgl_input').value;
        var ctst = document.getElementById('ctst').value;
        var ctstret = document.getElementById('ctstret').value;
        var op = 'ID';
        var today = new Date();
        var tahun = today.getFullYear();
        var mm = today.getMonth() + 1;
        var dd = today.getDate();
        var seq = 0;
        var i = 0;
        var intctst = parseInt(ctst);
        var intctstret = parseInt(ctstret);

        if(dd < 10) dd = '0' + dd;
        if(mm < 10) mm = '0' + mm;
        var formatted = tahun+''+mm+''+dd;
        var formattedseq = dd+''+mm+''+tahun;

        // console.log(formatted);

        $('[name="tgl_input"]').val(formatted);

        if(ctst == 0 && ctstret == 0){
            seq = "0000"+1;
            if(id == 'KTA Retail'){
                $('[name="ref_no"]').val(op+""+formattedseq+"KTART"+seq);
            } else {
                $('[name="ref_no"]').val(op+""+formattedseq+"KTAPY"+seq);
            }
        } else {
            if(id == "KTA Retail"){
                var i = intctstret+1;
                seq = "0000"+i; 
                $('[name="ref_no"]').val(op+""+formattedseq+"KTART"+seq);
            } else if(id == "KTA Payroll"){
                var i = intctst+1;
                seq = "0000"+i;
                $('[name="ref_no"]').val(op+""+formattedseq+"KTAPY"+seq);
            }
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

        if(valJangka == '- Pilih Jangka Waktu -'){
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

        // alert(valJangka);

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
    function onpilihtujuan(){
        var id=document.getElementById("tujuan_pinjaman").value;
        var idJangka = document.getElementById("jangka_waktu").value;
        if(idJangka == '- Pilih Jangka Waktu -'){
            alert('Pilih Jangka Waktu Pinjaman');
        }
        // alert(idJangka);
    }
</script>
@endsection

