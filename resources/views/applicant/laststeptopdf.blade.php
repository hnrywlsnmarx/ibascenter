
@extends('layouts.apptopdf')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="bg-gray-100">
                        <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 33.3333%;">No Referensi Pinjaman</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->ref_no }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">NIK</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->nik }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Token Registrasi</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->tokenreg }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Nama Sesuai KTP</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">NPWP</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->npwp_stone }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">No Handphone</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Nama Gadis Ibu Kandung</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->mother_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Tempat Lahir</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Tanggal Lahir</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Status Pernikahan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->marital_status }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Jumlah Tanggungan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->julah_tanggungan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Alamat</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Desa</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->desa }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Kecamatan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Kabupaten/Kota</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->kabupatenkota }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Provinsi</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->provinsi }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Kode Pos</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->kodepos }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Status Kepemilikan Hunian</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->housing }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->los_year }} tahun {{ $data->los_month }} bulan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="bg-gray-100">
                        <table class="table" style="width: 100%; border-collapse: collapse;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 33.3333%;">Nama Saudara</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->nama_saudara }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">No Handphone Saudara</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->no_hp_saudara }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Alamat Saudara</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->alamat_saudara }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Pekerjaan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Nama Perusahaan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Lama Bekerja</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->lama_bekerja_tahun }} tahun {{ $data->lama_bekerja_bulan }} bulan</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Alamat Kantor</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->alamat_kantor }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Nomor Telepon Kantor</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->tel_kantor }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Sumber Penghasilan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->sumber_penghasilan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Penghasilan Perbulan</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->penghasilan_perbulan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Memiliki Kartu Kredit</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->creditcard }}</td>
                                </tr>
                                @if($data->creditcard == 'Tidak')
                                    <tr>
                                        <td style="width: 33.3333%;">Bank Penerbit</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;"> - </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;"> - </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33.3333%;">Limit</td>
                                        <td style="width: 3.50874%;">:</td>
                                        <td style="width: 33.3333%;"> - </td>
                                    </tr>
                                    @else
                                        @foreach($databank as $dat)
                                            <tr>
                                                <td style="width: 33.3333%;">Bank Penerbit</td>
                                                <td style="width: 3.50874%;">:</td>
                                                <td style="width: 33.3333%;">{{ $dat->bank_penerbit }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 33.3333%;">Lama Kepemilikan</td>
                                                <td style="width: 3.50874%;">:</td>
                                                <td style="width: 33.3333%;">{{ $dat->lama_kepemilikan_tahun }} tahun {{ $data->lama_kepemilikan_bulan }} bulan</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 33.3333%;">Limit</td>
                                                <td style="width: 3.50874%;">:</td>
                                                <td style="width: 33.3333%;">{{ $dat->limit }}</td>
                                            </tr>
                                        @endforeach
                                @endif
                                <tr>
                                    <td style="width: 33.3333%;">Produk Pinjaman</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->produk_pinjaman }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Jumlah Pinjaman</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->jumlah_pinjaman }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Jangka Waktu</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->jangka_waktu }} Bulan</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Tujuan Pinjaman</td>
                                    <td style="width: 3.50874%;">:</td>
                                    <td style="width: 33.3333%;">{{ $data->tujuan_pinjaman }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
