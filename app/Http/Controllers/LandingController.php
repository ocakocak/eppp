<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Berita;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'Selamat Datang';
        $info = Info::all();
        $berita = Berita::all();
        return view('welcome', compact('title', 'info', 'berita'));
    }
    public function tampiluu()
    {
        $title = 'Selamat Datang';
        $info = Info::all();
        $berita = Berita::all();
        return view('tampiluu', compact('title', 'info', 'berita'));
    }

    public function login()
    {
        $title = 'Silahkan Login';
        $info = Info::all();
        $berita = Berita::all();
        return view('sigasi.landing.login', compact('title', 'info', 'berita'));
    }

    public function depan()
    {
        $title = 'Selamat Datang';
        $info = Info::all();
        $berita = Berita::all();
        return view('sigasi.landing.depan', compact('title', 'info', 'berita'));
    }

    public function berita()
    {
        $title = 'Olah Data Berita';
        $judul = 'Olah Data Berita';
        $info = Info::all();
        $berita = Berita::all();
        return view('sigasi.landing.berita', compact('title', 'judul', 'info', 'berita'));
    }

    public function editberita($id_berita)
    {
        $title = 'Olah Data berita';
        $judul = 'Edit Data berita';
        $berita = Berita::where('id_berita', $id_berita)->first();
        // $berita = Berita::where('id_berita', $id_berita)
        $id_berita = $id_berita;
        return view('sigasi.landing.editberita', compact('title', 'judul', 'berita', 'id_berita'));
    }

    public function updateberita($id_berita, Request $request)
    {
        $berita = Berita::find($id_berita);
        $berita->update($request->all());
        return redirect()->route('berita', compact("berita"));
    }

    public function hapusberita($id_berita)
    {
        $berita = Berita::find($id_berita);
        $berita->delete();
        return redirect()->route('berita', compact("berita"));
    }


    public function tambahberita(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan1 = $request->judul_gambar . $request->file('gambar')->getClientOriginalName();
            $path1 = $request->file('gambar')->storeAs('public/penghargaan/', $filenameSimpan1);

            Berita::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'status' => 1,
                'gambar' => $filenameSimpan1
            ]);
        } else {
            Berita::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'status' => 1,
                'gambar' => 'logo.png'
            ]);
        }

        return redirect()->route('berita');
    }

    public function info()
    {
        $title = 'Olah Data Informasi';
        $judul = 'Olah Data Informasi';
        $info = Info::all();
        $berita = Berita::all();
        return view('sigasi.landing.info', compact('title', 'judul', 'info', 'berita'));
    }

    public function editinfo($id_info)
    {
        $title = 'Olah Data Informasi';
        $judul = 'Edit Data Informasi';
        $info = Info::where('id_info', $id_info)->first();
        // dd($info);
        // Info::where('id_info', $id_info)->get();

        // $berita = Berita::where('id_berita', $id_berita)
        $id_info = $id_info;
        return view('sigasi.landing.editinfo', compact('title', 'judul', 'info', 'id_info'));
    }


    public function hapusinfo($id_info)
    {
        $info = Info::find($id_info);
        $info->delete();
        return redirect()->route('info', compact("info"));
    }

    public function updateinfo($id_info, Request $request)
    {
        $info = Info::find($id_info);
        $info->update($request->all());
        return redirect()->route('info', compact("info"));
    }

    public function tambahinfo(Request $request)
    {
        $data = new Info();
        // $data->id_personil = $request->id_personil;
        $data->judul = $request->judul;
        $data->informasi = $request->info;
        $data->status = 1;
        $data->save();
        // Personil::create($request->all());
        $data = Info::where('id_info')->get();
        return redirect()->route('info', compact("data"));
    }
}
