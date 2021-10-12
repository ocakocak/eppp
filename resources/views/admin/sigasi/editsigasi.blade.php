@extends('layouts.backendadmin')

@section('content')
<div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
    <div class="card-header">
        <h4>
            <button data-toggle="modal" data-target="#tambahPersonil" style="color: white;" class="btn btn-polda">
                <i class="fas fa-plus-circle"></i> &nbsp; Tambah Data Personel
            </button>
        </h4>
        <br>
    </div>
    <div class="card-body p-0">
        <form action="{{ route('updatedatasigasi',$data_sigasi->id_sigasi) }}" method="post"
            enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('patch')
                <p style="color: #99582a; font-size:25px; font-weight:bold" class="text-center">Ubah Prestasi dan
                    Penghargaan</p>

                <!-- DATA PERSONEL -->
                <p style="color:#6e0d25; font-weight:bold; font-size:20px">Data Personel</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">{{__('Nama Personel')}}</label>
                                <select class="form-control" id="nama" name="nama">
                                    @if($data_sigasi->id_personil !== null)
                                    <option value="{{$data_sigasi->id_personil}}">{{$data_sigasi->personil->nama}}
                                    </option>
                                    @foreach ($data_personil as $pr)
                                    <option value="{{ $pr->id_personil }}">{{ $pr->nama }}</option>
                                    @endforeach
                                    @else
                                    @foreach ($data_personil as $pr)
                                    <option value="{{ $pr->id_personil }}">{{ $pr->nama }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- PRESTASI -->
                <p style="color:#6e0d25; font-weight:bold; font-size:20px">Ubah Prestasi</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Uraian Prestasi</label>
                                <input name="nama_prestasi" value="{{$data_sigasi->nama_prestasi}}" type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Unggah File Kronologis Prestasi</label>
                                <input name="deskripsi" type="file" value="{{$data_sigasi->deskripsi}}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- PENGHARGAAN -->
                <p style="color:#6e0d25; font-weight:bold; font-size:20px">Surat Permohonan Penghargaan</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Unggah file surat</label>
                                <input name="file_bukti_surat" value="{{$data_sigasi->file_bukti_surat}}" type="file"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="background-color:red">
                <!-- PENGHARGAAN -->
                <p style="color:#6e0d25; font-weight:bold; font-size:20px">Penghargaan yang Telah Diterima</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Jenis Penghargaan</label>
                                <select class="form-control" id="mySelect" name="jenis_penghargaan">
                                    @if($data_sigasi->jenis_penghargaan !== null)
                                    <option value="{{$data_sigasi->jenis_penghargaan}}">
                                        {{$data_sigasi->jenis_penghargaan}}</option>
                                    <option onselect="pol()" value="Polri">Penghargaan dari Polri</option>
                                    <option onselect="npol()" value="Non Polri">Penghargaan dari Badan/Instansi Luar
                                        Polri</option>
                                    @else
                                    <option value="" style="color: grey;" disabled selected>-Pilih Jenis Penghargaan-
                                    </option>
                                    <option onselect="pol()" value="Polri">Penghargaan dari Polri</option>
                                    <option onselect="npol()" value="Non Polri">Penghargaan dari Badan/Instansi Luar
                                        Polri</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <!--<div id="nonpol">-->
                                <!--    <input id="tingkat" name="tingkat" type="text" class="form-control">-->
                                <!--</div>-->
                                <div id="pol">
                                    <label>Jenis Penghargaan</label>
                                        <select class="form-control" id="jenis_penghargaan"name="jenis_penghargaan">
                                            <option value="" style="color: grey;" disabled selected>-Pilih Jenis Penghargaan-</option>
                                            <option value="KPLB">KPLB</option>
                                            <option value="KPLBA">KPLBA</option>
                                            <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                            <option value="Promosi Jabatan">Promosi Jabatan</option>
                                            <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                        </select>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nama Penghargaan</label>
                                <input name="nama_penghargaan" value="{{$data_sigasi->nama_penghargaan}}" type="text"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pemberi Penghargaan</label>
                                <input name="sumber" type="text" value="{{$data_sigasi->sumber}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Keterangan Penghargaan</label>
                                <input name="keterangan_penghargaan" type="text" value="{{$data_sigasi->keterangan_penghargaan}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save"></i></button>
                <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL TAMBAH DATA Personel -->

<div class="modal fade" id="tambahPersonil" tabindex="-1" aria-labelledby="tambahPersonilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPersonilLabel">Tambah Data Personel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tambahdatapersonil') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">Nama Personel</label>
                        <input name="nama" type="text" class="form-control">
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">NRP/NIP</label>
                        <input name="nrpnip" type="text" class="form-control">
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">Pangkat</label>
                        <select class="form-control" id="pangkat" name="pangkat">
                            <option disabled selected value="">-Pilih Pangkat-</option>
                            @foreach ($data_pangkat as $p)
                            <option value="{{ $p->id_pangkat }}">{{ $p->pangkats }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">Jabatan</label>
                        <input name="jabatan" type="text" class="form-control">
                    </div>
                    <!-- <div class="form-group row mr-3 ml-3">
                            <label style="font-size: 15px;">Kesatuan</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                        </div> -->
                    @if(auth()->user()->id==1)
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">Kesatuan</label>
                        <select class="form-control" id="kesatuan" name="kesatuan">
                            @foreach ($data_kesatuan as $k)
                            <option value="{{ $k->id_kesatuan }}">{{ $k->kesatuans }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input name="kesatuan" type="hidden" value="{{ auth()->user()->id_kesatuan }}" class="form-control">
                    @endif
                    <button class="btn btn-polda mr-1" style="color: white;" type="submit"><i
                            class="fas fa-save"></i></button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button>

                </form>
            </div>

        </div>
    </div>

    @endsection
