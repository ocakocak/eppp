<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sigasi;
use App\Models\Personil;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use App\Models\BuktiPrestasi;
use App\Models\BuktiPenghargaan;
use App\Models\Validasi;

class SigasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexprestasi()
    {
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return view('admin.sigasi.dataprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
    }
    public function tampilcetakprestasi()
    {
    if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
        $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }else{
        $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
        $data_personil=Personil::where('id_user',auth()->user()->id)->get();
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }
    return view('admin.sigasi.tampilcetakprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
}
public function indexpenghargaan()
{
    if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
        $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }else{
        $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
        $data_personil=Personil::where('id_user',auth()->user()->id)->get();
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }
        return view('admin.sigasi.datapenghargaan', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));  
    }
    public function exportprestasi(Request $request)
    {
        if(auth()->user()->id_aktor==1){
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::all();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::where('keterangan',null)->get();
                }
            }
        }
        else{
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->get();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',null)->get();
                }
            }
        }
        return view('admin.sigasi.exportprestasi', compact("data_sigasi"));   
    }
    public function exportpenghargaan(Request $request)
    {
        if(auth()->user()->id_aktor==1){
        if($request->from_date != null && $request->to_date != null){
            if($request->data == "2"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif($request->data == "4"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif($request->data == "6"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
        }else{
            if($request->data == "1"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->get();
            }
            elseif($request->data == "3"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',"!=",null)->get();
            }
            elseif($request->data == "5"){
                $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',null)->get();
            }
        }
    }
        else{
        if($request->from_date != null && $request->to_date != null){
            if($request->data == "2"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif($request->data == "4"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif($request->data == "6"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
        }else{
            if($request->data == "1"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->get();
            }
            elseif($request->data == "3"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->where('keterangan',"!=",null)->get();
            }
            elseif($request->data == "5"){
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('nama_penghargaan','!=',null)->where('keterangan',null)->get();
            }
        }
    }
        return view('admin.sigasi.exportpenghargaan', compact("data_sigasi"));   
    }
    public function cetakprestasi(Request $request)
    {
        if(auth()->user()->id_aktor==1){
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::all();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::where('keterangan',null)->get();
                }
            }
        }
        else{
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->get();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('keterangan',null)->get();
                }
            }
        }
        return view('admin.sigasi.cetakprestasi', compact("data_sigasi"));   
    }
    public function cetakpenghargaan(Request $request)
    {
        if(auth()->user()->id_aktor==1){
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->get();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::where('nama_penghargaan','!=',null)->where('keterangan',null)->get();
                }
            }
        }
        else{
            if($request->from_date != null && $request->to_date != null){
                if($request->data == "2"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "4"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->where('keterangan','!=',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
                elseif($request->data == "6"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->where('keterangan',null)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                    ->get();
                }
            }else{
                if($request->data == "1"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->get();
                }
                elseif($request->data == "3"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->where('keterangan',"!=",null)->get();
                }
                elseif($request->data == "5"){
                    $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                    ->select('tb_sigasi.*', 'tb_personil.*')
                    ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                    ->where('nama_penghargaan','!=',null)->where('keterangan',null)->get();
                }
            }
        }
        return view('admin.sigasi.cetakpenghargaan', compact("data_sigasi"));   
    }
    public function lihatbuktisurat($id_sigasi)
    {
        $data_sigasi = Sigasi::where('id_sigasi',$id_sigasi)->first();
        $data_personil=Personil::all();
        return view('admin.sigasi.lihatbuktisurat', compact("data_sigasi","data_personil"));   
    }
    public function lihatbuktisuratadmin($id_sigasi)
    {
        $data_sigasi = Sigasi::where('id_sigasi',$id_sigasi)->first();
        $data_personil=Personil::all();
        return view('admin.sigasi.lihatbuktisuratadmin', compact("data_sigasi","data_personil"));   
    }
    public function lihaturaiankronologis($id_sigasi)
    {
        $data_sigasi = Sigasi::where('id_sigasi',$id_sigasi)->first();
        $data_personil=Personil::all();
        return view('admin.sigasi.lihaturaiankronologis', compact("data_sigasi","data_personil"));   
    }
    public function lihatbukti($id_bukti_prestasi)
    {
        $data_bukti = BuktiPrestasi::where('id_bukti_prestasi',$id_bukti_prestasi)->first();
        $id_sigasi=$data_bukti->id_sigasi;
        $data_sigasi = Sigasi::where('id_sigasi',$id_sigasi)->first();
        $data_personil=Personil::all();
        return view('admin.sigasi.lihatbukti', compact("data_sigasi","data_bukti","data_personil"));   
    }
    public  function lihatbukti2($id_bukti_penghargaan)
    {
        $data_bukti = BuktiPenghargaan::where('id_bukti_penghargaan',$id_bukti_penghargaan)->first();
        $id_sigasi=$data_bukti->id_sigasi;
        $data_sigasi = Sigasi::where('id_sigasi',$id_sigasi)->first();
        $data_personil=Personil::all();
        return view('admin.sigasi.lihatbuktipenghargaan', compact("data_sigasi","data_bukti","data_personil"));   
    }
    
    public function create()
    {
        if(auth()->user()->id_aktor==1 ){
            $data_personil=Personil::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_kesatuan=Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_kesatuan=Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
            $data_pangkat=Pangkat::all();
            return view('admin.sigasi.tambahsigasi', compact("data_personil","data_pangkat","data_kesatuan"));    
    }
    
    public function createdata(Request $request)
    {
        if ($request->hasFile('file_bukti_surat')) {
            $file=$request->file_bukti_surat;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extensionsurat = $file->getClientOriginalExtension();
            $filenameSimpanSurat = $request->judul_file_bukti_surat . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/surat/', $filenameSimpanSurat);
        }
        if ($request->hasFile('deskripsi')) {
            $file=$request->deskripsi;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extensiondeskripsi = $file->getClientOriginalExtension();
            $filenameSimpandeskripsi = $request->judul_deskripsi . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/deskripsi/', $filenameSimpandeskripsi);
        }
        if($request->file_bukti_surat==null){
            $filenameSimpanSurat=null;
            $extensionsurat=null;
        }
        if($request->deskripsi==null){
            $filenameSimpandeskripsi=null;
            $extensiondeskripsi=null;
        }
        
        if(auth()->user()->id_aktor==1){
            $keterangan = 2;
        }else{
            $keterangan = 0;
        }
        
        $Pengpres = Sigasi::create([
            'id_personil' => $request->nama,
            'jenis_penghargaan' => $request->jenis_penghargaan,
            'tingkat' => $request->tingkat,
            'nama_penghargaan' => $request->nama_penghargaan,
            'keterangan_penghargaan' => $request->keterangan_penghargaan,
            'sumber' => $request->sumber,
            'no_file_bukti_surat'=>$request->no_file_bukti_surat,
            'file_bukti_surat'=>$filenameSimpanSurat,
            'extension_file_bukti_surat'=>$extensionsurat,
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $filenameSimpandeskripsi,
            'extension_deskripsi'=>$extensiondeskripsi,
            'tanggal_input' => date('Y-m-d'),
            'id_user' => auth()->user()->id,
            'keterangan' => $keterangan,
        ]);
        if ($request->hasFile('file_bukti_penghargaan')) {
            $files = [];
            foreach ($request->file('file_bukti_penghargaan') as $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan1 = $request->judul_file_bukti_penghargaan . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/penghargaan/', $filenameSimpan1);
            BuktiPenghargaan::create([
                'id_sigasi' => $Pengpres->id_sigasi,
                'file_bukti_penghargaan' => $filenameSimpan1,
                'extension' => $extension,
            ]);
        }
    }
    if ($request->hasFile('file_bukti_prestasi')) {
        $files = [];
        foreach ($request->file('file_bukti_prestasi') as $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan2 = $request->judul_file_bukti_prestasi . $file->getClientOriginalName();
            $path2 = $file->storeAs('public/prestasi/', $filenameSimpan2);
            BuktiPrestasi::create([
                'id_sigasi' => $Pengpres->id_sigasi,
                'file_bukti_prestasi' => $filenameSimpan2,
                'extension' => $extension,
            ]);
        }
        }
        return redirect()->route('tambahsigasi');
    }

    public function editsigasi(sigasi $sigasi)
    {
        $data_sigasi = Sigasi::find($sigasi->id_sigasi);
        if(auth()->user()->id_aktor==1 ){
            $data_personil=Personil::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_kesatuan=Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }else{
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_kesatuan=Kesatuan::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
        }
            $data_pangkat=Pangkat::all();
            return view('admin.sigasi.editsigasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));
        }
        
        public function updatedatasigasi(Request $request, sigasi $sigasi)
        {
            $data_sigasi = Sigasi::find($sigasi->id_sigasi);
            if ($request->hasFile('file_bukti_surat')) {
                $file=$request->file_bukti_surat;
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extensionsurat = $file->getClientOriginalExtension();
                $filenameSimpanSurat = $request->judul_file_bukti_surat . $file->getClientOriginalName();
                $path1 = $file->storeAs('public/surat/', $filenameSimpanSurat);
            }
        if ($request->hasFile('deskripsi')) {
            $file=$request->deskripsi;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extensiondeskripsi = $file->getClientOriginalExtension();
            $filenameSimpandeskripsi = $request->judul_deskripsi . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/deskripsi/', $filenameSimpandeskripsi);
        }
        if($request->file_bukti_surat==null){
            $filenameSimpanSurat=null;
            $extensionsurat=null;
            $jenissurat=null;
        }
        if($request->deskripsi==null){
            $filenameSimpandeskripsi=null;
            $extensiondeskripsi=null;
        }
        $data_sigasi->update([
            'id_personil' => $request->nama,
            'jenis_penghargaan' => $request->jenis_penghargaan,
            'tingkat' => $request->tingkat,
            'nama_penghargaan' => $request->nama_penghargaan,
            'keterangan_penghargaan' => $request->keterangan_penghargaan,
            'sumber' => $request->sumber,
            'extension_file_bukti_surat'=>$extensionsurat,
            'jenis_surat'=>$extensionsurat,
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $filenameSimpandeskripsi,
            'extension_deskripsi'=>$extensiondeskripsi,
            'tanggal_input' => date('Y-m-d'),
            'id_user' => auth()->user()->id,
            'keterangan' => $data_sigasi->keterangan,
        ]);

        if ($request->hasFile('file_bukti_penghargaan')) {
            $files = [];
            foreach ($request->file('file_bukti_penghargaan') as $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan1 = $request->judul_file_bukti_penghargaan . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/penghargaan/', $filenameSimpan1);
            BuktiPenghargaan::create([
                'id_sigasi' => $sigasi->id_sigasi,
                'file_bukti_penghargaan' => $filenameSimpan1,
                'extension' => $extension,
            ]);}
        }
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return view('admin.sigasi.dataprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
    }
    public function update(Request $request, sigasi $sigasi)
    {
        $data_sigasi = Sigasi::find($sigasi->id_sigasi);
        $data_sigasi->update($request->all());
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
        $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }else{
        $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
        $data_personil=Personil::where('id_user',auth()->user()->id)->get();
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasi',compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));  
    }
    public function beripenghargaan(Request $request, sigasi $sigasi)
    {
        $data_sigasi = Sigasi::find($sigasi->id_sigasi);
        $data_sigasi->update([
            'nama_penghargaan' => $request->nama_penghargaan,
            'sumber' => $request->sumber,
            'tingkat' => $request->tingkat,
            'jenis_penghargaan' => $request->jenis_penghargaan,
            'keterangan_penghargaan' => $request->keterangan_penghargaan,
        ]);
        if ($request->hasFile('file_bukti_penghargaan')) {
            $files = [];
            foreach ($request->file('file_bukti_penghargaan') as $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan1 = $request->judul_file_bukti_penghargaan . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/penghargaan/', $filenameSimpan1);
            BuktiPenghargaan::create([
                'id_sigasi' => $sigasi->id_sigasi,
                'file_bukti_penghargaan' => $filenameSimpan1,
                'extension' => $extension,
            ]);}
        }
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
    }
    public function tindak(Request $request, sigasi $sigasi)
    {
        $data_sigasi = Sigasi::find($sigasi->id_sigasi);
        if($data_sigasi->status_tindakan == 'Belum Ditindak'){
        $data_sigasi->update(array('status_tindakan' => 'Sudah Ditindak'));}
        else{$data_sigasi->update(array('status_tindakan' => 'Belum Ditindak'));}
        return redirect()->route('datasigasi',compact("data_sigasi"));  
    }
    public function tindaklanjutsigasi(Request $request, sigasi $sigasi)
    {
        $data = Sigasi::find($sigasi->id_sigasi);
        if ($request->hasFile('file_bukti_surat')) {
            $file=$request->file_bukti_surat;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extensionsurat = $file->getClientOriginalExtension();
            $filenameSimpanSurat = $request->judul_file_bukti_surat . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/surat/', $filenameSimpanSurat);
            $data->update(array('no_file_bukti_surat'=>$request->no_file_bukti_surat));
            $data->update(array('file_bukti_surat'=>$filenameSimpanSurat));
            $data->update(array('extension_file_bukti_surat'=>$extensionsurat));
            $data->update(array('jenis_surat'=>$request->jenis_surat));
        }
        if ($request->hasFile('suratadmin')) {
            $file=$request->suratadmin;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extensionsurat = $file->getClientOriginalExtension();
            $filenameSimpanSurat = $request->judul_suratadmin . $file->getClientOriginalName();
            $path1 = $file->storeAs('public/suratadmin/', $filenameSimpanSurat);
            $data->update(array('nosuratadmin'=>$request->nosuratadmin));
            $data->update(array('suratadmin'=>$filenameSimpanSurat));
            $data->update(array('extensionsuratadmin'=>$extensionsurat));
            $data->update(array('jenissuratadmin'=>$request->jenissuratadmin));
        }
        if($data->keterangan == 0){
            $data->update(array('keterangan'=>1));
        }elseif($data->keterangan == 1){
            $data->update(array('keterangan'=>2));
        }elseif($data->keterangan == 2){
            $data->update(array('keterangan'=>3));
        }
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
    }
    public function validasiprestasi(Request $request,$id_sigasi)
    {
        $data = Sigasi::find($id_sigasi);

        if($request->status==1){
            $data->update(array('keterangan'=>3));
        }elseif($request->status==2){
            $data->update(array('keterangan'=>0));
        }
        
        $validasi= Validasi::create([
            'id_sigasi' => $id_sigasi,
            'status' => $request->status,
            'catatan_validasi' => $request->catatan_validasi,
        ]);

        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
    }

    public function destroy(sigasi $sigasi)
    {
        $data = Sigasi::find($sigasi->id_sigasi);
        $data->delete();
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
        $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }else{
        $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
        $data_personil=Personil::where('id_user',auth()->user()->id)->get();
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));      
    }
    public function destroypenghargaan(sigasi $sigasi)
    {
        $data = Sigasi::find($sigasi->id_sigasi);
        $data->delete();
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
        $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }else{
        $data_sigasi = Sigasi::where('id_user',auth()->user()->id)->get();
        $data_personil=Personil::where('id_user',auth()->user()->id)->get();
        $data_pangkat=Pangkat::all();
        $data_kesatuan=Kesatuan::all();
        }
        return redirect()->route('datasigasipenghargaan', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));     
    }
    // public function search(Request $request)
    // {
    //     if(auth()->user()->id_aktor == 1){
    //         $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
    //         ->get();
    //     }else{
    //             $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')->select('tb_sigasi.*', 'tb_personil.*')
    //             ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
    //             ->where('tb_personil.id_kesatuan', 'like', '%' .auth()->user()->id_kesatuan . '%')
    //             ->get();
                
    //         }
    //     $data_personil=Personil::all();
    //     $data_pangkat=Pangkat::all();
    //     $data_kesatuan=Kesatuan::all();
    //     return view('admin.sigasi.datapenghargaan',compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));    
    // }
    // public function searchprestasi(Request $request)
    // {
    //     if(auth()->user()->id_aktor == 1){
    //     $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
    //     ->get();
    // }else{
    //         $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')->select('tb_sigasi.*', 'tb_personil.*')
    //         ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
    //         ->where('tb_personil.id_kesatuan', 'like', '%' .auth()->user()->id_kesatuan . '%')
    //         ->get();
            
    //     }
    //     $data_personil=Personil::all();
    //     $data_pangkat=Pangkat::all();
    //     $data_kesatuan=Kesatuan::all();
    //     return view('admin.sigasi.dataprestasi',compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));    
    // }
    public function filtersigasi(Request $request)
    {
        if(auth()->user()->id_aktor==1){
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->get();
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif (!empty(request('jenis_penghargaan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.jenis_penghargaan', 'like', '%' . $request->jenis_penghargaan . '%')
                ->get();
            }
            elseif (!empty(request('data'))) {
                if($request->from_date != null && $request->to_date != null){
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::where('keterangan',2)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::where('keterangan',1)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::where('keterangan','!=',2)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::where('keterangan',0)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                }else{
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::all();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::where('keterangan',2)->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::where('keterangan',1)->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::where('keterangan','!=',2)->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::where('keterangan',0)->get();
                    }
                }
            }else {
            $data_sigasi=Sigasi::all();
            }
        }

        elseif(auth()->user()->id_aktor==2){
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->get();
                
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif (!empty(request('jenis_penghargaan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_sigasi.jenis_penghargaan', 'like', '%' . $request->jenis_penghargaan . '%')
                ->get();
            }
            elseif (!empty(request('data'))) {
                if($request->from_date != null && $request->to_date != null){
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',2)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',1)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan','!=',2)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',0)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                }else{
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',2)
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',1)
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan','!=',2)
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',0)
                        ->get();
                    }
                }
            }else {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->get();
            }
        }
        
        else{
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('jenis_penghargaan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->where('tb_sigasi.jenis_penghargaan', 'like', '%' . $request->jenis_penghargaan . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }else {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
        }
        
        if(auth()->user()->id_aktor==1 ){
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        if($request->submit == 'submit3'){
        return redirect()->route('datasigasipenghargaan', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
        }elseif($request->submit == 'submit1'){
            return view('admin.sigasi.exportpenghargaan', compact("data_sigasi"));   
        }
        elseif($request->submit == 'submit2') {
            return view('admin.sigasi.cetakpenghargaan', compact("data_sigasi")); 
        }
    }
    public function filterprestasi(Request $request)
    {
        if(auth()->user()->id_aktor==1){
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->get();
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif (!empty(request('data'))) {
                if($request->from_date != null && $request->to_date != null){
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::where('keterangan',2)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::where('keterangan',1)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::where('keterangan','!=',2)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::where('keterangan',0)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                }else{
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::all();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::where('keterangan',2)->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::where('keterangan',1)->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::where('keterangan','!=',2)->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::where('keterangan',0)->get();
                    }
                }
            }else {
            $data_sigasi=Sigasi::all();
            }
        }

        elseif(auth()->user()->id_aktor==2){
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->get();
                
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*') 
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }
            elseif (!empty(request('data'))) {
                if($request->from_date != null && $request->to_date != null){
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',2)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',1)->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan','!=',2)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',0)
                        ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                        ->get();
                    }
                }else{
                    if($request->data == "1"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->get();
                    }
                    elseif($request->data == "2"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',2)
                        ->get();
                    }
                    elseif($request->data == "3"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',1)
                        ->get();
                    }
                    elseif($request->data == "4"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan','!=',2)
                        ->get();
                    }
                    elseif($request->data == "5"){
                        $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                        ->select('tb_sigasi.*', 'tb_personil.*')
                        ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                        ->where('keterangan',0)
                        ->get();
                    }
                }
            }else {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)
                ->get();
            }
        }
        
        else{
            if (!empty(request('id_pangkat'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->where('tb_personil.id_pangkat', 'like', '%' . $request->id_pangkat . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('id_kesatuan'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_personil.id_kesatuan', 'like', '%' . $request->id_kesatuan . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('id_personil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')->where('tb_sigasi.id_personil', 'like', '%' . $request->id_personil . '%')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
            elseif (!empty(request('namapersonil'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->where('tb_personil.nama', 'like', '%' . $request->namapersonil . '%')
                ->get();
            }
            elseif (!empty(request('nrpnip'))) {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->where('tb_personil.nrpnip', 'like', '%' . $request->nrpnip . '%')
                ->get();
            }
            elseif (!empty(request('from_date'))) {
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->whereBetween('tanggal_input', array($request->from_date, $request->to_date))
                ->get();
            }else {
                $data_sigasi=Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->select('tb_sigasi.*', 'tb_personil.*')
                ->where('tb_sigasi.id_user',auth()->user()->id)
                ->get();
            }
        }
        
        if(auth()->user()->id_aktor==1 ){
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }elseif(auth()->user()->id_aktor==2 ){
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_personil=Personil::where('id_user',auth()->user()->id)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        if($request->submit == 'submit3'){
            return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));    
            }elseif($request->submit == 'submit1'){
                return view('admin.sigasi.exportprestasi', compact("data_sigasi"));   
            }
            elseif($request->submit == 'submit2') {
                return view('admin.sigasi.cetakprestasi', compact("data_sigasi")); 
            }
    }
    
    public function hapusceksigasi(Request $request)
    {
        foreach ($request->idsigasi as $data) {
            Sigasi::where('id_sigasi', $data)->delete();
        }
        if(auth()->user()->id_aktor==1 ){
            $data_sigasi = Sigasi::all();
            $data_personil=Personil::all();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }else{
            $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
            ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
            $data_pangkat=Pangkat::all();
            $data_kesatuan=Kesatuan::all();
        }
        return view('admin.sigasi.datapenghargaan',compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));
    }
    public function formotomatis(Request $request)
    {
        $data_personil = Personil::where('nrpnip',$request->nrpnip)->get();
        $data = array(
            'nama'      =>  $data_personil->nama,
            'nrpnip'      =>  $data_personil->nrpnip,
            'id_pangkat'   =>  $data_personil->id_pangkat,
            'id_kesatuan'   =>  $data_personil->id_kesatuan,
            'alamat'    =>  $data_personil->jabatan);
            return json_encode($data);
    }
    public function tambahbuktiprestasi(Request $request){
            if ($request->hasFile('file_bukti_prestasi')) {
                $files = [];
                foreach ($request->file('file_bukti_prestasi') as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $filenameSimpan2 = $request->judul_file_bukti_prestasi . $file->getClientOriginalName();
                    $path2 = $file->storeAs('public/prestasi/', $filenameSimpan2);
                    BuktiPrestasi::create([
                        'id_sigasi' => $request->id_sigasi,
                        'file_bukti_prestasi' => $filenameSimpan2,
                        'extension' => $extension,
                    ]);
                }
            }
            if(auth()->user()->id_aktor==1 ){
                $data_sigasi = Sigasi::all();
                $data_personil=Personil::all();
                $data_pangkat=Pangkat::all();
                $data_kesatuan=Kesatuan::all();
            }else{
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
                $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
                $data_pangkat=Pangkat::all();
                $data_kesatuan=Kesatuan::all();
            }
            return redirect()->route('datasigasiprestasi', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
        }
    public function tambahbuktipenghargaan(Request $request){
            if ($request->hasFile('file_bukti_penghargaan')) {
                $files = [];
                foreach ($request->file('file_bukti_penghargaan') as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $filenameSimpan2 = $request->judul_file_bukti_penghargaan . $file->getClientOriginalName();
                    $path2 = $file->storeAs('public/penghargaan/', $filenameSimpan2);
                    BuktiPenghargaan::create([
                        'id_sigasi' => $request->id_sigasi,
                        'file_bukti_penghargaan' => $filenameSimpan2,
                        'extension' => $extension,
                    ]);
                }
            }
            if(auth()->user()->id_aktor==1 ){
                $data_sigasi = Sigasi::all();
                $data_personil=Personil::all();
                $data_pangkat=Pangkat::all();
                $data_kesatuan=Kesatuan::all();
            }else{
                $data_sigasi = Sigasi::leftJoin('tb_personil', 'tb_sigasi.id_personil', '=', 'tb_personil.id_personil')
                ->where('tb_personil.id_kesatuan',auth()->user()->id_kesatuan)->get();
                $data_personil=Personil::where('id_kesatuan',auth()->user()->id_kesatuan)->get();
                $data_pangkat=Pangkat::all();
                $data_kesatuan=Kesatuan::all();
            }
            return redirect()->route('datasigasipenghargaan', compact("data_sigasi","data_personil","data_pangkat","data_kesatuan"));   
        }
    }
