@extends('layouts.backendadmin')

@section('content')
<!-- Main Content -->
<div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
    <div class="card-body p-0">
        <div class="card-body">
            @csrf
            <p style="color: #99582a; font-size:25px; font-weight:bold" class="text-center">
                @if(auth()->user()->id_aktor==1)
                Selamat datang, Super Admin!
                @elseif(auth()->user()->id_aktor==2)
                Selamat datang, Admin!
                @endif
            </p>
            <hr>

            <div class="col ml-3">
                <div class="row">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a href="" class="stretched-link" style="color: rgb(105, 5, 0);">Jumlah Personil
                                            Terdata</a>
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
                    <div class="card shadow h-100 py-2 ml-3">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a href="{{ route('datasigasiprestasi') }}" class="stretched-link"
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
                    <div class="card shadow h-100 py-2 ml-3">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <a href="{{ route('datasigasipenghargaan') }}" class="stretched-link"
                                            style="color: #6a381f;">Jumlah Penghargaan Terdata</a>
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




        @endsection
