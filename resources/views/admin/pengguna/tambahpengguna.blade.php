@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 style="color:#6a381f">Formulir Tambah User</h4>
    </div>
    <div class="card-body p-0">
        <form action="{{ route('tambahdatapengguna') }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="col-md-4 form-group">
                            <label>Satker</label>
                            <div class="row ml-1" style="height:40px">
                                <select class="select" id="id_satker" name="id_satker">
                                    <div>

                                        @if ($data_satker != null)
                                        @foreach ($data_satker as $djk)

                                        <option value="{{$djk->id_satker}}">{{$djk->satkers}}</option>
                                        @endforeach
                                        @endif
                                    </div>
                                </select>
                            </div>
                        </div>
                    </div>
                        @if(auth()->user()->id_aktor==1)
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
                    @endif
                    <div class="col-md-4 form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
    <div class="card-footer text-right">
        <button class="btn btn-polda mr-1" style="color:white" type="submit"><i class="fas fa-save"></i></button>
        <button class="btn btn-danger" type="reset"><i class="fas fa-eraser"></i></button>
    </div>
    </form>
</div>
</div>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
            Nauval Azhar</a>
    </div>

    <div class="footer-right">
        2.3.0
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>

<!-- Page Specific JS File -->
<script src="../assets/js/page/index.js"></script>
<!-- JS Properti -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {
        $('#jenis_penghargaan').summernote({
            height: '400'
        });
    });

</script>
</body>

</html>
@endsection
