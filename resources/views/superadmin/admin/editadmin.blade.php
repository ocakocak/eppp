@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 style="color:#6a381f">Formulir Ubah admin</h4>
    </div>
    <div class="card-body p-0">
        <form action="{{ route('updateadmin',$data_admin->id) }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="col-md-4 form-group">
                            <label>Username</label>
                            <input value="{{$data_admin->username}}" type="text" name="username" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Kesatuan</label>
                            <div class="row ml-1" style="height:40px">
                                <select class="select" id="id_kesatuan" name="id_kesatuan">
                                    <div>
                                        @if ($data_kesatuan != null)
                                        @foreach ($data_kesatuan as $djs)

                                        <option value="{{$djs->id_kesatuan}}">{{$djs->kesatuans}}</option>
                                        @endforeach
                                        @endif
                                    </div>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-polda mr-1" style="color:white" type="submit"><i
                        class="fas fa-save"></i></button>
                <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button>
            </div>
        </form>
    </div>
    <hr style="background-color:red">
    <div class="card-header">
        <h4 style="color:#6a381f">Formulir Ubah Password</h4>
    </div>
    <div class="card-body p-0">
        <form action="{{ route('updatepasswordadmin', $data_admin->id) }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('patch')
                <div class="row">
                    <!-- <center>
                    <img style="width:150px;float:center;"src="../assets/img/avatar/avatar-1.png" class="rounded-circle"><br>
</center> -->
                    <div class="col-md-12 row">

                        <input type="hidden" value="{{$data_admin->username}}" name="username" class="form-control">
                        <div class="col-md-4 form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasipassword" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-polda mr-1" style="color:white" type="submit"><i
                        class="fas fa-save"></i></button>
                <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
