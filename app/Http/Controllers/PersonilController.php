<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personil;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use Illuminate\Support\Facades\Auth;

class PersonilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title='Data Personil';
        if(auth()->user()->id_aktor==1){
            $data_personil = Personil::all();
        }elseif(auth()->user()->id_aktor==2){
            $data_personil = Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_personil = Personil::where('id_user',auth()->user()->id)->get();
        }
        return view('admin.personil.datapersonil', compact("title","data_personil"));   
    }
    
    public function create()
    {
        $data_pangkat=Pangkat::all();
        if(Auth::user()->id_aktor == 1){
            $data_kesatuan = Kesatuan::all();
        }elseif(Auth::user()->id_aktor == 2){
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
        return view('admin.personil.tambahpersonil',compact("data_pangkat","data_kesatuan"));    
    }

    public function createdata(Request $request)
    {
        $data_personil = new Personil;
        $data_personil->nama = $request->nama;
        $data_personil->nrpnip = $request->nrpnip;
        $data_personil->id_pangkat = $request->pangkat;
        $data_personil->jabatan = $request->jabatan;
        if(auth()->user()->id_aktor==1){
        $data_personil->id_kesatuan = $request->kesatuan;
        $data_personil->id_satker = $request->id_satker;
        }elseif(auth()->user()->id_aktor==2){
            $data_personil->id_kesatuan = auth()->user()->id_kesatuan;
        $data_personil->id_satker = auth()->user()->id_satker;
            }else{
            $data_personil->id_kesatuan = auth()->user()->id_kesatuan;
        $data_personil->id_satker = auth()->user()->id_satker;
        }
        $data_personil->id_user = auth()->user()->id;
        $data_personil->save();
        $data_personil = Personil::all();
        return redirect()->route('tambahsigasi');    
    }
    public function createdatapersonil(Request $request)
    {
        $data_personil = new Personil;
        $data_personil->nama = $request->nama;
        $data_personil->nrpnip = $request->nrpnip;
        $data_personil->id_pangkat = $request->pangkat;
        $data_personil->jabatan = $request->jabatan;
        if(auth()->user()->id_aktor==1){
            $data_personil->id_kesatuan = $request->kesatuan;
        $data_personil->id_satker = $request->id_satker;
            }elseif(auth()->user()->id_aktor==2){
                $data_personil->id_kesatuan = auth()->user()->id_kesatuan;
        $data_personil->id_satker = auth()->user()->id_satker;
                }else{
                $data_personil->id_kesatuan = auth()->user()->id_kesatuan;
        $data_personil->id_satker = auth()->user()->id_satker;
            }
        $data_personil->id_user = auth()->user()->id;
        $data_personil->save();
        if(auth()->user()->id_aktor==1){
            $data_personil = Personil::all();
            }elseif(auth()->user()->id_aktor==2){
                $data_personil = Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            }else{
                $data_personil = Personil::where('id_user',auth()->user()->id)->get();
            }
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        return redirect()->route('datapersonil',compact('data_personil',"data_pangkat","data_kesatuan"));    
    }

    public function edit(Personil $personil)
    {
        $data_personil = Personil::find($personil->id_personil);
        $data_pangkat=Pangkat::all();
        if(Auth::user()->id_aktor == 1){
            $data_kesatuan = Kesatuan::all();
        }elseif(Auth::user()->id_aktor == 2){
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_kesatuan = Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
        return view('admin.personil.editpersonil', compact("data_personil","data_pangkat","data_kesatuan"));
    }

    public function update(Request $request, Personil $personil)
    {
        $data_personil = Personil::find($personil->id_personil);
        $data_personil->update([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'id_pangkat'=>$request->id_pangkat,
            'id_kesatuan'=>$request->id_kesatuan,
            'jabatan'=>$request->jabatan,
            'nrpnip'=>$request->nrpnip,
            'id_satker'=>$request->id_satker,
        ]);
        if(auth()->user()->id_aktor==1){
            $data_personil = Personil::all();
            }elseif(auth()->user()->id_aktor==2){
                $data_personil = Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            }else{
                $data_personil = Personil::where('id_user',auth()->user()->id)->get();
            }
        return redirect()->route('datapersonil',compact("data_personil"));  
    }

    public function destroy(Personil $personil)
    {
        $data = Personil::find($personil->id_personil);
        $data->delete();
        if(auth()->user()->id_aktor==1){
            $data_personil = Personil::all();
            }elseif(auth()->user()->id_aktor==2){
                $data_personil = Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            }else{
                $data_personil = Personil::where('id_user',auth()->user()->id)->get();
            }
        return redirect()->route('datapersonil',compact("data_personil"));    
    }
    public function search(Request $request)
    {
        $cari = $request->cari;
        $data_personil = Personil::join('tb_pangkat', 'tb_personil.id_pangkat', '=', 'tb_pangkat.id_pangkat')
        ->join('tb_kesatuan', 'tb_personil.id_kesatuan', '=', 'tb_kesatuan.id_kesatuan')
        ->select('tb_personil.*', 'tb_pangkat.*', 'tb_kesatuan.*')
        ->where('tb_pangkat.pangkats', 'like', '%' . $cari . '%')
        ->orWhere('tb_kesatuan.kesatuans', 'like', '%' . $cari . '%')
        ->orWhere('tb_personil.nama', 'like', '%' . $cari . '%')
        ->orWhere('tb_personil.nrpnip', 'like', '%' . $cari . '%')
        ->orWhere('tb_personil.jabatan', 'like', '%' . $cari . '%')
        ->paginate(10);
        return view('admin.personil.datapersonil',compact("data_personil"));    
    }
    
    public function hapuscekpersonil(Request $request)
    {
        foreach ($request->idpersonil as $data) {
            Personil::where('id_personil', $data)->delete();
        }
        if(auth()->user()->id_aktor==1){
            $data_personil = Personil::all();
            }else{
                $data_personil = Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            }
        return view('admin.personil.datapersonil',compact("data_personil"));    
    }
}
