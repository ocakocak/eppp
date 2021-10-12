<html>

<head>
    <title>Cetak Data Prestasi </title>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('templateuser/assets/img/logofixspi.png')}}" rel="icon">
    <link href="{{asset('templateuser/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('templateuser/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('templateuser/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('templateuser/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('templateuser/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('templateuser/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('templateuser/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('templateuser/assets/css/style.css')}}" rel="stylesheet">
    {{-- <style>
        #halaman{
            width: auto; 
            height: auto; 
            position: absolute; 
            border: 4px solid; 
            padding-top: 30px; 
            padding-left: 30px; 
            padding-right: 30px; 
            padding-bottom: 80px;
            border-color: rgb(117, 177, 218)
        }
        .border3{
            border-style:dashed;
            border-color:#cc59f9;
            border-width:thick;
        }
    </style> --}}

</head>

<body>
    <div id=halaman>
        <p align="center">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr style="width:1000px">
                            <th style="width:5px">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" onClick="toggle(this)">
                                </div>
                            </th>
                            <th style="width:5px">
                                No
                            </th>
                            <th style="width:150px">Nama</th>
                            <th style="width:150px">Pangkat/NRP/NIP</th>
                            <th style="width:150px">Jabatan/Kesatuan</th>
                            <th style="width:200px">Prestasi</th>
                            <th style="width:690px">Uraian Kronologis Prestasi</th>
                            <th style="width:100px">Evidence</th>
                            <!-- <th style="width:100px">Status</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                        @if ($data_sigasi != null)
                        @foreach ($data_sigasi as $dg)
                        <tr style="width:100px">
                            <td style="width:5px" class="align-top"><br>
                                <center>
                                    <form method="get" action="{{route('hapusceksigasi',$dg->id_sigasi)}}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="idsigasi[]"
                                            class="checkBoxClass" value="{{$dg->id_sigasi}}">
                                </center>
                            </td>
                            <td class="align-top" style="width:5px"><br>
                                <p style="font-weight:bold">{{ $loop->iteration }}</p>
                            </td>
                            <td style="width:150px" class="align-top text-justify"><br>
                                {{ $dg->personil->nama }} </td>
                            <td style="width:150px" class="align-top text-justify"><br>
                                {{ $dg->personil->pangkat->pangkats }} / {{ $dg->personil->nrpnip }}</td>
                            <td style="width:150px" class="align-top text-justify"><br>
                                {{ $dg->personil->jabatan }} / {{ $dg->personil->kesatuan->kesatuans }}
                            </td>
                            <td style="width:100px" class="align-top text-justify" style="font-weight:bold">
                                <br>{{ $dg->nama_prestasi}}</td>
                            <td style="width:100px" class="align-top text-justify"><br>{{ $dg->deskripsi}}<br><br></td>
                            <td style="width:100px" class="align-top " style="font-weight:bold"><br>
                                <a style="color:white" href="{{ route('lihatbuktisigasi', $dg->id_sigasi) }}"
                                    class="btn btn-polda" style="color:white btn-action mr-1" data-toggle="tooltip"
                                    title=""><i class="fas fa-eye"></i></a></td>
                            <!-- <td class="align-top">
                                @if($dg->status_tindakan=='Belum Ditindak')
                                <br><a style="color:white"href="{{ route('tindaksigasi', $dg->id_sigasi) }}"class="btn btn-polda style="color:white btn-action mr-1" data-toggle="tooltip" title="" >Tindak Sekarang</a>  
                                @else
                                <br><a href="{{ route('tindaksigasi', $dg->id_sigasi) }}"class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="" data-original-title="Edit">Batal Tindak</a>  
                                @endif
                            </td> -->
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row col-md-12">

                    <div class="col-md-3" align="left">
                        <h4><button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Hapus Data Terpilih
                            </button></h4>
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
    <script src="{{ asset('temp/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('temp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('temp/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('temp/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('temp/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('temp/assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('temp/assets/js/demo/chart-pie-demo.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        window.print()

    </script>
</body>

</html>
