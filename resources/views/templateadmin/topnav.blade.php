<form class="form-inline mr-auto" action="">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <img src="{{ asset('storage/public/filebuktiprestasi/logo presisi.png')}}" alt="logo" width="300">
</form>
<ul class="navbar-nav navbar-right">
<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
<img alt="image" src="{{ asset("assets/img/avatar/avatar-1.png")}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"> {{auth()->user()->username}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">kelola akun anda<div>
              <div class="dropdown-divider"></div>
              <a href="{{route('edituser',auth()->user()->id)}}" class="dropdown-item has-icon text-primary"><i class="fas fa-edit"></i>
                Edit Profil
              </a>
              <div class="dropdown-divider"></div>
                <a href="{{route('logout')}}"class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
</a>
            </div>
          </li>
</ul>
