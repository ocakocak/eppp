@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 style="color:#6a381f">File Surat Permohonan ke POLDA, {{$data_sigasi->personil->nama}}</h4>
    </div>
    <div class="card-body p-0">
        @if ($data_sigasi != null)
        <div class="card-body">
            @if($data_sigasi->extensionsuratadmin == "docx" ||
            $data_sigasi->extensionsuratadmin == "doc" ||
            $data_sigasi->extensionsuratadmin == "xlsx" ||
            $data_sigasi->extensionsuratadmin == "xls")
            <center>
                <h4 style="color:#6a381f">File Surat Permohonan ke POLDA Sedang Di Unduh <iframe
                        src="{{ asset('storage/public/suratadmin/'.$data_sigasi->suratadmin)}}" width="0"
                        height="0"></iframe></h4>

            </center>
            @elseif($data_sigasi->extensionsuratadmin == "pdf")
            <iframe src="{{ asset('storage/public/suratadmin/'.$data_sigasi->suratadmin)}}" width="1000"
                height="650"></iframe>
            @else
            <img src="{{ asset('storage/public/suratadmin/'.$data_sigasi->suratadmin)}}" width="100%">
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
@endsection
