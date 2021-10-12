@extends('layouts.backendadmin')

@section('content')
<div class="row col-md-12">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('filterprestasi') }}" method="post">
                    @csrf
                    <h6 style="color:#6a381f;">Cari Berdasarkan</h6><br>
                    @if(auth()->user()->id_aktor == 1)
                    <div class="form-group">
                        <label>Pilih Sakter/Satwil</label>
                        <select class="form-control" name="id_kesatuan">
                            <option></option>
                            @if ($data_kesatuan != null)
                            @foreach ($data_kesatuan as $dk)
                            <option value="{{$dk->id_kesatuan}}">{{$dk->kesatuans}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Pilih Pangkat</label>
                        <select class="form-control" name="id_pangkat">
                            <option></option>
                            @if ($data_pangkat != null)
                            @foreach ($data_pangkat as $dp)
                            <option value="{{$dp->id_pangkat}}">{{$dp->pangkats}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="dari2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Dari
                                </div>
                            </div>
                            <input name="from_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="sampai2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Sampai
                                </div>
                            </div>
                            <input name="to_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <input type="text" class="form-control daterange-cus" name="namapersonil">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>NRP/NIP</label>
                        <div class="input-group">
                            <input type="text" class="form-control daterange-cus" name="nrpnip">
                        </div>
                    </div>
                    @if(auth()->user()->id_aktor == 1 || auth()->user()->id_aktor == 2)
                    <div class="form-group">
                        <select class="form-control" id="datapilih" name="data" required>
                            <option disabled selected>Pilih Data</option>
                            <option value="1">Seluruh Data</option>
                            <option value="2">Data yang Telah Diajukan Tingkat POLDA</option>
                        </select>
                    </div>
                    @endif
                    <br>
                    <div class="col-md-12">
                    <button value="submit3" type="submit" name="submit" class="btn btn-polda col-md-12"
                        style="color:white;float:left"><i class="fas fa-search"></i> Cari</button>
                    </div>
                    @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==2)
                    <br>
                    <br>
                    <div class="col-md-12">
                    <button value="submit1" type="submit" name="submit" class="btn btn-success col-md-12"
                        style="color:white;float:left"><i class="far fa-file-excel"></i> Excel</button>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                    <button value="submit2" type="submit" name="submit" class="btn btn-polda col-md-12"
                        style="color:white;float:left"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                    @endif
                    </div>
            </form>
        </div>
    </div>
    <div class="col-md-9 card card-primary">
        <div class="card-body p-0">
            <div class="row col-md-12">
                <div class="col-md-12" align="center">
                    <h4 style="color:#6a381f;text-align:center"><br>Data Prestasi Personel</h4>
                </div>
            </div>
            <hr>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr style="width:1000px">
                                <th style="width:5px">
                                    No
                                </th>
                                <th style="width:50px">Tanggal Input</th>
                                <th style="width:150px">Nama</th>
                                <th style="width:150px">Pangkat</th>
                                <th style="width:150px">NRP/NIP</th>
                                <th style="width:150px">Jabatan</th>
                                <th style="width:150px">Kesatuan</th>
                                <th style="width:200px">Uraian Prestasi</th>
                                <th style="width:100px">Uraian Kronologis Prestasi</th>
                                <th style="width:100px">Evidence</th>
                                <th style="width:100px">
                                    @if(auth()->user()->id_aktor==1)
                                    Validasi
                                    @else
                                    Keterangan
                                    @endif
                                </th>
                                @if(auth()->user()->id_aktor==2)
                                <th style="width:100px">
                                    Penghargaan
                                </th>
                                @elseif(auth()->user()->id_aktor==3)
                                <th style="width:100px">
                                    Edit Data
                                </th>
                                @endif
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                            @if ($data_sigasi != null)
                            @foreach ($data_sigasi as $dg)
                            <tr style="width:5px">
                                <td class="align-top" style="width:5px"><br>{{ $loop->iteration }}
                                </td>
                                <td style="width:50px" class="align-top text-justify"><br>
                                    {{ date('d-m-Y', strtotime($dg->tanggal_input)) }} </td>
                                <td style="width:150px" class="align-top text-justify"><br>
                                    {{ $dg->personil->nama }} </td>
                                <td style="width:150px" class="align-top text-justify"><br>
                                    {{ $dg->personil->pangkat->pangkats }}</td>
                                <td style="width:150px" class="align-top text-justify"><br>
                                    {{ $dg->personil->nrpnip }}</td>
                                <td style="width:150px" class="align-top text-justify"><br>
                                    {{ $dg->personil->jabatan }}
                                </td>
                                <td style="width:150px" class="align-top text-justify"><br>
                                    {{ $dg->personil->kesatuan->kesatuans }}
                                </td>
                                <td style="width:100px" class="align-top text-justify" style="font-weight:bold">
                                    <br>{{ $dg->nama_prestasi}}</td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    @if(auth()->user()->id_aktor==3)
                                    <button data-toggle="modal" data-target="#lihaturaian{{$dg->id_sigasi}}"
                                            style="color: white;" class="btn btn-polda">
                                            <i class="far fa-eye"></i></button>
                                        <div class="modal fade" width="60" id="lihaturaian{{$dg->id_sigasi}}"
                                            tabindex="-1" aria-labelledby="lihaturaian{{$dg->id_sigasi}}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl mx-auto">
                                                <!-- <div class="card mx-auto pt-3 pl-3" style="width: 40rem;"> -->
                                                <div class="modal-content mx-auto">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihaturaian{{$dg->id_sigasi}}Label">
                                                            Uraian Kronologis Prestasi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                                class="form-control" value="{{ $dg->id_sigasi }}">
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label style="font-size: 15px;">Nama Prestasi</label>
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $dg->nama_prestasi }}">
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label style="font-size: 15px;">Uraian Kronologis Prestasi</label>
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $dg->deskripsi }}">
                                                            </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                    <a href="{{ route('lihaturaiankronologis', $dg->id_sigasi) }}"
                                        class="btn btn-polda btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                        title=""><i class="far fa-eye"></i> </a>
                                    @endif
                                </td>
                                <td style="width:100px" class="align-top " style="font-weight:bold"><br>
                                    <center>
                                        @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==2||
                                        auth()->user()->id_aktor==3)
                                        <button data-toggle="modal" data-target="#tambahBukti{{$dg->id_sigasi}}"
                                            style="color: white;" class="btn btn-polda">
                                            <i class="far fa-eye"></i></button>

                                        <div class="modal fade" id="tambahBukti{{$dg->id_sigasi}}" tabindex="-1"
                                            aria-labelledby="tambahBukti{{$dg->id_sigasi}}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahBukti{{$dg->id_sigasi}}Label">
                                                            Tambah Bukti
                                                            Prestasi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('tambahbuktiprestasi')}}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                                class="form-control" value="{{ $dg->id_sigasi }}">
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label style="font-size: 15px;">Nama Prestasi</label>
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $dg->nama_prestasi }}">
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label style="font-size: 15px;">File Bukti</label>
                                                                <?php $databukti=App\Models\BuktiPrestasi::where('id_sigasi',$dg->id_sigasi)->get(); ?>
                                                                @foreach($databukti as $databukti)
                                    @if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2)
                                                                <a class="col-sm-11"
                                                                    href="{{ route('lihatbuktisigasi', $databukti->id_bukti_prestasi) }}">{{$databukti->file_bukti_prestasi}}</a>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-download"></i>
                                                                </div>
                                                                @else
                                                                <div class="col-sm-11">
                                                                {{ $databukti->file_bukti_prestasi }}
                                                            </div>
                                                                @endif
                                                                <hr>
                                                                @endforeach
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3">

                                                                <label style="font-size: 15px;">Tambah File Bukti
                                                                    Prestasi</label>
                                                                <input name="file_bukti_prestasi[]" type="file"
                                                                    class="form-control" multiple="true">
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3 float-right">
                                                                <button class="btn btn-polda mr-1" style="color: white;"
                                                                    type="submit">Tambah File</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            @endif
                                    </center>
                                </td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    <?php $validasi = App\Models\Validasi::where('id_sigasi',$dg->id_sigasi)->where('status',2)->latest()->first(); ?>
                                    @if($dg->keterangan == "0")
                                    @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==2)
                                    @if($validasi == null)
                                    Belum Diajukan
                                    @else
                                    Pengajuan Telah Ditolak dengan Catatan : {{$validasi->catatan_validasi}}
                                    @endif
                                    @elseif(auth()->user()->id_aktor==3)
                                    @if($validasi == null)
                                    <button data-toggle="modal" data-target="#modalsurat1{{$dg->id_sigasi}}" style="color: white;"
                                        class="btn btn-polda">@if(auth()->user()->id_kesatuan==11)
                                        Tindak Lanjut ke POLDA
                                        @else
                                        Tindak Lanjut ke POLRES
                                        @endif</button>
                                    <div class="modal fade" id="modalsurat1{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalsurat1{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalsurat1{{$dg->id_sigasi}}Label">
                                                        Surat Permohonan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('tindaklanjutsigasi',$dg->id_sigasi)}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">

                                                        <div class="form-group">
                                                            <label>No Surat Permohonan</label>
                                                            <input type="text" name="no_file_bukti_surat"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah Surat Permohonan</label>
                                                            <input type="file" name="file_bukti_surat"
                                                                class="form-control" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @else
                                    Pengajuan Telah Ditolak dengan Catatan : {{$validasi->catatan_validasi}}<br><br>
                                    <button data-toggle="modal" data-target="#modalsurat2{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        Tindak Lanjut ke POLRES</button>
                                    <div class="modal fade" id="modalsurat2{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalsurat2{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalsurat2{{$dg->id_sigasi}}Label">
                                                        Surat Permohonan ke
                                                        POLRES</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('tindaklanjutsigasi',$dg->id_sigasi)}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group">
                                                            <label>No Surat Permohonan</label>
                                                            <input type="text" name="no_file_bukti_surat"
                                                                class="form-control" required>
                                                        </div>
                                                        <label>Jenis Surat Permohonan</label>
                                                                <select class="form-control" id="jenis_surat"
                                                                    name="jenis_surat">
                                                                    <option value="" style="color: grey;" disabled
                                                                        selected>-Pilih Jenis Surat Permohonan-</option>
                                                                    <option value="KPLB">KPLB
                                                                    </option>
                                                                    <option value="KPLBA">KPLBA</option>
                                                                    <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                                                    <option value="Promosi Jabatan">Promosi Jabatan</option>
                                                                    <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                                                </select>
                                                        <div class="form-group">
                                                            <label>Unggah Surat Permohonan</label>
                                                            <input type="file" name="file_bukti_surat"
                                                                class="form-control" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @elseif($dg->keterangan == "1")
                                    @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==3 )
                                    @if($dg->personil->id_kesatuan == 11)
                                    No Surat : {{$dg->no_file_bukti_surat}} <br> Sedang di Tindak Lanjut POLDA
                                    @else
                                    No Surat : {{$dg->no_file_bukti_surat}}  Sedang di Tindak Lanjut POLRES
                                    @endif
                                    @elseif(auth()->user()->id_aktor==2)
                                    @if(auth()->user()->id_kesatuan == 11)
                                    <button data-toggle="modal" data-target="#modalvalidasi{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        Validasi</button>
                                    <div class="modal fade" id="modalvalidasi{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalvalidasi{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalvalidasi{{$dg->id_sigasi}}Label">
                                                        Validasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('validasiprestasi',$dg->id_sigasi)}}"
                                                        method="get" enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group">
                                                            <label>Uraian Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                value="{{$dg->nama_prestasi}}" class="form-control"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group row mr-3 ml-3">
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                                ke POLRES</label>
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            <hr>
                                                            @endif
                                                        </div>

                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                                ke POLDA</label>
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisuratadmin', $dg->id_sigasi) }}">{{$dg->suratadmin}}</a>
                                                            @else
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            @endif
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>

                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pengajuan</label>
                                                            <select class="form-control" id="SelectPengajuan"
                                                                name="status">
                                                                <option value="" style="color: grey;" disabled selected>
                                                                    -Pilih-</option>
                                                                <option onselect="valid()" value="1">Diterima</option>
                                                                <option onselect="invalid()" value="2">Ditolak</option>
                                                            </select>
                                                        </div>
                                                        <div id="catatan_validasi">
                                                            <div class="form-group">
                                                                <label>Catatan Validasi</label>
                                                                <input type="text" name="catatan_validasi"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @else
                                    <button data-toggle="modal" data-target="#modalsurat3{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        Tindak Lanjut ke POLDA</button>
                                    <div class="modal fade" id="modalsurat3{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalsurat3{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalsurat3{{$dg->id_sigasi}}Label">
                                                        Surat Permohonan POLDA
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('tindaklanjutsigasi',$dg->id_sigasi)}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Uraian Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                value="{{$dg->nama_prestasi}}" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                                ke POLRES
                                                            @else
                                                                ke POLDA
                                                            @endif
                                                                </label>
                                                                
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            
                                                            <hr>
                                                        </div>
                                                        @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                        <div class="form-group">
                                                            <label>No Surat Permohonan ke POLDA</label>
                                                            <input type="text" name="nosuratadmin" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Surat Permohonan</label>
                                                            <select class="form-control"
                                                                    name="jenissuratadmin">
                                                                    <option value="" style="color: grey;" disabled
                                                                        selected>-Pilih Jenis Surat Permohonan-</option>
                                                                    <option value="KPLB">KPLB
                                                                    </option>
                                                                    <option value="KPLBA">KPLBA</option>
                                                                    <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                                                    <option value="Promosi Jabatan">Promosi Jabatan</option>
                                                                    <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah Surat Permohonan ke POLDA</label>
                                                            <input type="file" name="suratadmin" class="form-control"required>
                                                        </div>
                                                        @endif
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Tindak Lanjut</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @elseif($dg->keterangan == "2")
                                    @if(auth()->user()->id_aktor==1)
                                    <button data-toggle="modal" data-target="#modalvalidasi{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        Validasi</button>
                                    <div class="modal fade" id="modalvalidasi{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalvalidasi{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalvalidasi{{$dg->id_sigasi}}Label">
                                                        Validasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('validasiprestasi',$dg->id_sigasi)}}"
                                                        method="get" enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group">
                                                            <label>Uraian Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                value="{{$dg->nama_prestasi}}" class="form-control"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group row mr-3 ml-3">
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                                ke POLRES</label>
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            <hr>
                                                            @endif
                                                        </div>

                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                                ke POLDA</label>
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisuratadmin', $dg->id_sigasi) }}">{{$dg->suratadmin}}</a>
                                                            @else
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            @endif
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>

                                                            <hr>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                <label>Permohonan di Unggah Oleh : </label>
                                                                <input type="text" name="id_user" value="{{$dg->user->username}}"
                                                                    class="form-control" readonly>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label>Pengajuan</label>
                                                            <select class="form-control" id="SelectPengajuan"
                                                                name="status">
                                                                <option value="" style="color: grey;" disabled selected>
                                                                    -Pilih-</option>
                                                                <option onselect="valid()" value="1">Diterima</option>
                                                                <option onselect="invalid()" value="2">Ditolak</option>
                                                            </select>
                                                        </div>
                                                        <div id="catatan_validasi">
                                                            <div class="form-group">
                                                                <label>Catatan Validasi</label>
                                                                <input type="text" name="catatan_validasi"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @elseif(auth()->user()->id_aktor==2)
                                    <button data-toggle="modal" data-target="#modalsurat3{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        Tindak Lanjut ke POLDA</button>
                                    <div class="modal fade" id="modalsurat3{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalsurat3{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalsurat3{{$dg->id_sigasi}}Label">
                                                        Surat Permohonan POLDA
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('tindaklanjutsigasi',$dg->id_sigasi)}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Uraian Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                value="{{$dg->nama_prestasi}}" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti Surat Permohonan
                                                            @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                                ke POLRES
                                                            @else
                                                                ke POLDA
                                                            @endif
                                                                </label>
                                                                
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisurat', $dg->id_sigasi) }}">{{$dg->file_bukti_surat}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            
                                                            <hr>
                                                        </div>
                                                        @if($dg->personil->id_kesatuan ==
                                                            1||$dg->personil->id_kesatuan ==
                                                            2||$dg->personil->id_kesatuan == 3||
                                                            $dg->personil->id_kesatuan == 4||$dg->personil->id_kesatuan
                                                            == 5||$dg->personil->id_kesatuan == 6||
                                                            $dg->personil->id_kesatuan == 7||$dg->personil->id_kesatuan
                                                            == 8||$dg->personil->id_kesatuan ==
                                                            9||$dg->personil->id_kesatuan == 10)
                                                        <div class="form-group">
                                                            <label>No Surat Permohonan ke POLDA</label>
                                                            <input type="text" name="nosuratadmin" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Surat Permohonan</label>
                                                            <select class="form-control"
                                                                    name="jenissuratadmin">
                                                                    <option value="" style="color: grey;" disabled
                                                                        selected>-Pilih Jenis Surat Permohonan-</option>
                                                                    <option value="KPLB">KPLB
                                                                    </option>
                                                                    <option value="KPLBA">KPLBA</option>
                                                                    <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                                                    <option value="Promosi Jabatan">Promosi Jabatan</option>
                                                                    <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah Surat Permohonan ke POLDA</label>
                                                            <input type="file" name="suratadmin" class="form-control"required>
                                                        </div>
                                                        @endif
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Tindak Lanjut</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    @elseif(auth()->user()->id_aktor==3)
                                    @if($dg->personil->id_kesatuan == 11)
                                    No Surat : {{$dg->no_file_bukti_surat}} <br> Sedang di Validasi POLDA
                                    @else
                                    No Surat : {{$dg->nosuratadmin}} <br> Sedang di Validasi POLDA
                                    @endif
                                    @endif
                                    @elseif($dg->keterangan==3)
                                    @if($dg->personil->id_kesatuan == 11)
                                    No Surat : {{$dg->no_file_bukti_surat}}
                                    @else
                                    No Surat : {{$dg->nosuratadmin}}
                                    @endif
                                    <br>
                                    Pengajuan di Terima
                                    @endif
                                    <br><br>
                                </td>
                                <td class="align-top">
                                    <br>
                                    @if(auth()->user()->id_aktor==1)
                                    @if($dg->nama_penghargaan == null)
                                    <button data-toggle="modal" data-target="#modalberipenghargaan"
                                        style="color: white;" class="btn btn-polda">
                                        Upload Kep Penghargaan</button>
                                    <div class="modal fade" id="modalberipenghargaan" tabindex="-1"
                                        aria-labelledby="modalberipenghargaanLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalberipenghargaanLabel">Upload Kep
                                                        Penghargaan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('beripenghargaan',$dg->id_sigasi)}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')
                                                        <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                            class="form-control" value="{{ $dg->id_sigasi }}">
                                                        <div class="form-group">
                                                            <label>Uraian Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                value="{{$dg->nama_prestasi}}" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti</label>
                                                            <?php $databukti=App\Models\BuktiPrestasi::where('id_sigasi',$dg->id_sigasi)->get(); ?>
                                                            @foreach($databukti as $databukti)
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisigasi', $databukti->id_bukti_prestasi) }}">{{$databukti->file_bukti_prestasi}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            <hr>
                                                            @endforeach
                                                        </div>
                                                        <hr style="background-color:red">
                                                        <div class="form-group">
                                                            <label>Nama Penghargaan</label>
                                                            <input type="text" name="nama_penghargaan"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan Penghargaan</label>
                                                            <input type="text" name="keterangan_penghargaan"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Penghargaan</label>
                                                            <select class="form-control" id="mySelect"
                                                                name="jenpeng">
                                                                <option value="" style="color: grey;" disabled selected>
                                                                    -Pilih Jenis Penghargaan-</option>
                                                                <option onselect="pol()" value="Polri">Penghargaan dari
                                                                    Polri</option>
                                                                <option onselect="npol()" value="Non Polri">Penghargaan
                                                                    dari Badan/Instansi Luar Polri</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <!--<div id="nonpol">-->
                                                            <!--    <input id="tingkat" name="tingkat" type="text"-->
                                                            <!--        class="form-control">-->
                                                            <!--</div>-->
                                                            <div id="pol">
                                                                <!--<label>Tingkat Penghargaan</label>-->
                                                                <!--<select class="form-control" id="tingkat"-->
                                                                <!--    name="tingkat">-->
                                                                <!--    <option value="" style="color: grey;" disabled-->
                                                                <!--        selected>-Pilih Tingkat Penghargaan-</option>-->
                                                                <!--    <option value="Tingkat Polres">Tingkat Polres-->
                                                                <!--    </option>-->
                                                                <!--    <option value="Tingkat Polda">Tingkat Polda</option>-->
                                                                <!--    <option value="Tingkat Mabes">Tingkat Mabes</option>-->
                                                                <!--</select>-->
                                                                <label>Jenis Penghargaan</label>
                                                                <select class="form-control" id="jenis_penghargaan"
                                                                    name="jenis_penghargaan">
                                                                    <option value="" style="color: grey;" disabled
                                                                        selected>-Pilih Jenis Penghargaan-</option>
                                                                    <option value="KPLB">KPLB
                                                                    </option>
                                                                    <option value="KPLBA">KPLBA</option>
                                                                    <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                                                    <option value="Promosi Jabatan">Promosi Jabatan</option>
                                                                    <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pemberi Penghargaan</label>
                                                            <input type="text" name="sumber" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah file bukti</label>
                                                            <input name="file_bukti_penghargaan[]" type="file"
                                                                class="form-control" multiple="true">
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                    @else
                                    Telah Menerima Penghargaan<br>
                                    <button data-toggle="modal" data-target="#modalberipenghargaan{{$dg->id_sigasi}}"
                                        style="color: white;" class="btn btn-polda">
                                        <i class="far fa-eye"></i></button>
                                    <div class="modal fade" id="modalberipenghargaan{{$dg->id_sigasi}}" tabindex="-1"
                                        aria-labelledby="modalberipenghargaan{{$dg->id_sigasi}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalberipenghargaan{{$dg->id_sigasi}}Label">Data Penghargaan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Penghargaan</label>
                                                            <input type="text" name="nama_penghargaan"
                                                                class="form-control"value="{{$dg->nama_penghargaan}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan Penghargaan</label>
                                                            <input type="text" name="keterangan_penghargaan"
                                                                class="form-control"value="{{$dg->keterangan_penghargaan}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Penghargaan</label>
                                                            <input type="text" name="jenis_penghargaan"
                                                                class="form-control"value="{{$dg->jenis_penghargaan}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pemberi Penghargaan</label>
                                                            <input type="text" name="sumber" class="form-control"value="{{$dg->sumber}}" readonly>
                                                        </div>
                                                        <div class="form-group row mr-3 ml-3">
                                                            <label style="font-size: 15px;">File Bukti</label>
                                                            <?php $databukti=App\Models\BuktiPenghargaan::where('id_sigasi',$dg->id_sigasi)->get(); ?>
                                                            @foreach($databukti as $databukti)
                                                            <a class="col-sm-11"
                                                                href="{{ route('lihatbuktisigasi', $databukti->id_bukti_penghargaan) }}">{{$databukti->file_bukti_penghargaan}}</a>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-download"></i>
                                                            </div>
                                                            <hr>
                                                            @endforeach
                                                        </div>
                                                        <button type="submit" class="btn btn-polda"
                                                            style="float:right;color:white">Simpan</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                    @endif
                                    @elseif(auth()->user()->id_aktor == 3)
                                    <a href="{{ route('editsigasi', $dg->id_sigasi) }}"
                                        class="btn btn-polda btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                        title="">Edit Data</a>
                                    @endif
                                </td>
                                <td class="align-top">
                                    @if(auth()->user()->id_aktor==1)
                                    <br>
                                    <a href="{{ route('hapussigasi', $dg->id_sigasi) }}"
                                        class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                        title=""><i class="fas fa-trash"></i> </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>


@endsection
