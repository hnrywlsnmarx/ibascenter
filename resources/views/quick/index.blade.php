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
    <h4 class="content-title mb-1">Quick Count</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Quick Count</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
    </nav>
</div>

@endsection('breadcrumb')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>Master Quick Count</h5>
            </div>
            <div class="pull-right">
                <a class="btn btn-sm btn-success" href="{{ route('quick.create') }}"> Create Quick Count</a>
            </div>
        </div>
    </div>
    <br>
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
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
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
            <br>
            {!! $users->links() !!}

            
        </div>
    </div>
    <center><a class="btn btn-sm btn-secondary" href="{{ url('kta') }}">Kembali ke Beranda</a>  </center>
@endsection