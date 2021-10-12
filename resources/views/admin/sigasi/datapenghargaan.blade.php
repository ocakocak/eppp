@extends('layouts.backendadmin')

@section('content')
<div class="row col-md-12">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('filtersigasi') }}" method="post">
                    @csrf
                    <h6 style="color:#6a381f;">Cari Berdasarkan</h6><br>
                    @if(auth()->user()->id_aktor == 1)
                    <div class="form-group">
                        <label>Pilih Sakter/Satwil</label>
                        <select class="form-control" name="id_kesatuan">
                            <option></option>
                            @if ($data_kesatuan != null)
                            @foreach ($data_kesatuan as $dk)
                            <option value="{{$dk->id_kesatuan}}">{{$dk->kesatuans}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Pilih Pangkat</label>
                        <select class="form-control" name="id_pangkat">
                            <option></option>
                            @if ($data_pangkat != null)
                            @foreach ($data_pangkat as $dp)
                            <option value="{{$dp->id_pangkat}}">{{$dp->pangkats}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="dari2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Dari
                                </div>
                            </div>
                            <input name="from_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="sampai2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Sampai
                                </div>
                            </div>
                            <input name="to_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                            <input type="text" class="form-control daterange-cus" name="namapersonil">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>NRP/NIP</label>
                        <div class="input-group">
                            <input type="text" class="form-control daterange-cus" name="nrpnip">
                        </div>
                    </div>
                    @if(auth()->user()->id_aktor == 1 || auth()->user()->id_aktor == 2)
                    <div class="form-group">
                        <select class="form-control" id="mySelect" name="jenpeng" required>
                            <option value="" style="color: grey;" disabled selected>
                                                                    -Pilih Jenis Penghargaan-</option>
                                                                <option onselect="sel()" value="Seluruh Data">Seluruh Data</option>
                                                                <option onselect="pol()" value="Polri">Penghargaan dari
                                                                    Polri</option>
                                                                <option onselect="npol()" value="Non Polri">Penghargaan
                                                                    dari Badan/Instansi Luar Polri</option>
                        </select>
                    </div>
                    <div class="form-group">
                                                            <div id="seldat">
                                                                <input id="data" name="data" type="hidden"
                                                                    class="form-control" value="1">
                                                            </div>
                                                            <div id="pol">
                                                                <!--<label>Tingkat Penghargaan</label>-->
                                                                <!--<select class="form-control" id="tingkat"-->
                                                                <!--    name="tingkat">-->
                                                                <!--    <option value="" style="color: grey;" disabled-->
                                                                <!--        selected>-Pilih Tingkat Penghargaan-</option>-->
                                                                <!--    <option value="Tingkat Polres">Tingkat Polres-->
                                                                <!--    </option>-->
                                                                <!--    <option value="Tingkat Polda">Tingkat Polda</option>-->
                                                                <!--    <option value="Tingkat Mabes">Tingkat Mabes</option>-->
                                                                <!--</select>-->
                                                                <label>Jenis Penghargaan</label>
                                                                <select class="form-control" id="jenis_penghargaan"
                                                                    name="jenis_penghargaan">
                                                                    <option value="" style="color: grey;" disabled
                                                                        selected>-Pilih Jenis Penghargaan-</option>
                                                                    <option value="KPLB">KPLB
                                                                    </option>
                                                                    <option value="KPLBA">KPLBA</option>
                                                                    <option value="Promosi Mengikuti Pendidikan">Promosi Mengikuti Pendidikan</option>
                                                                    <option value="Promosi Jabatan">Promosi Jabatan</option>
                                                                    <option value="Tanda Penghargaan">Tanda Penghargaan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                    @endif
                    <br>
                    <div class="col-md-12">
                    <button value="submit3" type="submit" name="submit" class="btn btn-polda col-md-12"
                        style="color:white;float:left"><i class="fas fa-search"></i> Cari</button>
                    </div>
                    @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==2)
                    <br>
                    <br>
                    <div class="col-md-12">
                    <button value="submit1" type="submit" name="submit" class="btn btn-success col-md-12"
                        style="color:white;float:left"><i class="far fa-file-excel"></i> Excel</button>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                    <button value="submit2" type="submit" name="submit" class="btn btn-polda col-md-12"
                        style="color:white;float:left"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                    @endif
                    </div>
            </form>
        </div>
    </div>
    <div class="col-md-9 card card-primary">
        <div class="card-body p-0">
            <div class="row col-md-12">
                <div class="col-md-12" align="center">
                    <h4 style="color:#6a381f;text-align:center"><br>Data Penghargaan Personel</h4>
                </div>
            </div>
            <hr>

            <div class="card-body p-0">
                <!-- <iframe src="{{ asset('storage/filebuktipenghargaan/pdf.pdf')}}" width="1280" height="720"></iframe> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr style="width:1000px">
                                <th style="width:5px">
                                    No
                                </th>
                                <th style="width:50px">Tanggal Input</th>
                                <th style="width:100px">Nama</th>
                                <th style="width:100px">Pangkat</th>
                                <th style="width:100px">NRP/NIP</th>
                                <th style="width:100px">Jabatan</th>
                                <th style="width:100px">Kesatuan</th>
                                <th style="width:100px">Penghargaan</th>
                                <th style="width:300px">Pemberi Penghargaan</th>
                                <th style="width:240px">Keterangan Penghargaan</th>
                                <th style="width:50px">Evidence</th>
                                <th></th>
                                <!-- <th style="width:100px">Status</th> -->
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php $no = 1; ?>
                            @if ($data_sigasi != null)
                            @foreach ($data_sigasi as $dg)
                            @if ($dg->jenis_penghargaan != null)
                            <tr style="width:100px">
                                <td class="align-top" style="width:5px"><br>
                                    {{ $no++ }}
                                </td>
                                <td style="width:50px" class="align-top text-justify"><br>
                                    {{ date('d-m-Y', strtotime($dg->tanggal_input)) }} </td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    {{ $dg->personil->nama }} </td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    {{ $dg->personil->pangkat->pangkats }}</td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    {{ $dg->personil->nrpnip }}</td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    {{ $dg->personil->jabatan }}
                                </td>
                                <td style="width:100px" class="align-top text-justify"><br>
                                    {{ $dg->personil->kesatuan->kesatuans }}
                                </td>
                                <td style="width:100px" class="align-top"><br>{{ $dg->jenis_penghargaan }}

                                </td>
                                <td style="width:300px" class="align-top" style="font-weight:bold"><br>{{ $dg->sumber}}
                                </td>
                                <td style="width:240px" class="align-top" style="font-weight:bold"><br>
                                {{ $dg->keterangan_penghargaan}}
                                </td>
                                <td style="width:100px" class="align-top " style="font-weight:bold"><br>
                                    <center>
                                        @if(auth()->user()->id_aktor==1 || auth()->user()->id_aktor==2 ||
                                        auth()->user()->id_aktor==3)
                                        <button data-toggle="modal" data-target="#tambahBukti{{$dg->id_sigasi}}"
                                            style="color: white;" class="btn btn-polda">
                                            <i class="far fa-eye"></i></button>
                                        <div class="modal fade" width="60" id="tambahBukti{{$dg->id_sigasi}}"
                                            tabindex="-1" aria-labelledby="tambahBukti{{$dg->id_sigasi}}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl mx-auto">
                                                <!-- <div class="card mx-auto pt-3 pl-3" style="width: 40rem;"> -->
                                                <div class="modal-content mx-auto">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahBukti{{$dg->id_sigasi}}Label">
                                                            Tambah Bukti Penghargaan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('tambahbuktipenghargaan')}}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input name="id_sigasi" id="id_sigasi" type="hidden"
                                                                class="form-control" value="{{ $dg->id_sigasi }}">
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label style="font-size: 15px;">Nama Penghargaan</label>
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $dg->nama_penghargaan }}">
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3">
                                                                <label class="col-sm-3"
                                                                    style="float:left;font-size: 15px;">File
                                                                    Bukti</label>
                                                                <?php $databukti=App\Models\BuktiPenghargaan::where('id_sigasi',$dg->id_sigasi)->get(); ?>
                                                                @foreach($databukti as $databukti)
                                                                <a class="col-sm-10" style="color:black"
                                                                    href="{{ route('lihatbuktisigasi2', $databukti->id_bukti_penghargaan) }}">{{$databukti->file_bukti_penghargaan}}</a>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-download"></i>
                                                                </div>
                                                                <hr>
                                                                @endforeach
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3">

                                                                <label style="font-size: 15px;">Tambah File Bukti
                                                                    Penghargaan</label>
                                                                <input name="file_bukti_penghargaan[]" type="file"
                                                                    class="form-control" multiple="true">
                                                            </div>
                                                            <div class="form-group row mr-3 ml-3 float-right">
                                                                <button class="btn btn-polda mr-1" style="color: white;"
                                                                    type="submit">Tambah File</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </center>
                                </td>
                                <td class="align-top">
                                    @if(auth()->user()->id_aktor==1)
                                    <br><a href="{{ route('hapussigasipenghargaan', $dg->id_sigasi) }}"
                                        class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                        title=""><i class="fas fa-trash"></i> </a>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="pilihCetak" tabindex="-1" aria-labelledby="pilihCetakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pilihCetakLabel">Cetak Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cetakpenghargaan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mr-3 ml-3">
                        <select class="form-control" id="mySelect2" name="data" required>
                            <option disabled selected>--Pilih Data Yang Akan Dicetak--</option>
                            <option value="1">Seluruh Data</option>
                            <option value="2">Seluruh Data Berdasarkan Tanggal</option>
                            <option value="3">Seluruh Data yang Telah Diajukan</option>
                            <option onselect="ajutgl()" value="4">Seluruh Data yang Telah Diajukan Berdasarkan Tanggal
                            </option>
                            <option value="5">Seluruh Data yang Belum Diajukan</option>
                            <option onselect="blmajutgl()" value="6">Seluruh Data yang Belum Diajukan Berdasarkan
                                Tanggal</option>
                        </select>
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <div class="input-group" id="dari">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Dari
                                </div>
                            </div>
                            <input name="from_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <div class="input-group" id="sampai">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Sampai
                                </div>
                            </div>
                            <input name="to_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <button class="btn btn-danger" style="float:right;" type="reset"><i
                            class="fas fa-eraser"></i></button>
                    <button class="btn btn-polda mr-1" style="float:right;color: white;" type="submit"><i
                            class="fas fa-save"></i></button>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="pilihExport" tabindex="-1" aria-labelledby="pilihExportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pilihExportLabel">Export Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exportpenghargaan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mr-3 ml-3">
                        <select class="form-control" id="datapilih" name="data" required>
                            <option disabled selected>--Pilih Data Yang Akan Dicetak--</option>
                            <option value="1">Seluruh Data</option>
                            <option value="2">Seluruh Data Berdasarkan Tanggal</option>
                            <option value="3">Seluruh Data yang Telah Diajukan</option>
                            <option onselect="ajutgl()" value="4">Seluruh Data yang Telah Diajukan Berdasarkan Tanggal
                            </option>
                            <option value="5">Seluruh Data yang Belum Diajukan</option>
                            <option onselect="blmajutgl()" value="6">Seluruh Data yang Belum Diajukan Berdasarkan
                                Tanggal</option>
                        </select>
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <div class="input-group" id="dari2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Dari
                                </div>
                            </div>
                            <input name="from_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <div class="form-group row mr-3 ml-3">
                        <div class="input-group" id="sampai2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Sampai
                                </div>
                            </div>
                            <input name="to_date" type="date" class="form-control daterange-cus">
                        </div>
                    </div>
                    <button class="btn btn-danger" style="float:right;" type="reset"><i
                            class="fas fa-eraser"></i></button>
                    <button class="btn btn-polda mr-1" style="float:right;color: white;" type="submit"><i
                            class="fas fa-save"></i></button>

                </form>
            </div>

        </div>
    </div>

    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('idsigasi[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

    </script>
    @endsection
