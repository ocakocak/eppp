@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <br>
    <h4 style="color:#6a381f;text-align:center">Data Personel</h4>
    <hr>
    <div class="card-body p-0">
        <div class="row col-md-12">
            <div class="col-md-9" align="left">
                <a href="{{ route('tambahpersonil') }}" class="btn btn-polda" style="color:white;"><i
                        class="fas fa-user-plus"></i>
                    Tambah Personel
                </a></div>
            <div class="col-md-3" align="right">
                @if(auth()->user()->id_aktor==1)

                <!-- <form action="{{ route('caripersonil') }}" method="get">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control" placeholder="Cari personil">
                    <div class="input-group-btn">
                        <button type="submit"class="btn btn-polda"style="color:white"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form><br> -->
                @else
                <br><br><br>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            @csrf
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr style="width:100px">
                            <!-- <th style="width:15px">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" onClick="toggle(this)">
                                    </div>
                                </th> -->
                            <th style="text-align:center">No</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>NRP/NIP</th>
                            <th>Jabatan</th>
                            <th>Kesatuan</th>
                            <th></th>
                        </tr>
                        @if ($data_personil != null)
                        @foreach ($data_personil as $pers)
                        <tr>
                            <td class="text-center"> {{$loop->iteration}} </td>
                            <td>{{ $pers->nama }}</td>
                            <td>{{ $pers->pangkat->pangkats }}</td>
                            <td>{{ $pers->nrpnip }}</td>
                            <td>{{ $pers->jabatan }}</td>
                            <td>{{ $pers->kesatuan->kesatuans }}</td>
                            <td class="align-top" style="width:150px">
                                <br><a style="color:white" href="{{ route('editpersonil', $pers->id_personil) }}"
                                    class="btn btn-polda style=" color:white;"btn-action mr-1" data-toggle="tooltip"
                                    title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i> </a>
                                @if(auth()->user()->id_aktor==1)
                                <a href="{{ route('hapuspersonil', $pers->id_personil) }}"
                                    class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                    title=""><i class="fas fa-trash"></i> </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row col-md-12">


                </div><br>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('idpersonil[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

</script>
@endsection
