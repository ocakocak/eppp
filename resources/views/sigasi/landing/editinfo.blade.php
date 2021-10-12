@extends('layouts.backendadmin')

@section('content')
    <div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
        <div class="card-body p-0">
            <div class="card-body">
                @csrf
                <h2 class="text-center">{{ $judul }}</h2>
                <hr>
                <form action="{{ route('updateinfo', $info->id_info) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col mx-auto">
                        <input type="hidden" id="id_info" name="id_info" value="{{ $info->id_info }}" class="form-control"></input>
                        <div class="form-group col-md-8 mx-auto">
                            <label>Judul Informasi</label>
                            <input type="text" id="judul" value="{{ $info->judul }}" name="judul" class="form-control"></input>
                        </div>
                        <div class="form-group col-md-8 mx-auto">
                            <label>Isi Informasi</label>
                            <textarea id="info" rows="3" value="{{ $info->informasi }}" name="informasi" class="form-control">{{ $info->informasi }}</textarea>
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