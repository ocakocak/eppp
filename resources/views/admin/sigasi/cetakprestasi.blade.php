<html>

<head>
    <title>Rekap Data Prestasi Personel</title>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sahabat Profesional Indonesia</title>
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
    <style>
        .container {
            /* Used to position the watermark */
            position: center;
        }

        .container__wrapper {
            /* Center the content */
            align-items: center;
            display: flex;
            justify-content: center;

            /* Absolute position */
            left: 0px;
            position: absolute;
            top: 0px;

            /* Take full size */
            height: 100%;
            width: 100%;
        }

        .container__watermark {
            /* Text color */
            color: rgba(0, 0, 0, 0.2);

            /* Text styles */
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;

            /* Rotate the text */

            /* Disable the selection */
            user-select: none;
        }

    </style>
    <style>
        body {
            font-family: Arial;
            font-size: 12px
        }

    </style>
    <style type="text/css">
        .page {}

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .contoh1 {
            font-size: 16px;
        }

        .inden {
            text-indent: 100px;
        }

        .inden2 {
            text-indent: 105px;
        }

        .inden3 {
            text-indent: 150px;
        }

        .line-title {
            border-style: inset;
            border-top: 1px solid #000;
        }

    </style>
</head>

<body>
    <div class="page">
        <div class="page-title">
            <div class="title_left mx-auto" style="width:25%; text-align:center">
                KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>DAERAH BENGKULU<br>
            </div>
        </div>
        <div class="container">
            <!-- Watermark container -->
            <div class="container__wrapper">
                <!-- The watermark -->
                <div class="container__watermark">
                    <img src="{{ asset('assets/img/sdmpolri.png')}}" style="opacity:20%" alt="">
                </div>
            </div>
            <center>
                <h3>Rekap Data Prestasi Personel</h3>
            </center>

            <table border="1">
                <tr>
                    <th style="width:5px">
                        No
                    </th>
                    <th style="width:50px">Tanggal Input</th>
                    <th style="width:150px">Nama</th>
                    <th style="width:150px">Pangkat</th>
                    <th style="width:150px">NRP/NIP</th>
                    <th style="width:150px">Jabatan</th>
                    <th style="width:150px">Kesatuan</th>
                    <th style="width:300px">Uraian Prestasi</th>
                    <!-- <th style="width:600px">Uraian Kronologis Prestasi</th> -->
                    <th style="width:300px">Keterangan</th>
                </tr>
                @if ($data_sigasi != null)
                @foreach ($data_sigasi as $dg)
                <tr style="width:1000px">
                    <td style="width:30px" valign="top">
                        <p>{{ $loop->iteration }}</p>
                    </td>
                    <td style="width:50px" class="align-top text-justify"><br>{{ date('d-m-Y', strtotime($dg->tanggal_input)) }} </td>
                    <td style="width:150px;text-align:justify" valign="top">{{ $dg->personil->nama }} </td>
                    <td style="width:150px;text-align:justify" valign="top">{{ $dg->personil->pangkat->pangkats }}</td>
                    <td style="width:150px;text-align:justify" valign="top">{{ $dg->personil->nrpnip }}</td>
                    <td style="width:150px;text-align:justify" valign="top">{{ $dg->personil->jabatan }}</td>
                    <td style="width:150px;text-align:justify" valign="top">{{ $dg->personil->kesatuan->kesatuans }}
                    </td>
                    <td style="width:300px;text-align:justify" valign="top">{{ $dg->nama_prestasi}}</td>
                    <!-- <td style="width:600px;text-align:justify"valign="top">{!! $dg->deskripsi !!}</td> -->
                    <td style="width:300px;text-align:justify" valign="top">
                        @if($dg->keterangan == 0)
                        Belum Ditindak Lanjuti
                        @elseif($dg->keterangan == 1)
                        Sudah Ditindak Lanjuti ke POLRES
                        @elseif($dg->keterangan == 2)
                        Sudah Ditindak Lanjuti ke POLDA
                        @endif
                    </td>
                    <!-- <td >
                                @if($dg->status_tindakan=='Belum Ditindak')
                                <br><a style="color:white"href="{{ route('tindaksigasi', $dg->id_sigasi) }}"class="btn btn-polda style="color:white btn-action mr-1" data-toggle="tooltip" title="" >Tindak Sekarang</a>  
                                @else
                                <br><a href="{{ route('tindaksigasi', $dg->id_sigasi) }}"class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="" data-original-title="Edit">Batal Tindak</a>  
                                @endif
                            </td> -->
                </tr>
                @endforeach
                @endif
        </div>
        </table>
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
