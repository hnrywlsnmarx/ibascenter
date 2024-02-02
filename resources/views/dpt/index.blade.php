@extends('layouts.appibas')
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

<div class="left-content">
    <h4 class="content-title mb-1">DPT KPU</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">DPT KPU</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
    </nav>
</div>

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
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-bordered table-hover  mb-0 text-md-nowrap border" style="font-size: smaller;">
                <tr style="background-color: rgb(204, 227, 253)">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Usia</th>
                    <th>Desa</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>TPS</th>                    
                    
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>                    
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->jk }}</td>
                    <td>{{ $user->usia }}</td>
                    <td>{{ $user->desa }}</td>
                    <td>{{ $user->rt }}</td>
                    <td>{{ $user->rw }}</td>
                    <td>{{ $user->tps }}</td>
                </tr>
                @endforeach
            </table>
            <br>
            {!! $users->links() !!}
        </div>
    </div>
    <br>
    <br>
    <br>
    <center><a class="btn btn-sm btn-secondary" href="{{ url('kta') }}">Kembali ke Beranda</a>  </center>
    <br>
    <br>
    <br>
@endsection