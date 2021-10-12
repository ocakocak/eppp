<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use App\Models\Personil;
use App\Models\Sigasi;
use Yajra\DataTables\Services\DataTable;
use Datatables;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboardadmin(Request $request)
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
    public function index(Request $request)
    {
        $data_admin = User::where('id_aktor',2)->get();
        return view('superadmin.admin.dataadmin', compact("data_admin"));   
    }

    public function getadmin(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    
    public function create()
    {
        $data_pangkat = Pangkat::all();
        $data_kesatuan = Kesatuan::where('id_kesatuan',1)->orWhere('id_kesatuan',2)->orWhere('id_kesatuan',3)
        ->orWhere('id_kesatuan',4)->orWhere('id_kesatuan',5)->orWhere('id_kesatuan',6)->orWhere('id_kesatuan',7)
        ->orWhere('id_kesatuan',8)->orWhere('id_kesatuan',9)->orWhere('id_kesatuan',10)->orWhere('id_kesatuan',11)->get();
        return view('superadmin.admin.tambahadmin', compact("data_pangkat","data_kesatuan"));    
    }

    public function createdata(Request $request)
    {
        $data_users = new User;
        $data_users->id_aktor = 2;
        $data_users->id_kesatuan = $request->id_kesatuan;
        $data_users->username = $request->username;
        $data_users->password = bcrypt($request->password);
        $data_users->save();
        $data_admin = User::where('id_aktor',2)->get();
        return redirect()->route('dataadmin',compact("data_admin"));    
    }

    public function edit(user $user)
    {
        $data_pangkat = Pangkat::all();
        $data_kesatuan = Kesatuan::all();
        $data_admin = User::find($user->id);
        return view('superadmin.admin.editadmin', compact("data_admin","data_pangkat","data_kesatuan"));
    }
    
    public function update(Request $request, user $user)
    {
        $data_admin = User::find($user->id);
        $data_admin->update($request->all());
        $data_admin = User::where('id_aktor',2)->get();
        return redirect()->route('dataadmin',compact("data_admin"));  
    }

    public function destroy(User $user)
    {
        $data = User::where('id',$user->id)->first();
        $data->delete();
        $data_admin = User::where('id_aktor',2)->get();
        return redirect()->route('dataadmin',compact("data_admin"));    
    }
    public function search(Request $request)
    {
        $cari = $request->cari;
        $data_admin = User::leftJoin('tb_pangkat', 'users.id_pangkat', '=', 'tb_pangkat.id_pangkat')
        ->leftJoin('tb_kesatuan', 'users.id_kesatuan', '=', 'tb_kesatuan.id_kesatuan')
        ->where('users.nama', 'like', '%' . $cari . '%')
        ->orWhere('users.nrpnip', 'like', '%' . $cari . '%')
        ->orWhere('users.jabatan', 'like', '%' . $cari . '%')
        ->orWhere('users.jabatan', 'like', '%' . $cari . '%')
        ->orWhere('tb_pangkat.pangkats', 'like', '%' . $cari . '%')
        ->orWhere('tb_kesatuan.kesatuans', 'like', '%' . $cari . '%')
        ->where('id_aktor',2)->get();
        return view('superadmin.admin.dataadmin',compact("data_admin"));    
    }
    
    public function hapuscekadmin(Request $request)
    {
        foreach ($request->idadmin as $data) {
            User::where('id', $data)->delete();
        }
        $data_admin = User::where('id_aktor',2)->get();
        return view('superadmin.admin.dataadmin',compact("data_admin"));    
    }
}
