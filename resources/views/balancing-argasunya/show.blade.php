@extends('layouts.appibas')

@section('styles') 
@endsection

@section('breadcrumb')

<div class="left-content">
    <h4 class="content-title mb-1">Quick Count</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master Quick Count</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>

@endsection('breadcrumb')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('quick.index') }}"> Back</a>
            </div>
        </div>
    </div>
   <br>
   @foreach($datas as $data)
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="main-content-label mg-b-5">
                        User {{ $data->nik }}
                    </div> --}}
                    {{-- <p class="mg-b-20 text-muted">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                    <div class="pd-30 pd-sm-40 bg-gray-100">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">TPS</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->notps }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Desa</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->desa }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Nama Saksi</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->nama_saksi }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Total Suara</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->suara_masuk }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Suara Sah</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->suara_sah }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Perolehan Suara Kang Ibas</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->suara_ibas }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Suara Tidak Sah</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->suara_tidak_sah }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Suara Abstain</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->suara_abstain }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Created By</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->created_by }}
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label mg-b-0">Updated By</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                {{ $data->updated_by }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="main-content-label mg-b-5">
                        User {{ $data->nik }}
                    </div> --}}
                    {{-- <p class="mg-b-20 text-muted">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Foto C1</th>
                                    <th>Foto C1_1</th>
                                    <th>Foto C1_2</th>
                                    <th>Foto C1_3</th>
                                </tr>
                                <tr>
                                    <td>
                                        <img width="400" id="imgc1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1) }}">
                                    </td>
                                    
                                    <td>
                                        <center><img width="400" id="imgc1_1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_1) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_1) }}"></center>
                                    </td>
                                    <td>
                                        <center><img width="400" id="imgc1_2" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_2) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_2) }}"></center>
                                    </td>
                                    <td>
                                        <center><img width="400" id="imgc1_3" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_3) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_3) }}"></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><a type="submit" class="btn btn-sm btn-primary" href="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1) }}" target="_blank">Check</a></td>
                                    <td style="text-align: center;"><a type="submit" class="btn btn-sm btn-primary" href="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_1) }}" target="_blank">Check</a></td>
                                    <td style="text-align: center;"><a type="submit" class="btn btn-sm btn-primary" href="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_2) }}" target="_blank">Check</a></td>
                                    <td style="text-align: center;"><a type="submit" class="btn btn-sm btn-primary" href="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_3) }}" target="_blank">Check</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- /row -->

@endsection