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
    <h6><b>Edit Data Kartu Kredit</b></h6>
    <form action="{{ route('stepfour.update',$stepfour->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                            
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" class="form-control" required placeholder="id" value="{{ $stepfour->id }}" readonly>  
                                </div>
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $stepfour->nik }}" readonly>  
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $stepfour->tokenreg }}">  
                                </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Bank Penerbit</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 180;" name="bank_penerbit" id="bank_penerbit">
                                        @foreach($master_bank as $prod)
                                            @if($bank_penerbit == $prod->kode_bank)
                                                <option value="{{ $prod->kode_bank }}" selected="true">{{ $prod->nama_bank }}</option>
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
                                    <input type="text" name="lama_kepemilikan_tahun" id="lama_kepemilikan_tahun" class="form-control" required value="{{ $stepfour->lama_kepemilikan_tahun }}" placeholder="Tahun">
                                </div>
                                tahun
                                <div class="col-md-4">
                                    <input type="text" name="lama_kepemilikan_bulan" id="lama_kepemilikan_bulan" class="form-control" required value="{{ $stepfour->lama_kepemilikan_bulan }}" placeholder="Bulan">
                                </div>
                                bulan
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Limit</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="limit" id="limit" class="form-control" required value="{{ $stepfour->limit_number }}" placeholder="Limit" autofocus onblur="formatRupiah()" onkeyup="formatnumber(this)" onfocus="formatnumber(this)">  
                                </div>
                                <input type="hidden" name="limit_number" id="limit_number" class="form-control" required  placeholder="Penghasilan Perbulan Number" value="{{ $stepfour->limit_number }}">
                                <div id="cc" class="mt-2">
                                   <button type="submit" style="text-align: right; float: right;"  id="btnfirst" class="btn btn-sm btn-success">Edit Kartu Kredit</button>
                                </div>                       
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-sm btn-primary" href="{{ route('stepfour.index') }}"> Back</a>
                            </div>
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