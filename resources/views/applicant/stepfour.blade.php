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
    <div class="container mt-3">
        {{-- <h4 class="content-title mb-2">Selamat Datang, {{ Auth::user()->name }}</h4> --}}
        <h6>Data Tambahan</h6>
    @foreach($errors->all() as $error)
        <div>
            <font color='red' style="font-weight: bold;">{{$error}}</font>
        </div>
    @endforeach
        <form action="{{ route('stepfour.store') }}" method="POST">
        @csrf 
            <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" class="form-control" required placeholder="id" value="{{ $id }}" readonly>  
                                </div>
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $tokenreg }}">  
                                </div>
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Memiliki Kartu Kredit?</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 120;" name="creditcard" id="creditcard">
                                        <option value="" selected="true">- Pilih Opsi -</option>
                                        @if($creditcard == "Tidak")
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        @elseif($creditcard == "Ya")
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        @else
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="divlbl">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Bank Penerbit</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 180;" name="bank_penerbit" id="bank_penerbit">
                                        <option value="" selected="true">- Pilih Bank Penerbit -</option>
                                        @foreach($master_bank as $prod)
                                            @if($bank_penerbit == $prod->kode_bank)
                                                <option value="{{ $prod->kode_bank }}">{{ $prod->nama_bank }}</option>
                                            @else
                                                <option value="{{ $prod->kode_bank }}">{{ $prod->nama_bank }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Lama Kepemilikan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="lama_kepemilikan_tahun" id="lama_kepemilikan_tahun" class="form-control" required  placeholder="Tahun">
                                </div>
                                tahun
                                <div class="col-md-4">
                                    <input type="text" name="lama_kepemilikan_bulan" id="lama_kepemilikan_bulan" class="form-control" required placeholder="Bulan">
                                </div>
                                bulan
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Limit</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="limit" id="limit" class="form-control" required placeholder="Limit" onblur="formatRupiah()" onkeyup="formatnumber(this)" onfocus="formatnumber(this)">  
                                </div>
                                <input type="hidden" name="limit_number" id="limit_number" class="form-control" required  placeholder="Penghasilan Perbulan Number">
                                @if($creditcard == 'Tidak')
                                    <div id="cc" class="mt-2" style="display: none;">
                                        <button type="submit" style="text-align: right; float: right;"  id="btnfirst" class="btn btn-sm btn-success">Tambah Kartu Kredit</button>
                                    </div>
                                    <div id="nocc" class="mt-2" style="display: block;" >
                                        <button type="submit" class="btn btn-sm btn-info pd-x-30 mg-r-5 mg-t-5" style="float: right;" id="btnnextfirst">No Credit Card</button>
                                    </div>
                                @else
                                    <div id="cc" class="mt-2" style="display: block;">
                                        <button type="submit" style="text-align: right; float: right;"  id="btnfirst" class="btn btn-sm btn-success">Tambah Kartu Kredit</button>
                                    </div>
                                    <div id="nocc" class="mt-2" style="display: none;" >
                                        <button type="submit" class="btn btn-info btn-sm pd-x-30 mg-r-5 mg-t-5" style="float: right;" id="btnnextfirst">No Credit Card</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            {{-- form 1 to 3 --}}
            <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">

                            <u class="mb-2">Data kartu kredit</u>
                            <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                                <tr style="font-size: smaller">
                                    <th>Bank Penerbit</th>
                                    <th>Lama Kepemilikan</th>
                                    <th>Limit</th>
                                    <th>Action</th>
                                </tr>
                                @if($ctStepFour != 0)
                                    @foreach ($stepfour as $st)
                                        @if($st->creditcard == "Ya")
                                            <tr style="font-size: smaller">
                                                <td>{{ $st->bank_penerbit }}</td>
                                                <td>{{ $st->lama_kepemilikan_tahun }} tahun {{ $st->lama_kepemilikan_bulan }} bulan</td>
                                                <td>{{ $st->limit }}</td>
                                                {{-- @if($st->limit_number != 0) --}}
                                                    <td><a class="btn btn-sm btn-primary" href="{{ route('stepfour.edit', $st->id) }}">Edit</a></td>
                                                {{-- @else --}}
                                                    {{-- <td>No Action</td> --}}
                                                {{-- @endif --}}
                                            </tr>
                                        @else   
                                            <tr style="font-size: smaller">
                                                <td>Tidak Memiliki Kartu Kredit</td>
                                                <td></td>
                                                <td></td>                                            
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr style="font-size: smaller">
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
        </div>      
    </form>
        @if($ctStepFour == 0)
            <div id="bck" style="display: none;">
                <a href="{{ url('stepthree') }}" class="btn btn-sm btn-warning" style="float: left;" id="btnbackfirst">Kembali ke Step 3</a>
                <a href="{{ url('stepfive') }}" class="btn btn-sm btn-primary" style="float: right;" id="btnbackfirst">Lanjutkan ke Step 5</a>
            </div>
        @else
            <div id="bck" class="col-lg-12 col-md-12">
                <a href="{{ url('stepthree') }}" class="btn btn-sm btn-warning" style="float: left;" id="btnbackfirst">Kembali ke Step 3</a>
                <a href="{{ url('stepfive') }}" class="btn btn-sm btn-primary" style="float: right;" id="btnbackfirst">Selanjutnya</a>
            </div>
        @endif
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
    $(document).ready(function(){
        $("#creditcard").change(function(){
            if($(this).val() == "Ya"){
                $("#divlbl").show();
                document.getElementById('lama_kepemilikan_tahun').readOnly = false;
                document.getElementById('lama_kepemilikan_bulan').readOnly = false;
                document.getElementById("limit").readOnly = false;
                document.getElementById('cc').style.display = "block";
                document.getElementById('btnfirst').style.display = "block";
                document.getElementById('nocc').style.display = "none";
                //  document.getElementById('otherformone').style.display = "block";
                //  document.getElementById('otherformtwo').style.display = "block";
                //  document.getElementById('otherformthree').style.display = "block";
                //  document.getElementById('otherformfour').style.display = "block";
            } else if($(this).val() == "Tidak"){
                //  $("#bank_penerbit").value = 0;
                document.getElementById("bank_penerbit").value = 0;
                $("#divlbl").hide();
                document.getElementById('lama_kepemilikan_tahun').readOnly = true;
                document.getElementById('lama_kepemilikan_bulan').readOnly = true;
                document.getElementById("limit").readOnly = true;
                document.getElementById('cc').style.display = "none";
                document.getElementById('nocc').style.display = "block";
                //  document.getElementById('otherformone').style.display = "none";
                //  document.getElementById('otherformtwo').style.display = "none";
                //  document.getElementById('otherformthree').style.display = "none";
                //  document.getElementById('otherformfour').style.display = "none";
                //  document.getElementById("bank_penerbit").val() == 0;

                $('[name="lama_kepemilikan_tahun"]').val(0);
                $('[name="lama_kepemilikan_bulan"]').val(0);
                $('[name="limit"]').val(0);
                $('[name="limit_number"]').val(0);
                document.getElementById("limit").value =0;
            }
            
        });
    });
</script>
{{-- <script>
    function showOtherFormOne(){
        document.getElementById('otherformone').style.display = "block";
        document.getElementById('btnfirst').style.display = 'none';
        document.getElementById('btnbackfirst').style.display = 'none';
        document.getElementById('btnnextfirst').style.display = 'none';
    }
</script>

<script>
    function showOtherFormTwo(){
        document.getElementById('otherformtwo').style.display = "block";
        document.getElementById('btnsecond').style.display = 'none';
        document.getElementById('btnbacksecond').style.display = 'none';
        document.getElementById('btnnextsecond').style.display = 'none';
    }
</script> --}}

<script>
    function formatRupiah(){
        const val = document.getElementById('limit').value;
        const asli = document.getElementById('limit_number').value = val;
        const formatter = new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(val);
        var form = formatter;
        // console.log(form)
        $('[name="limit"]').val(form);
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
@endsection

