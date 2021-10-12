<!DOCTYPE html>
<html>

<head>
    <title>Rekap Data Prestasi Personel</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: serif;
            font-size: 12px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            position: relative;
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
            text-align: top;
        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }

    </style>

    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Rekap Data Prestasi Personel.xls");
	?>

    <center>
        <h1>Rekap Data Prestasi Personel</h1>
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
            <th style="width:200px">Uraian Prestasi</th>
            <th style="width:100px">Keterangan</th>
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
            <td style="width:200px;text-align:justify" valign="top">{{ $dg->nama_prestasi}}</td>
            <td style="width:100px;text-align:justify" valign="top">
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
    </table>
</body>

</html>
