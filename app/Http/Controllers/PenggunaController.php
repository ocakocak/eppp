<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use App\Models\Satker;
use Yajra\DataTables\Services\DataTable;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if(Auth::user()->id_aktor==1){
            $data_pengguna = User::where('id_aktor',3)->get();
        }elseif(Auth::user()->id_aktor==2){
            $data_pengguna = User::where('id_aktor',3)->where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_pengguna = User::where('id_user',auth()->user()->id_user)->get();
        }
        return view('admin.pengguna.datapengguna', compact("data_pengguna"));   
    }

    public function getPengguna(Request $request)
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
        if(Auth::user()->id_aktor == 1){
            $data_kesatuan = Kesatuan::all();
            $data_satker = Satker::all();
        }elseif(Auth::user()->id_aktor == 2){
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_satker = Satker::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
        return view('admin.pengguna.tambahpengguna', compact("data_pangkat","data_kesatuan","data_satker"));    
    }
    
    public function createdata(Request $request)
    {
        $data_users = new User;
        $data_users->id_aktor = 3;
        if(Auth::user()->id_aktor == 1){
            $data_users->id_kesatuan = $request->id_kesatuan;
            $data_users->id_satker = $request->id_satker;
        }elseif(Auth::user()->id_aktor == 2){
            $data_users->id_kesatuan = auth()->user()->id_kesatuan;
            $data_users->id_satker = $request->id_satker;
        }else{
            $data_users->id_kesatuan = auth()->user()->id_kesatuan;
            $data_users->id_satker = auth()->user()->id_satker;
        }
        $data_users->username = $request->username;
        $data_users->password = Hash::make($request->password);
        $data_users->save();
        if(Auth::user()->id_aktor==1){
            $data_pengguna = User::where('id_aktor',3)->get();
        }elseif(Auth::user()->id_aktor==2){
            $data_pengguna = User::where('id_aktor',3)->where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_pengguna = User::where('id_user',auth()->user()->id_user)->get();
        }
        return redirect()->route('datapengguna',compact("data_pengguna"));    
    }

    public function edit($id)
    {
        $data_pangkat = Pangkat::all();
        if(Auth::user()->id_aktor == 1){
            $data_kesatuan = Kesatuan::all();
            $data_satker = Satker::all();
        }elseif(Auth::user()->id_aktor == 2){
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_satker = Satker::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
        $data_pengguna = User::find($id);
        return view('admin.pengguna.editpengguna', compact("data_pengguna","data_pangkat","data_kesatuan","data_satker"));
    }

    public function update(Request $request, $id)
    {
        $data_pengguna = User::find($id);
        $data_pengguna->update([
            'username'=>$request->username,
            'id_aktor'=>3,
            'id_kesatuan'=>$request->id_kesatuan,
            'id_satker'=>$request->id_satker,
        ]);
        if(Auth::user()->id_aktor==1){
            $data_pengguna = User::where('id_aktor',3)->get();
        }elseif(Auth::user()->id_aktor==2){
            $data_pengguna = User::where('id_aktor',3)->where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_pengguna = User::where('id_user',auth()->user()->id_user)->get();
        }
        return redirect()->route('datapengguna',compact("data_pengguna"));  
    }

    public function destroy($id)
    {
        $data = User::where('id',$id)->first();
        $data->delete();
        if(Auth::user()->id_aktor==1){
            $data_pengguna = User::where('id_aktor',3)->get();
        }elseif(Auth::user()->id_aktor==2){
            $data_pengguna = User::where('id_aktor',3)->where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_pengguna = User::where('id_user',auth()->user()->id_user)->get();
        }
        return redirect()->route('datapengguna',compact("data_pengguna"));    
    }
    public function search(Request $request)
    {
        $cari = $request->cari;
        $data_pengguna = User::leftJoin('tb_pangkat', 'users.id_pangkat', '=', 'tb_pangkat.id_pangkat')
        ->leftJoin('tb_kesatuan', 'users.id_kesatuan', '=', 'tb_kesatuan.id_kesatuan')
        ->where('users.id_aktor',3)
        ->orWhere('users.id_kesatuan',Auth::user()->id_kesatuan)
        ->orWhere('users.nama', 'like', '%' . $cari . '%')
        ->orWhere('users.nrpnip', 'like', '%' . $cari . '%')
        ->orWhere('users.jabatan', 'like', '%' . $cari . '%')
        ->orWhere('users.jabatan', 'like', '%' . $cari . '%')
        ->orWhere('tb_pangkat.pangkats', 'like', '%' . $cari . '%')
        ->orWhere('tb_kesatuan.kesatuans', 'like', '%' . $cari . '%')
        ->get();
        return view('admin.pengguna.datapengguna',compact("data_pengguna"));    
    }
    
    public function hapuscekpengguna(Request $request)
    {
        foreach ($request->idpengguna as $data) {
            User::where('id', $data)->delete();
        }
        $data_pengguna = User::where('id_aktor',3)->get();
        return view('admin.pengguna.datapengguna',compact("data_pengguna"));    
    }
}
