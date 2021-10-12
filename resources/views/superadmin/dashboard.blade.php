@extends('layouts.backendadmin')

@section('content')
<div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
    <div class="card-body p-0">
        <div class="card-body">
            @csrf
            <p class="text-center">@if(auth()->user()->id_aktor==1)
                <h4 class="text-center" style="color:black">Selamat datang, Super Admin!</h4>
                @elseif(auth()->user()->id_aktor==2)
                <h4 class="text-center" style="color:black">Selamat datang, Admin!</h4>
                @elseif(auth()->user()->id_aktor==3)
                <h4 class="text-center" style="color:black">Selamat datang, User!</h4>
                @elseif(auth()->user()->id_aktor==4)
                <h4 class="text-center" style="color:black">Selamat datang, Admin Info!</h4>
                @endif</p>
            <hr>

            <div class="col ml-3">
                <div class="row">
                    <div class="card shadow h-100 py-2" style="background-color:#8a040c;color:white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a style="color:white" href="{{ route('datapersonil') }}" class="stretched-link"
                                            style="color: rgb(105, 5, 0);">Jumlah Personel Terdata</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $data_personil }} Personel
                                    </div>
                                </div>
                                <div class="col-auto ml-3">
                                    <i class="fas fa-file-alt fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow h-100 py-2 ml-3" style="background-color:#ac050f;color:white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a style="color:white" href="{{ route('datasigasiprestasi') }}" class="stretched-link"
                                            style="color: #6e0d25;">Jumlah Prestasi Terdata</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $data_prestasi }} Prestasi
                                    </div>
                                </div>
                                <div class="col-auto ml-3">
                                    <i class="fas fa-file-alt fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow h-100 py-2 ml-3" style="background-color:#c10612;color:white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a style="color:white" href="{{ route('datasigasipenghargaan') }}"
                                            class="stretched-link" style="color: #6a381f;">Jumlah Penghargaan
                                            Terdata</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $data_penghargaan }}
                                        Penghargaan</div>
                                </div>
                                <div class="col-auto ml-3">
                                    <i class="fas fa-file-alt fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <img src='salam.png' class="mx-auto" style="width: 500px;">
    <br>
</div>


@endsection
