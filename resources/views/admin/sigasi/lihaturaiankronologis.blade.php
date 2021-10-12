@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 style="color:#6a381f">File Uraian Kronologis, {{$data_sigasi->personil->nama}}</h4>
    </div>
    <div class="card-body p-0">
        @if ($data_sigasi != null)
        <div class="card-body">
            @if($data_sigasi->extension_deskripsi == "docx" ||
            $data_sigasi->extension_deskripsi == "doc" ||
            $data_sigasi->extension_deskripsi == "xlsx" ||
            $data_sigasi->extension_deskripsi == "xls")
            <center>
                <h4 style="color:#6a381f">File Uraian Kronologis Sedang Di Unduh <iframe
                        src="{{ asset('storage/public/deskripsi/'.$data_sigasi->deskripsi)}}" width="0"
                        height="0"></iframe></h4>

            </center>
            @elseif($data_sigasi->extension_deskripsi == "pdf")
            <iframe src="{{ asset('storage/public/deskripsi/'.$data_sigasi->deskripsi)}}" width="1000"
                height="650"></iframe>
            @else
            <img src="{{ asset('storage/public/deskripsi/'.$data_sigasi->deskripsi)}}" width="100%">
            @endif
            @endif
        </div>
        <div class="card-footer text-right">
            <!-- <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save"></i></button>
                                <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button> -->
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="tambahBukti" tabindex="-1" aria-labelledby="tambahBuktiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBuktiLabel">Tambah Data Personel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambahbuktiprestasi')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="id_sigasi" id="id_sigasi" type="hidden" class="form-control"
                        value="{{ $data_sigasi->id_sigasi }}">
                    <div class="form-group row mr-3 ml-3">
                        <label style="font-size: 15px;">Nama Prestasi</label>
                        <input type="text" class="form-control" readonly value="{{ $data_sigasi->nama_prestasi }}">
                    </div>
                    <div class="form-group row mr-3 ml-3">

                        <label style="font-size: 15px;">Tambah File Bukti Prestasi</label>
                        <input name="deskripsi[]" type="file" class="form-control" multiple="true">
                    </div>
                    <div class="form-group row mr-3 ml-3 float-right">
                        <button class="btn btn-polda mr-1" style="color: white;" type="submit">Tambah File</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @endsection
