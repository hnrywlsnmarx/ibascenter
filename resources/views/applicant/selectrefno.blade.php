@extends('layouts.app3')

<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@section('content')
<div class="container mt-3">
    <form action="{{ route('getrefno') }}" method="post">
        @csrf
        <div class="row mx-auto">
            <div class="col-lg-12 col-md-12">
                <div class="card" style="width: 40%; margin: auto;" >
                    <div class="card-body">
                        <div class="bg-gray-100">
                            <div class="row mb-3 mx-auto">
                                <div class="col-md-12">
                                    <label class="radio-inline form-label mg-b-0">Pilih No Referensi Pinjaman</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" required style="width: 200;" name="ref_pinjaman" id="ref_pinjaman" onchange="getNoRef()">
                                        <option value="">- No Referensi Pinjaman -</option>
                                        @foreach($ref_no as $r)
                                        <option value="{{ $r->ref_no }}">{{ $r->ref_no }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="noreftext" id="noreftext" class="form-control" placeholder="Reference Number"> 
                                </div>
                            </div> 
                            <div class="col-md-12 mx-auto">
                                <a class="btn btn-sm btn-warning" href="{{ url('stepupload') }}">Back</a>
                                <button type="submit" class="btn btn-sm btn-success pd-x-30 mg-r-5 mg-t-5" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function getNoRef(){
        var id = document.getElementById('ref_pinjaman').value;
        
        $('[name="noreftext"]').val(id);
    }
</script>
@endsection
