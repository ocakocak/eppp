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
                @elseif(auth()->user()->id_aktor==3)
                Selamat datang, User!
                @elseif(auth()->user()->id_aktor==4)
                Selamat datang, Admin Info!
                @endif
        </p>
                <hr>

                    <div class="row col-md-12">
                            <div class="col-md-1"></div>
                            <div class="col-md-5 card shadow h-100 py-2"style="background-color:#8a040c;color:white">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                <a href="{{ route('info') }}" class="stretched-link" style="color: white;">Olah Data Informasi</a>
                                            </div>
                                        </div>
                                        <div class="col-auto ml-3">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 card shadow h-100 py-2 ml-3"style="background-color:#ac050f;color:white">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                <a href="{{ route('berita') }}" class="stretched-link" style="color: white;">Olah Data Berita</a>
                                            </div>
                                        </div>
                                        <div class="col-auto ml-3">
                                            <i class="far fa-newspaper"></i>
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