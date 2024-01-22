@extends('layouts.app3')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="bg-gray-100">
                        <p>
                            Anda belum menyelesaikan tahapan pengisian eForm KTA. Silahkan kembali ke Beranda dan lihat petunjuk yang tertera pada <b>Pick up What you're left</b> kemudian lanjukan tahapan pengisian eForm KTA.
                        </p>
                    </div>
                    
                    <a href="{{ url('kta') }}" class="btn btn-warning" style="float: right;">Kembali ke Beranda </a>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

@endsection