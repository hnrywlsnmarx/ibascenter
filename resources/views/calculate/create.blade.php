@extends('layouts.appbalancing')

@section('styles') 
@endsection

@section('breadcrumb')

<div class="left-content">
    <h4 class="content-title mb-1">Calculate Winning Possibilities based on Sainte Lague Method</h4>
    <h6>(0.87% margin of errors)</h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Calculate Winning Possibilities</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
    </nav>
</div>

@endsection('breadcrumb')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('kta') }}"> Back</a>
        </div>
    </div>
</div>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<div class="row">
    <input type="hidden" name="ip_address" value="{{ session('ip_address') }}">
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mb-3">
                    <center>
                        <p>
                            Total Perolehan Suara Partai DAPIL 3 Kota Cirebon <br>
                            (Masukkan 6 Partai dengan suara terbesar)
                        </p>
                     </center>
                 </div>
                {{-- <p class="mg-b-20 text-muted">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="satu" id="satu" placeholder="Partai Peringkat 1"> &nbsp; <input class="form-control form-control-sm" type="number" id="first" placeholder="Suara Partai 1">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="dua" id="dua" placeholder="Partai Peringkat 2"> &nbsp; <input class="form-control form-control-sm" type="number" id="second" placeholder="Suara Partai 2">
                    </div>
                     <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="tiga" id="tiga" placeholder="Partai Peringkat 3"> &nbsp; <input class="form-control form-control-sm" type="number" id="third" placeholder="Suara Partai 3">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="empat" id="empat" placeholder="Partai Peringkat 4"> &nbsp; <input class="form-control form-control-sm" type="number" id="fourth" placeholder="Suara Partai 4">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="lima" id="lima" placeholder="Partai Peringkat 5"> &nbsp; <input class="form-control form-control-sm" type="number" id="fifth" placeholder="Suara Partai 5">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="enam" id="enam" placeholder="Partai Peringkat 6"> &nbsp; <input class="form-control form-control-sm" type="number" id="sixth" placeholder="Suara Partai 6">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-control form-control-sm" type="text" name="vt" id="vt" placeholder="Total Suara" value="TOTAL SUARA MASUK" readonly> &nbsp; <input class="form-control form-control-sm" type="number" id="sumvote" placeholder="Total Suara Masuk"> 
                    </div>
                    <div class="form-check form-check-inline mt-4">
                        <button class="btn btn-sm btn-secondary" id="btn1" onclick="onBtnClick()">Calculate Chair</button>
                    </div>
                    
                </div>                
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mb-3">
                   <center>Alokasi kursi Dapil 3 Kota Cirebon: 6 Kursi.</center>
                </div>
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div id="result">
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="firstchair" readonly>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="secondchair" readonly>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="thirdchair" readonly>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="fourthchair" readonly>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="fifthchair" readonly>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-control form-control-sm" type="text" id="sixthchair" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <div class="alert alert-warning">
                    <strong>Perhatian!</strong> <br> <br>
                    Contoh: <br>

                    Dapil 3 Kota Cirebon mempunyai 6 jatah kursi DPRD, sementara hasil kalkulasi adalah:

                    <li>Partai A mendapatkan 3 kursi</li>
                    <li>Partai B mendapatkan 2 kursi</li>
                    <li>Partai C mendapatkan 1 kursi</li>
                    <li>Partai D mendapatkan 1 kursi</li>
                    <li>Partai E mendapatkan 0 kursi</li>
                    <li>Partai F mendapatkan 0 kursi</li>
                    <br>
                    Kursi terakhir didapatkan oleh Partai C karena Koefisien Perolehan Suara lebih banyak dari Partai D. <br>
                    Partai D mendapatkan perhitungan = 1 karena Pembulatan angka dari Metode Sainte Lague;
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>

function onBtnClick(){

    let limit = 4;
    let kuota = 6;
    let divider = 1;
    let resultsatu = 0;
    let resultdua = 0;
    let resulttiga = 0;
    let resultempat = 0;
    let resultlima = 0;
    let resultenam = 0;

    const suaraPartaiSatu = parseInt(document.getElementById('first').value, 10);
    const suaraPartaiDua = parseInt(document.getElementById('second').value, 10);
    const suaraPartaiTiga = parseInt(document.getElementById('third').value, 10);
    const suaraPartaiEmpat = parseInt(document.getElementById('fourth').value, 10);
    const suaraPartaiLima = parseInt(document.getElementById('fifth').value, 10);
    const suaraPartaiEnam = parseInt(document.getElementById('sixth').value, 10);
    const sumvote = parseInt(document.getElementById('sumvote').value, 10);

    // const totalsuaramasuk = suaraPartaiSatu + suaraPartaiDua + suaraPartaiTiga + suaraPartaiEmpat + suaraPartaiLima + suaraPartaiEnam;
    const totalsuaramasuk = sumvote;

    const PartaiSatu = document.getElementById('satu').value;
    const PartaiDua = document.getElementById('dua').value;
    const PartaiTiga = document.getElementById('tiga').value;
    const PartaiEmpat = document.getElementById('empat').value;
    const PartaiLima = document.getElementById('lima').value;
    const PartaiEnam = document.getElementById('enam').value;        

    const firstchair = document.getElementById('firstchair');
    const secondchair = document.getElementById('secondchair');
    const thirdchair = document.getElementById('thirdchair');
    const fourthchair = document.getElementById('fourthchair');
    const fifthchair = document.getElementById('fifthchair');
    const sixthchair = document.getElementById('sixthchair');

    let firstseat;
    let secondseat;
    let thirdseat;
    let fourthseat;
    let fifthseat;
    let sixthseat;
    
    // console.log("suaraPartaiSatu "+suaraPartaiSatu);
    // console.log("totalsuaramasuk "+totalsuaramasuk);

    const highestfraction = 0.75;
    // firstseat=Math.ceil((kuota*suaraPartaiSatu)/totalsuaramasuk);
    rawfirstseat=(kuota*suaraPartaiSatu)/totalsuaramasuk;
    if(rawfirstseat > highestfraction){
        firstseat=Math.ceil((kuota*suaraPartaiSatu)/totalsuaramasuk);
        // console.log("firstseat "+rawfirstseat);
        firstchair.value = PartaiSatu + " mendapatkan " + firstseat + " kursi ";
    } else {
        if(rawfirstseat <= 1){
            firstseat=Math.round((kuota*suaraPartaiSatu)/totalsuaramasuk);
            // console.log("firstseat "+rawfirstseat);
            firstchair.value = PartaiSatu + " mendapatkan " + firstseat + " kursi ";
        }
    }
    
    rawsecondseat=(kuota*suaraPartaiDua)/totalsuaramasuk;
    if(rawsecondseat > highestfraction){
        secondseat=Math.ceil((kuota*suaraPartaiDua)/totalsuaramasuk);
        // console.log("secondseat "+rawsecondseat);
        secondchair.value = PartaiDua + " mendapatkan " + secondseat + " kursi ";
    } else {
        if(rawsecondseat <= 1){
            secondseat=Math.round((kuota*suaraPartaiDua)/totalsuaramasuk);
            // console.log("secondseat "+rawsecondseat);
            secondchair.value = PartaiDua + " mendapatkan " + secondseat + " kursi ";
        }
    }
    
    rawthirdseat=(kuota*suaraPartaiTiga)/totalsuaramasuk;
    if(rawthirdseat > highestfraction){
        thirdseat=Math.ceil((kuota*suaraPartaiTiga)/totalsuaramasuk);
        // console.log("thirdseat "+rawthirdseat);
        thirdchair.value = PartaiTiga + " mendapatkan " + thirdseat + " kursi ";
    } else {
        if(rawthirdseat <= 1){
            thirdseat=Math.round((kuota*suaraPartaiTiga)/totalsuaramasuk);
            // console.log("thirdseat "+rawthirdseat);
            thirdchair.value = PartaiTiga + " mendapatkan " + thirdseat + " kursi ";
        }
    }
    
    rawfourthseat=(kuota*suaraPartaiEmpat)/totalsuaramasuk;
    if(rawfourthseat > highestfraction){
        fourthseat=Math.ceil((kuota*suaraPartaiEmpat)/totalsuaramasuk);
        // console.log("fourthseat "+rawfourthseat);
        fourthchair.value = PartaiEmpat + " mendapatkan " + fourthseat + " kursi ";
    } else {
        if(rawfourthseat <= 1){
            fourthseat=Math.round((kuota*suaraPartaiEmpat)/totalsuaramasuk);
            // console.log("fourthseat "+rawfourthseat);
            fourthchair.value = PartaiEmpat + " mendapatkan " + fourthseat + " kursi ";
        }
    }
    
    rawfifthseat=(kuota*suaraPartaiLima)/totalsuaramasuk;
    if(rawfifthseat > highestfraction){
        fifthseat=Math.ceil((kuota*suaraPartaiLima)/totalsuaramasuk);
        // console.log("fifthseat "+rawfifthseat);
        fifthchair.value = PartaiLima + " mendapatkan " + fifthseat + " kursi ";
    } else {
        if(rawfifthseat <= 1){
            fifthseat=Math.round((kuota*suaraPartaiLima)/totalsuaramasuk);
            // console.log("fifthseat "+rawfifthseat);
            fifthchair.value = PartaiLima + " mendapatkan " + fifthseat + " kursi ";            
        }
    }
    
    rawsixthseat=(kuota*suaraPartaiEnam)/totalsuaramasuk;
    if(rawsixthseat > highestfraction){
        sixthseat=Math.ceil((kuota*suaraPartaiEnam)/totalsuaramasuk);
        // console.log("sixthseat "+rawsixthseat);
        sixthchair.value = PartaiEnam + " mendapatkan " + sixthseat + " kursi ";
    } else {
        if(rawsixthseat <= 1){
            sixthseat=Math.round((kuota*suaraPartaiEnam)/totalsuaramasuk);
            // console.log("sixthseat "+rawsixthseat);
            sixthchair.value = PartaiEnam + " mendapatkan " + sixthseat + " kursi ";
        }
    }
}

</script>
@endsection