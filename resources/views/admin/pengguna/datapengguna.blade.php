@extends('layouts.backendadmin')

@section('content')
<div class="card card-primary">
    <br>
    <h4 style="color:#6a381f;text-align:center">Data User</h4>
    <hr>
    <div class="col-md-9" align="left">
        <a href="{{ route('tambahpengguna') }}" class="btn btn-polda" style="color:white;"><i
                class="fas fa-user-plus"></i>
            Tambah User
        </a></div><br>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr style="width:100px">
                        <th style="width:5px">No</th>
                        <th style="width:100px">Satker</th>
                        <th style="width:100px">Kesatuan</th>
                        <th style="width:100px">Username</th>
                        <th style="width:200px"></th>
                    </tr>
                    @if ($data_pengguna != null)
                    @foreach ($data_pengguna as $key => $item)
                    <tr id="jpid{{$item->id}}" style="width:100px">

                        <td class="align-top" style="width:5px"><br>{{$loop->iteration}}</td>
                        </td>
                        <td class="align-top" style="width:100px"><br>
                        @if($item->id_satker !== null)
                        {{ $item->satker->satkers }}
                        @endif
                        </td>
                        <td class="align-top" style="width:100px"><br>{{ $item->kesatuan->kesatuans }}</td>
                        <td class="align-top" style="width:100px"><br>{{ $item->username }}<br></td>
                        <td class="align-top" style="width:150px">
                            <br><a style="color:white" href="{{ route('editpengguna', $item->id) }}"
                                class="btn btn-polda style=" color:white;"btn-action mr-1" data-toggle="tooltip"
                                title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i> </a>
                            <a href="{{ route('hapuspengguna', $item->id) }}"
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

<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('idpengguna[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

</script>
@endsection
