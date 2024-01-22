@extends('layouts.app3')
@section('content')
<div class="container mt-3">
    {{-- <div style="float: right;"><h5 class="content-title mb-2">Kau Adalah, {{ session('name') }}</h5></div> --}}
    <h5>Simulasi Pinjaman</h5>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-0">
                                    <label class="form-label mg-b-0">Produk</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" style="width: 200;" name="livesearch-produk" id="livesearch-produk" onchange="resetField();">
                                        <option value="0" disabled="true" selected="true">- Pilih Produk Pinjaman -</option>
                                        @foreach($product_kta as $prod)
                                            <option value="{{ $prod->kode }}">{{ $prod->produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="pinjaman" id="pinjaman" class="form-control" placeholder="Pinjaman" onblur="formatRupiah()">
                                </div>
                                <input type="hidden" name="pinjamanasli" id="pinjamanasli" class="form-control" placeholder="Pinjaman">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-0">
                                    <label class="form-label mg-b-0">Jangka Waktu (Bulan)</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control livesearch-jangka" style="width: 170;" name="jangka" id="livesearch-jangka" onchange="onselectjangka();">
                                        <option value="0" disabled="true" selected="true">- Pilih Jangka Waktu -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Bunga (%)</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="bunga" id="bunga" class="form-control" placeholder="Bunga" style="width:100;" readonly>
                                </div>    
                                <div class="input-group-append">
                                    {{-- <button type="button" class="btn btn-warning" style="float: right;" onclick="resetField()">Clear</button> --}}
                                    <button type="button" class="btn btn-dark" style="float: right;" onclick="countAngsuran()">Hitung Angsuran</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Angsuran</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="angsuran" id="angsuran" class="form-control" placeholder="Angsuran" readonly>
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
                            <a href="{{ url('stepone') }}" class="btn btn-primary" style="float: right;">Ajukan Pinjaman</a>
                            {{-- <button type="button" class="btn btn-primary" style="float: right;">Ajukan Pinjaman</button> --}}
                        </div>
                        <div class="bg-gray-100">
                            <a href="{{ url('kta') }}" class="btn btn-warning" style="float: left;">Kembali ke Beranda</a>
                            {{-- <button type="button" class="btn btn-primary" style="float: left;">Kembali ke Beranda</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	       
        $('#livesearch-produk').change(function(){    
            var id=$(this).val();    
            var url = '/get-datajangka/' + id    
            if(id == 0){
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
                        } else {
                            html += '<option value='+data[i].jangka_waktu+'>'+data[i].jangka_waktu+'</option>';    
                        }
                    }             
                    $('#livesearch-jangka').html(html); 
                } 
            });   
        }
        return false; 
    });        
});
</script>
<script type="text/javascript">
    function onselectjangka(){
        var idProduk = document.getElementById("livesearch-produk");
        var valProduk = idProduk.options[idProduk.selectedIndex].value;
        var idJangka = document.getElementById("livesearch-jangka");
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
}
</script>
<script type="text/javascript">
    function resetField(){
        var idProduk = document.getElementById("livesearch-produk");
        var idJangka = document.getElementById("livesearch-jangka");
        $('[name="pinjaman"]').val(0);
        $('[name="bunga"]').val(0);
        $('[name="angsuran"]').val(0);
        // idProduk.options[idProduk.selectedIndex].value = 0;
    }
</script>

<script>
    function formatRupiah(){
        const val = document.getElementById('pinjaman').value;
        const asli = document.getElementById('pinjamanasli').value = val;
        const formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(val);
        var form = formatter;
        // console.log(form)
        $('[name="pinjaman"]').val(form);
}
</script>
<script type="text/javascript">
    function countAngsuran(){

        
        
        var bunga = document.getElementById("bunga").value;
        var perbunga = bunga/100;
        var bungaRate = perbunga/12;
        var idJangka = document.getElementById("livesearch-jangka");
        var valJangka = idJangka.options[idJangka.selectedIndex].value;
        var jml_pinjaman = document.getElementById("pinjamanasli").value;
        var futureValue = 0;

        var pmt = ((jml_pinjaman - futureValue) * bungaRate / (1 - Math.pow((1+bungaRate), -valJangka)));
        // var angsuranFixed = 1000000;
        var toLocalePMT = pmt.toLocaleString("id-ID", {style:"currency", currency:"IDR"});
        // console.log(toLocalePMT)
        $('[name="angsuran"]').val(toLocalePMT);
    }
</script>

