@extends('layouts.backendadmin')

@section('content')
    <div class="card" style="border-top-width: 0.2cm; border-top-color: #6a381f">
        <div class="card-body p-0">
            <div class="card-body">
                @csrf
                <h2 class="text-center">{{ $judul }}</h2>
                <hr>
                <p style="text-align: center;font-family:Koh Santepheap; font-size:25px;color:#9d0208; font-weight:bold">Data Informasi</p>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tbody>
                            <tr style="width:100px">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Judul</th>
                                <th rowspan="2">Isi</th>
                                <th colspan="2" style="text-align: center;">Aksi</th>
                            </tr>
                            <tr>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                            @if ($info != null)
                            @foreach ($info as $p)
                            <tr>
                                <td class="text-center"> {{$loop->iteration}} </td>
                                <td>{{ $p->judul }}</td>
                                <td style="text-align:justify">
                                    {!! $p->informasi !!}
                                </td>
                                <td>
                                    <a href="{{ route('editinfo', $p->id_info) }}">
                                        <button class="btn btn-polda mx-auto" style="color: white;"><i class="fas fa-edit"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('hapusinfo', $p->id_info) }}">
                                        <button class="btn btn-danger mx-auto" onclick="return confirm('Yakin ingin menghapus informasi?');"><i class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <p style="text-align: center;font-family:Koh Santepheap; font-size:25px;color:#9d0208; font-weight:bold">Tambah Informasi</p>
                <form action="{{ route('tambahinfo') }}" method="post">
                    @csrf
                    <div class="col mx-auto">
                        <div class="form-group col-md-8 mx-auto">
                            <label>Judul Informasi</label>
                            <input type="text" id="judul" name="judul" class="form-control"></input>
                        </div>
                        <div class="form-group col-md-8 mx-auto">
                            <label>Isi Informasi</label>
                            <textarea id="info" rows="3" name="info" class="form-control"></textarea>
                        </div>
                        <div class="mx-auto" style="text-align: center;">
                            <button class="btn btn-polda mx-auto" style="color: white;" type="submit">Tambah Informasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection