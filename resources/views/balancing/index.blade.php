@extends('layouts.appbalancing')
<style>
    .table-wrapper {
        max-height: 400px;
        overflow: auto;
        /* display:inline-block; */
      }
</style>
@section('styles') 
@endsection

@section('breadcrumb')
<center><a class="btn btn-sm btn-secondary" href="{{ url('kta') }}">Kembali ke Beranda</a>  </center>
@endsection('breadcrumb')

@section('content')
<form action="{{ url()->current() }}"
    method="get">
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="pd-30 pd-sm-40 bg-gray-100">
                <div class="input-group">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Search Name ...">
                    </div>
                    <span class="input-group-btn">
                        <button type="submit" class="btn ripple btn-sm btn-primary br-tl-0 br-bl-0" type="button">Submit</button>
                    </span>
                </div>
               
            </div>
        </div>
    </div>
</div>
</form>
<center>
    <p style="font-weight: bold; font-size: large">
        Data Balancing Kalijaga <br>
    </p>
    <p> <b>({{ $totalRowsBalance }}</b> data dari  <b>{{ $totalRows }}</b> inputan ditemukan dalam DPT Kalijaga)</p>
</center>
    <div class="table-responsive">
        {{-- <div class="table-wrapper"> --}}
            <table class="table table-bordered table-hover  mb-0 text-md-nowrap border" style="font-size: smaller;">
                <tr>
                    <th style="font-weight: bold;text-align: center;background-color: rgb(204, 210, 52)">No</th>
                    <th colspan="7" style="font-size: large;text-align: center;background-color: rgb(111, 195, 111);color:white;">Submitted Data</th>
                    <th colspan="6" style="font-weight: bold; font-size: large;text-align: center;background-color: rgb(204, 227, 253)">DPT</th>
                    <th style="font-weight: bold;text-align: center;background-color: rgb(204, 210, 52)">Created By</th>
                    {{-- <th width="150px">Action</th> --}}
                </tr>
                <tr>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 210, 52)"></td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">NIK</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">Nama</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">JK</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">Usia</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">RT</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">RW</td>
                    <td style="text-align: center;background-color: rgb(111, 195, 111);color:white;">TPS</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">Nama</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">JK</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">Usia</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">RT</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">RW</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 227, 253)">TPS</td>
                    <td style="font-weight: bold;text-align: center;background-color: rgb(204, 210, 52)"></td>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->jk }}</td>
                    <td>{{ $user->usia }}</td>
                    <td>{{ $user->rt }}</td>
                    <td>{{ $user->rw }}</td>
                    <td>{{ $user->tps }}</td>
                    <td>{{ $user->source_nama }}</td>
                    <td>{{ $user->source_jk }}</td>
                    <td>{{ $user->source_usia }}</td>
                    <td>{{ $user->source_rt }}</td>
                    <td>{{ $user->source_rw }}</td>
                    <td>{{ $user->source_tps }}</td>
                    <td>{{ $user->created_by }}</td>
                </tr>
                @endforeach
            </table>
            <br>
            {!! $users->links() !!}
        {{-- </div> --}}
    </div>
    <br>
    <br>
    <br>
    <center><a class="btn btn-sm btn-secondary" href="{{ url('kta') }}">Kembali ke Beranda</a>  </center>
    <br>
    <br>
    <br>
@endsection