@extends('layouts.backendadmin')

@section('content')
    <div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
        <div class="card-body p-0">
            <div class="card-body">
                @csrf
                <h2 class="text-center">{{ $judul }}</h2>
                <hr>
                <form action="{{ route('updateberita', $berita->id_berita) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col mx-auto">
                        <input type="hidden" id="id_berita" name="id_berita" value="{{ $berita->id_berita }}" class="form-control"></input>
                        <div class="form-group col-md-8 mx-auto">
                            <label>Judul Berita</label>
                            <input type="text" id="judul" value="{{ $berita->judul }}" name="judul" class="form-control"></input>
                        </div>
                        <div class="form-group col-md-8 mx-auto">
                            <label>Isi Berita</label>
                            <textarea id="isi" rows="3" value="{{ $berita->isi }}" name="isi" class="form-control">{{ $berita->isi }}</textarea>
                        </div>
                        <div class="mx-auto" style="text-align: center;">
                            <button class="btn btn-polda mx-auto" style="color: white;" type="submit">Edit Informasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection