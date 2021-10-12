@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 style="color:#6a381f">File Surat Permohonan ke
            @if($data_sigasi->personil->id_kesatuan==1||$data_sigasi->personil->id_kesatuan==2||$data_sigasi->personil->id_kesatuan==3||
            $data_sigasi->personil->id_kesatuan==4||$data_sigasi->personil->id_kesatuan==5||$data_sigasi->personil->id_kesatuan==6||
            $data_sigasi->personil->id_kesatuan==7||$data_sigasi->personil->id_kesatuan==8||$data_sigasi->personil->id_kesatuan==9||$data_sigasi->personil->id_kesatuan==10)
            POLRES
            @else
            POLDA
            @endif
            , {{$data_sigasi->personil->nama}}</h4>
    </div>
    <div class="card-body p-0">
        @if ($data_sigasi != null)
        <div class="card-body">
            @if($data_sigasi->extension_file_bukti_surat == "docx" ||
            $data_sigasi->extension_file_bukti_surat == "doc" ||
            $data_sigasi->extension_file_bukti_surat == "xlsx" ||
            $data_sigasi->extension_file_bukti_surat == "xls"||
            $data_sigasi->extension_file_bukti_surat == "ppt" ||
            $data_sigasi->extension_file_bukti_surat == "pptx")
            <center>
                <h4 style="color:#6a381f">File Surat Permohonan ke
                    @if($data_sigasi->personil->id_kesatuan==1||$data_sigasi->personil->id_kesatuan==2||$data_sigasi->personil->id_kesatuan==3||
                    $data_sigasi->personil->id_kesatuan==4||$data_sigasi->personil->id_kesatuan==5||$data_sigasi->personil->id_kesatuan==6||
                    $data_sigasi->personil->id_kesatuan==7||$data_sigasi->personil->id_kesatuan==8||$data_sigasi->personil->id_kesatuan==9||$data_sigasi->personil->id_kesatuan==10)
                    POLRES
                    @else
                    POLDA
                    @endif
                    Sedang Di Unduh
                    <iframe src="{{ asset('storage/public/surat/'.$data_sigasi->file_bukti_surat)}}" width="0"
                        height="0"></iframe>
                </h4>

            </center>
            @elseif($data_sigasi->extension_file_bukti_surat == "pdf")
            <iframe src="{{ asset('storage/public/surat/'.$data_sigasi->file_bukti_surat)}}" width="1000"
                height="650"></iframe>
            @else
            <img src="{{ asset('storage/public/surat/'.$data_sigasi->file_bukti_surat)}}" width="100%">
            @endif
            @endif
        </div>
        <div class="card-footer text-right">
        </div>
        </form>
    </div>
</div>
@endsection
