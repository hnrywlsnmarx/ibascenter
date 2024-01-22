@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
@if($checkLock != 0)
    <div class="container mt-3">
        {{-- <h4 class="content-title mb-2">Selamat Datang, {{ Auth::user()->name }}</h4> --}}
        <h6>Keluarga yang Tidak Serumah</h6>
        @foreach($errors->all() as $error)
            <div>
                <font color='red' style="font-weight: bold;">{{$error}}</font>
            </div>
        @endforeach
        @if($ctStepTwo == 0)
            <form action="{{ route('steptwo.store') }}" method="POST">
        @else
            @foreach($steptwo as $st)
                <form action="{{ route('steptwo.update', $st->nik) }}" method="POST">
                    @method('PUT')
            @endforeach
        @endif
            @csrf  
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-gray-100">
                                <div class="col-md-12">
                                    <input type="hidden" name="nik" id="nik" class="form-control" required placeholder="NIK" value="{{ $nik }}" readonly>  
                                    <input type="hidden" name="tokenreg" id="tokenreg" class="form-control" required placeholder="NIK" readonly value="{{ $tokenreg }}">  
                                </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Nama Sesuai KTP</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="nama_saudara" id="nama_saudara" class="form-control" required placeholder="Nama Sesuai KTP" value="{{ $nama_saudara }}">  
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alamat" class="form-label mg-b-0">Alamat</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" required id="alamat_saudara" name="alamat_saudara">{{ $alamat_saudara }}</textarea>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Hubungan</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control"  style="width: 200;" name="hubungan" id="hubungan" required>
                                        <option value="" selected disabled>- Pilih Hubungan -</option>
                                        @foreach($master_keluarga as $prod)
                                            @if($hubungan == $prod->kode )
                                                <option value="{{ $prod->kode }}" selected="true">{{ $prod->nama }}</option>
                                            @else
                                                <option value="{{ $prod->kode }}">{{ $prod->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">No Telepon/Handphone</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="number" name="no_hp_saudara" id="no_hp_saudara" class="form-control" required value="{{ $no_hp_saudara }}" placeholder="No Telepon/Handphone">  
                                </div>
                            </div>
                            <a href="{{ url('stepone') }}" class="btn btn-sm btn-warning" style="float: left;">Kembali ke Step 1</a>
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
@endsection

