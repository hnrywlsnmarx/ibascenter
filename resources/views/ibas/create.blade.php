@extends('layouts.appibas')

@section('styles') 
@endsection

@section('breadcrumb')

<div class="left-content">
    <h4 class="content-title mb-1">Pemilih Kang Ibas</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Pemilih Kang Ibas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
    </nav>
</div>

@endsection('breadcrumb')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ibas.index') }}"> Back</a>
        </div>
    </div>
</div>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('ibas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <input type="hidden" name="ip_address" value="{{ session('ip_address') }}">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Create
                    </div>
                    {{-- <p class="mg-b-20 text-muted">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                    <div class="pd-30 pd-sm-40 bg-gray-100">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">NIK</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input type="text" name="nik" id="nik" class="form-control" pattern="\d*" placeholder="NIK" maxlength="16" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Nama</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Jenis Kelamin</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <select class="form-control" name="jk" id="jk" required>
                                    <option value="">-Pilih Jenis Kelamin-</option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Usia</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="usia" placeholder="Enter your age" type="number" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Desa</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <select class="form-control" name="idarea" id="idarea" required>
                                    <option value="">-Pilih Desa-</option>
                                    <option value="1">KALIJAGA</option>
                                    <option value="2">ARGASUNYA</option>
                                </select>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">RT</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="rt" type="number" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">RW</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="rw" type="number" required>
                            </div>
                        </div>                    
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">TPS</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="tps" type="number" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Keterangan</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="ket" type="text" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Foto KTP</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="foto_ktp" type="file" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Foto Diri</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="foto_diri" type="file" required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-12">
                                <label class="form-label mg-b-0">Created By</label>
                            </div>
                            <div class="col-md-12 mg-t-5">
                                <input class="form-control" name="created_by" type="text" value="{{ session('name') }}" readonly required>
                            </div>
                        </div>
 
                        <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                        {{-- <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
</form>
@endsection
@section('scripts')
<script type="text/javascript">

$('#status').select2({
    placeholder: 'Pilih Status',
        ajax: {
            url: '/status-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
        
});

$('#livesearch-branch').select2({
        placeholder: 'Select Branch',
        ajax: {
            url: '/branch-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.branch_name,
                            id: item.branch_code
                        }
                    })
                };
            },
            cache: true
        }
        
    });

    $('#livesearch-role').select2({
        placeholder: 'Select Role',
        ajax: {
            url: '/role-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#livesearch-nik').select2({
        placeholder: 'Select NIK',
        ajax: {
            url: '/nik-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.id,
                            id: item.id,
                        }
                    }
                    )
                };
            },            
            cache: true
        }
    }).on('change', function(e){
        var id = $(this).val();
        var url = '/get-datanik/' + id;

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(data){
                return {
                    results: $.map(data, function (item) {
                        console.log(item.namacab);
                        $('[name="name"]').val(item.name);
                        $('[name="email"]').val(item.email);
                        $('[name="branch_code"]').val(item.branchehr);
                        $('[name="namacab"]').val(item.namacabehr);
                    })
                };
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("Gagal memperoleh data");
              }
            
        });
        
    });

   
</script>
@endsection