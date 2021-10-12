<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
    <img style="margin-top: 15px;"src="{{ asset('storage/public/filebuktiprestasi/logoeppp.png')}}" alt="logo" width="120" >
</div>
    <ul class="sidebar-menu">
        <br>
        <br>
        @if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2||auth()->user()->id_aktor==3)
        <li class="menu-header" style="color:black;font-weight:bold"><span>Halaman Utama</span></li>
        <li><a class="nav-link mb-1" style="background-color:#00001A;color:white" href="{{route('dashboardadmin')}}"><i class="fas fa-tachometer-alt"></i><span style="font-size:10pt">Halaman Utama</span></a>
        <li><a class="nav-link mb-1" style="background-color:#000033;color:white"href="{{route('jenissyarat')}}"><i class="fas fa-users"></i><span style="font-size:10pt">Jenis dan Syarat Penghargaan</span></a>
        <li class="menu-header" style="color:black;font-weight:bold">Pengolahan Data</li>
        @endif
        @if(auth()->user()->id_aktor==1)
        <li><a class="nav-link mb-1" style="background-color:#001A4D;color:white"href="{{route('dataadmin')}}"><i class="fas fa-users"></i><span style="font-size:10pt">Data Admin</span></a>
        @endif
        @if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2)
        <li><a class="nav-link mb-1" style="background-color:#001A4D;color:white"href="{{route('datapengguna')}}"><i class="fas fa-users"></i><span style="font-size:10pt">User</span></a>
        @endif
        @if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==3)
        <li><a class="nav-link mb-1" style="background-color:#003366;color:white"href="{{route('datapersonil')}}"><i class="fas fa-user-alt"></i><span style="font-size:10pt">Data Personel</span></a>
        <li><a class="nav-link mb-1" style="background-color:#004D80;color:white"href="{{route('tambahsigasi')}}"><i class="fas fa-file-medical"></i><span style="font-size:10pt">Tambah Data</span></a>
        @endif
        @if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2||auth()->user()->id_aktor==3)
        <li><a class="nav-link mb-1" style="background-color:#006699;color:white"href="{{route('datasigasiprestasi')}}"><i class="fas fa-medal"></i><span style="font-size:10pt">Data Prestasi</span></a>
        <li><a class="nav-link mb-1"style="background-color:#0080B3;color:white" href="{{route('datasigasipenghargaan')}}"><i class="fas fa-trophy"></i><span style="font-size:10pt">Data Penghargaan</span></a>
        @endif
        @if(auth()->user()->id_aktor==4)
        <li class="menu-header" style="color:black;font-weight:bold"><span>Halaman Utama</span></li>
        <li><a class="nav-link" style="background-color:black;color:white" href="{{route('depan')}}"><i class="fas fa-tachometer-alt"></i><span style="font-size:10pt">Halaman Utama</span></a>
        <li class="menu-header" style="color:black;font-weight:bold">Pengolahan Data</li>
        <li><a class="nav-link" style="background-color:#006699;color:white"href="{{route('info')}}"><i class="fas fa-info-circle"></i><span>Informasi</span></a>
        <li><a class="nav-link" style="background-color:#0080B3;color:white"href="{{route('berita')}}"><i class="far fa-newspaper"></i><span>Berita</span></a>
        @endif
    </ul>
</aside>
