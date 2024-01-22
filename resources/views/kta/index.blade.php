@extends('layouts.app4')
@section('styles')

		<!--  Owl-carousel css-->
		<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />

		<!-- Maps css -->
		<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">

		<!-- Jvectormap css -->
        <link href="{{URL::asset('assets/plugins/jqvmap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
		<script src="{{URL::asset('assets/js/jquery-1.9.1.js')}}"></script>
		<script src="{{URL::asset('assets/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{URL::asset('assets/js/moment.js')}}"></script>

@endsection
<style>
    .table-wrapper {
        max-height: 400px;
        overflow: auto;
        /* display:inline-block; */
      }
</style>
@section('breadcrumb')
<div class="left-content">
	<h4 class="content-title mb-2">Hi, Welcome Back! {{ Auth::user()->name }}</h4>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
		</ol>
	</nav>
</div>

@endsection('breadcrumb')
@section('content')
    <div class="row row-sm" >				
        <div class="col-lg-12">				
            <div class="row row-sm">				
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-2">Jumlah Pemilih Kelurahan Argasunya:</h4>
                                <div class="card-options ml-auto">
                                </div>
                            </div>
                            <div class="d-flex mb-0">
                                <div class="">
                                    {{-- <a href="#"> --}}
                                        <h4 class="mt-2 mb-1 font-weight-bold">{{ $ctArgasunya }}</h4>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                    <i class="typcn typcn-clipboard text-primary tx-24"></i>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-2">Jumlah Pendukung Kang Ibas di Argasunya:</h4>
                                <div class="card-options ml-auto">
                                </div>
                            </div>
                            <div class="d-flex mb-0">
                                <div class="">
                                    {{-- <a href="#"> --}}
                                        <h4 class="mt-2 mb-1 font-weight-bold">{{ $ctIbasArgasunya }}</h4>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                    <i class="typcn typcn-clipboard text-primary tx-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm" >				
        <div class="col-lg-12">				
            <div class="row row-sm">				
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-2">Jumlah Pemilih Kelurahan Kalijaga:</h4>
                                <div class="card-options ml-auto">
                                </div>
                            </div>
                            <div class="d-flex mb-0">
                                <div class="">
                                    {{-- <a href="#"> --}}
                                        <h4 class="mt-2 mb-1 font-weight-bold">{{ $ctKalijaga }}</h4>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                    <i class="typcn typcn-clipboard text-primary tx-24"></i>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-2">Jumlah Pendukung Kang Ibas di Kalijaga:</h4>
                                <div class="card-options ml-auto">
                                </div>
                            </div>
                            <div class="d-flex mb-0">
                                <div class="">
                                    {{-- <a href="#"> --}}
                                        <h4 class="mt-2 mb-1 font-weight-bold">{{ $ctIbasKalijaga }}</h4>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                    <i class="typcn typcn-clipboard text-primary tx-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-sm">				
        <div class="col-lg-12">				
            <div class="row row-sm">				
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                           <center><h4 class="card-title mb-4">Create Data Section</h4></center><hr>
                            <div class="d-flex justify-content-between" style="text-align: center !important;">
                                
                                <div class="card-options ml-auto">
                                </div>
                            </div>
                            <div class="d-flex mb-0">
                                {{-- style="margin: auto; width: 40%;" --}}
                                <div>
                                    <a href="{{ route('ibas.create') }}" class="btn btn-sm btn-success" style="color: rgb(255, 255, 255); font-weight: bold;">
                                        Buat Data Pemilih Kang Ibas
                                    </a>
                                    <a href="{{ route('quick.create') }}" class="btn btn-sm btn-secondary">
                                        Buat Quick Count
                                    </a>
                                    {{-- <a href="#" class="btn btn-sm btn-secondary">
                                        Buat Real Count 
                                    </a> --}}
                                </div>
                                {{-- <div class="card-chart bg-primary-transparent brround ml-auto mt-0">
                                    <i class="typcn typcn-clipboard text-primary tx-24"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm" >				
        <div class="col-lg-12">				
            <div class="row row-sm">				
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">   
                        <div class="card-body">
                            <center><h4 class="card-title mb-2">Quick Count (Berdasarkan Pendataan Formulir C1)</h4></center>
                            <hr>
                            <div class="card-options ml-auto">
                            </div>
                            <div class="d-flex mb-0">
                                <div class="table-responsive">
                                    <div class="table-wrapper">
                                        <table class="table table-bordered table-hover  mb-0 text-md-nowrap border" style="font-size: smaller;">
                                            <tr style="background-color: rgb(204, 227, 253)">
                                                {{-- <th>No</th> --}}
                                                <th>No TPS</th>
                                                <th>Desa</th>
                                                <th>Saksi</th>
                                                <th>Total Suara</th>
                                                <th>Suara Sah</th>
                                                <th>Perolehan Suara Kang Ibas</th>
                                                <th>Suara Tidak Sah</th>
                                                <th>Suara Abstain</th>
                                                <th>Created By</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                            @foreach ($quick_count as $user)
                                            <tr>
                                                {{-- <td>{{ ++$i }}</td> --}}
                                                <td>{{ $user->notps }}</td>
                                                <td>{{ $user->desa }}</td>
                                                <td>{{ $user->nama_saksi }}</td>
                                                <td>{{ $user->suara_masuk }}</td>
                                                <td>{{ $user->suara_sah }}</td>
                                                <td>{{ $user->suara_ibas }}</td>
                                                <td>{{ $user->suara_tidak_sah }}</td>
                                                <td>{{ $user->suara_abstain }}</td>
                                                <td>{{ $user->created_by }}</td>
                                                <td>
                                                    {{-- <form action="{{ route('quick.destroy',$user->nik ) }}" method="POST"> --}}
                                    
                                                        <a class="btn btn-sm btn-info" href="{{ route('quick.show',$user->id) }}">Show</a>
                                        
                                                        {{-- <a class="btn btn-sm btn-primary" href="{{ route('quick.edit', $user->id) }}">Edit</a> --}}
                                    
                                                        {{-- @csrf
                                                        @method('DELETE')
                                                        
                                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button> --}}
                                                    {{-- </form> --}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <center><h4 class="card-title mb-2">Real Count</h4></center>
                            <hr>
                            <div class="card-options ml-auto">
                            </div>
                            <div class="d-flex mb-0">
                                <div class="">
                                    <table class="table table-sm table-bordered" style="font-size: smaller;">
                                        <tr>
                                            <th>NO TPS</th>
                                            <th>Desa</th>
                                            <th>Nama Saksi</th>
                                            <th>Suara Masuk</th>
                                            <th>Suara Kang Ibas</th>
                                            <th>Suara Sah</th>
                                            <th>Suara Tidak Sah</th>
                                            <th>Suara Abstain</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    
{{-- <center><a href="{{ url('simulasi') }}" class="btn btn-primary" style="background-color: white; color: blue;"> SIMULASI PINJAMAN</a></center> --}}
@endsection

<script>
    function showQuickAccess(){
        var result = confirm('Quick Access. Yakin?')

        if(result){
            document.getElementById('hideakses').style.display = "block";
            document.getElementById('btnhide').style.display = "none";
        }
    }
</script>