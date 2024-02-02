@extends('layouts.appibas')

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
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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

    @foreach($datas as $data)
    <form action="{{ route('quick.update',$data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" name="ip_address" value="{{ session('ip_address') }}">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            {{-- Create --}}
                        </div>
                        {{-- <p class="mg-b-20 text-muted">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                        {{-- <div class="pd-30 pd-sm-40 bg-gray-100"> --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Desa <p style="font-weight: bold; color: red;">*pilih kembali untuk merefresh pilihan TPS</p></label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" name="desa" id="desa" required>
                                        @if($data->desa == "KALIJAGA")
                                        <option value="">-Pilih Desa-</option>
                                        <option value="KALIJAGA" selected>KALIJAGA</option>
                                        <option value="ARGASUNYA">ARGASUNYA</option>
                                        @elseif($data->desa == "ARGASUNYA")
                                        <option value="">-Pilih Desa-</option>
                                        <option value="KALIJAGA">KALIJAGA</option>
                                        <option value="ARGASUNYA" selected>ARGASUNYA</option>
                                        @else
                                        <option value="" selected>-Pilih Desa-</option>
                                        <option value="KALIJAGA">KALIJAGA</option>
                                        <option value="ARGASUNYA">ARGASUNYA</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">TPS</label>
                                    <br>
                                    <p style="font-weight: bold;">existing: {{ $data->notps }} - {{ $data->desa }}
                                        <input type="hidden" class="form-control form-control-sm" name="exstps" value="{{ $data->notps }}" readonly><br>
                                        <input class="form-control form-control-sm" type="hidden" name="exsdesa" value="{{ $data->desa }}" readonly>
                                    </p>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control" name="notps" id="notps" required>
                                        <option value="" selected="true">- Pilih TPS -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Saksi</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <select class="form-control p-3" name="nama_saksi" id="livesearch-saksi">
                                        <option value="" selected disabled>- Pilih Saksi -</option>
                                            @foreach($saksis as $prod)
                                            @if(in_array($data->nama_saksi, $saksiall))
                                            <option value="{{ $prod->nik }}" selected>{{ $prod->name }}</option>
                                            @else
                                            <option value="{{ $prod->nik }}">{{ $prod->name }}</option>
                                            @endif
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jumlah Total Suara</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="suara_masuk" placeholder="Masukan Total Suara" value="{{ $data->suara_masuk }}" type="number" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Perolehan Suara Kang Ibas</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="suara_ibas" placeholder="Masukan Perolehan Suara Kang Ibas" value="{{ $data->suara_ibas }}" type="number" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jumlah Suara Sah</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="suara_sah" placeholder="Masukan Jumlah Suara Sah" value="{{ $data->suara_sah }}"  type="number" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jumlah Suara Tidak Sah</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="suara_tidak_sah" placeholder="Masukan Jumlah Suara Tidak Sah" value="{{ $data->suara_tidak_sah }}"  type="number" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Jumlah Suara Abstain</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="suara_abstain" placeholder="Masukan Jumlah Suara Abstain" value="{{ $data->suara_abstain }}"  type="number" required>
                                </div>
                            </div>                   
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Foto C1</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="foto_c1" type="file">
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <img width="400" id="imgc1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1) }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Foto C1_1</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="foto_c1_1" type="file">
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <img width="400" id="imgc1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_1) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_1) }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Foto C1_2</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="foto_c1_2" type="file">
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <img width="400" id="imgc1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_2) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_2) }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Foto C1_3</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="foto_c1_3" type="file">
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <img width="400" id="imgc1" src="{{ asset('/public/storage/'.$data->path."/".$data->foto_c1_3) }}" alt="{{ asset('public/storage/'.$data->path."/".$data->foto_c1_3) }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-12">
                                    <label class="form-label mg-b-0">Updated By</label>
                                </div>
                                <div class="col-md-12 mg-t-5">
                                    <input class="form-control" name="updated_by" type="text" value="{{ session('name') }}" readonly required>
                                </div>
                            </div>
     
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                            {{-- <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach
@endsection

@section('scripts')
<script type="text/javascript">

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(function() {
            $('#desa').on('change', function() {
                let desaValue = $('#desa').val();
                // Send ID to Controller
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getTps') }}",
                    data: {desaValue: desaValue},
                    cache: false,
                    success: function(msg) {
                        $('#notps').html(msg);
                        
                    },
                    error: function(err) {
                        console.log('error: ', err);
                    },
                });
            });
        });
    
    $("#notps" ).select2({});

    $('#livesearch-saksi').select2({});
</script>
@endsection