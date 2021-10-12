<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Kesatuan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(User $user)
    {
        $data_user = User::find($user->id);
        $data_pangkat = Pangkat::all();
        if(auth()->user()->id_aktor==1||auth()->user()->id_aktor==2||auth()->user()->id_aktor==4){
        $data_kesatuan = Kesatuan::all();
        }else{
            $data_kesatuan = Kesatuan::where('id_kesatuan',$data_user->id_kesatuan)->get();   
        }
        return view('admin.user.edituser', compact("data_user","data_pangkat","data_kesatuan"));
    }

    public function update(Request $request, User $user)
    {
        $tanggal=getdate();
        $data_user = User::find($user->id);
        $data_user->update([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'id_aktor'=>auth()->user()->id_aktor,
            'id_pangkat'=>$request->id_pangkat,
            'id_kesatuan'=>$request->id_kesatuan,
            'jabatan'=>$request->jabatan,
            'nrpnip'=>$request->nrpnip,
        ]);
        return redirect()->route('edituser',$user->id);  
    }
    public function updatepassword(Request $request, User $user)
    {
        if (Hash::check($request->password, $user->password)) {
    $user->udpate(array([
        'password' => Hash::make($request->password),
    ]))->save();
    }
    else{
        return redirect()->back();
    }
}
}
