<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use App\Models\Personil;
use App\Models\Sigasi;
use App\Models\Info;
use App\Models\Berita;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->id_aktor==1){
        $data_personil = count(Personil::all());
        $data_prestasi = count(Sigasi::all());
        $data_penghargaan = count(Sigasi::whereNotNull('jenis_penghargaan')->get());
        }elseif(auth()->user()->id_aktor==2){
            $data_personil = count(Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get());
        $data_prestasi = count(Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get());
        $data_penghargaan = count(Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->whereNotNull('jenis_penghargaan')->get());
        }elseif(auth()->user()->id_aktor==3){
            $data_personil = count(Personil::where('id_user',auth()->user()->id)->get());
        $data_prestasi = count(Sigasi::where('id_user',auth()->user()->id)->get());
        $data_penghargaan = count(Sigasi::where('id_user',auth()->user()->id)->whereNotNull('jenis_penghargaan')->get());
        }
        return view('superadmin.dashboard', compact("data_prestasi","data_penghargaan","data_personil"));  
    }
    public function jenissyarat()
    {
        return view('jenissyarat');  
    }
    public function updatepassword(Request $request)
    {
        $data_pangkat = Pangkat::all();
        $data_user = User::where('username',$request->username)->first();
        $data_user->update(['password'=>Hash::make($request->password)]);
        if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2||auth()->user()->id_aktor==4){
            $data_kesatuan = Kesatuan::all();
            }else{
                $data_kesatuan = Kesatuan::where('id_kesatuan',$data_user->id_kesatuan)->get();   
            }
            return view('admin.user.edituser', compact("data_user","data_pangkat","data_kesatuan"));
    }
    public function updatepasswordpengguna(Request $request)
    {
        $data_pangkat = Pangkat::all();
        $data_user = User::where('username',$request->username)->first();
        $data_user->update(['password'=>Hash::make($request->password)]);
        if(Auth::user()->id_aktor==1){
            $data_pengguna = User::where('id_aktor',3)->get();
        }elseif(Auth::user()->id_aktor==2){
            $data_pengguna = User::where('id_aktor',3)->where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_pengguna = User::where('id_user',auth()->user()->id_user)->get();
        }
        return redirect()->route('datapengguna',compact("data_pengguna")); 
    }
    public function updatepasswordadmin(Request $request)
    {
        $data_pangkat = Pangkat::all();
        $data_user = User::where('username',$request->username)->first();
        $data_user->update(['password'=>Hash::make($request->password)]);
        $data_admin = User::where('id_aktor',2)->get();
        return redirect()->route('dataadmin',compact("data_admin"));  
    }
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
