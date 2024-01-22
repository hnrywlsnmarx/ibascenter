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
						<h4 class="content-title mb-1">Users</h4>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Master User</a></li>
								<li class="breadcrumb-item active" aria-current="page">Index</li>
							</ol>
						</nav>
					</div>

@endsection('breadcrumb')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>Master User</h5>
            </div>
            <div class="pull-right">
                <a class="btn btn-sm btn-success" href="{{ route('users.create') }}"> Create User</a>
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
                            <input type="text"
                            class="form-control"
                            name="keyword"
                            value="{{ request('keyword') }}"
                            placeholder="Search Name ...">
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
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>No Hp</th>
                    <th>Role</th>
                    <th width="150px">Action</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form action="{{ route('users.destroy',$user->nik ) }}" method="POST">
        
                            <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            
                            <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
        
                            {{-- @csrf
                            @method('DELETE')
                            
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button> --}}
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <br>
            {!! $users->links() !!}
        </div>
    </div>
      
@endsection