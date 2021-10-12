@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <br>
    <h4 style="color:#6a381f;text-align:center">Data Admin</h4>
    <hr>
    <div class="card-body p-0">
        <div class="row col-md-12">
            <div class="col-md-9" align="left">
                <a href="{{ route('tambahadmin') }}" class="btn btn-polda" style="color:white;"><i
                        class="fas fa-user-plus"></i>
                    Tambah Admin
                </a></div>
            <div class="col-md-3" align="right">

                <!-- <form action="{{ route('cariadmin') }}" method="get">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control" placeholder="Cari admin">
                    <div class="input-group-btn">
                        <button type="submit"class="btn btn-polda"style="color:white"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->
                <br>
                <br>
                <br>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr style="width:100px">
                            <th style="width:5px">No</th>
                            <th style="width:100px">Kesatuan</th>
                            <th style="width:100px">Username</th>
                            <th style="width:200px"></th>
                        </tr>
                        @if ($data_admin != null)
                        @foreach ($data_admin as $key => $item)
                        <td class="align-top" style="width:5px"><br>{{$loop->iteration}}</td>
                        <td class="align-top" style="width:100px"><br>{{ $item->kesatuan->kesatuans }}</td>
                        <td class="align-top" style="width:100px"><br>{{ $item->username }}<br></td>
                        <td class="align-top" style="width:150px">
                            <br><a style="color:white" href="{{ route('editadmin', $item->id) }}"
                                class="btn btn-polda style=" color:white;"btn-action mr-1" data-toggle="tooltip"
                                title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i> </a>
                            <a href="{{ route('hapusadmin', $item->id) }}"
                                class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                title=""><i class="fas fa-trash"></i> </a>
                        </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row col-md-12">

                    <div class="col-md-3" align="left">
                    </div>
                </div><br>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@endsection
