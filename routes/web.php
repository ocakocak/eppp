<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//auth
Auth::routes();

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/jenissyarat', [App\Http\Controllers\HomeController::class, 'jenissyarat'])->name('jenissyarat');
Route::patch('/updatepassword', [App\Http\Controllers\HomeController::class, 'updatepassword'])->name('updatepassword');
Route::patch('/updatepasswordpengguna', [App\Http\Controllers\HomeController::class, 'updatepasswordpengguna'])->name('updatepasswordpengguna');
Route::patch('/updatepasswordadmin', [App\Http\Controllers\HomeController::class, 'updatepasswordadmin'])->name('updatepasswordadmin');
Route::get('logout','App\Http\Controllers\HomeController@logout')->name('logout');

//tampilandepan
Route::get('/', 'App\Http\Controllers\LandingController@index')->name('landing');
Route::get('/depan', 'App\Http\Controllers\LandingController@depan')->name('depan');
Route::get('/tampiluu', 'App\Http\Controllers\LandingController@tampiluu')->name('tampiluu');

//kelolatampilandepan
Route::get('/berita', 'App\Http\Controllers\LandingController@berita')->name('berita');
Route::get('/editberita/{id_berita}', 'App\Http\Controllers\LandingController@editberita')->name('editberita');
Route::post('/tambahberita', 'App\Http\Controllers\LandingController@tambahberita')->name('tambahberita');
Route::patch('/updateberita/{id_berita}', 'App\Http\Controllers\LandingController@updateberita')->name('updateberita');
Route::get('/hapusberita/{id_berita}', 'App\Http\Controllers\LandingController@hapusberita')->name('hapusberita');
Route::get('/info', 'App\Http\Controllers\LandingController@info')->name('info');
Route::get('/editinfo/{id_info}', 'App\Http\Controllers\LandingController@editinfo')->name('editinfo');
Route::post('/tambahinfo', 'App\Http\Controllers\LandingController@tambahinfo')->name('tambahinfo');
Route::patch('/updateinfo/{id_info}', 'App\Http\Controllers\LandingController@updateinfo')->name('updateinfo');
Route::get('/hapusinfo/{id_info}', 'App\Http\Controllers\LandingController@hapusinfo')->name('hapusinfo');

//tampilan setelah login 

//dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('dashboardadmin','App\Http\Controllers\AdminController@dashboardadmin')->name('dashboardadmin');
Route::get('/dataprestasi', 'App\Http\Controllers\PrestasiController@index')->name('dataprestasi');
Route::get('/tambahprestasi', 'App\Http\Controllers\PrestasiController@create')->name('tambahprestasi');
Route::post('/tambahdataprestasi', 'App\Http\Controllers\PrestasiController@createdata')->name('tambahdataprestasi');
Route::get('/editprestasi/{prestasi}', 'App\Http\Controllers\PrestasiController@edit')->name('editprestasi');
Route::patch('/updateprestasi/{prestasi}', 'App\Http\Controllers\PrestasiController@update')->name('updateprestasi');
Route::get('/hapusprestasi/{prestasi}', 'App\Http\Controllers\PrestasiController@destroy')->name('hapusprestasi');
Route::get('/hapuscekprestasi/{prestasi}', 'App\Http\Controllers\PrestasiController@hapuscekprestasi')->name('hapuscekprestasi');
Route::get('/datapenghargaan', 'App\Http\Controllers\PenghargaanController@index')->name('datapenghargaan');
Route::get('/tambahpenghargaan', 'App\Http\Controllers\PenghargaanController@create')->name('tambahpenghargaan');
Route::post('/tambahdatapenghargaan', 'App\Http\Controllers\PenghargaanController@createdata')->name('tambahdatapenghargaan');
Route::get('/editpenghargaan/{penghargaan}', 'App\Http\Controllers\PenghargaanController@edit')->name('editpenghargaan');
Route::patch('/updatepenghargaan/{penghargaan}', 'App\Http\Controllers\PenghargaanController@update')->name('updatepenghargaan');
Route::get('/hapuspenghargaan/{penghargaan}', 'App\Http\Controllers\PenghargaanController@destroy')->name('hapuspenghargaan');
Route::get('/caripenghargaan', 'App\Http\Controllers\PenghargaanController@search')->name('caripenghargaan');
Route::get('/hapuscekpenghargaan/{penghargaan}', 'App\Http\Controllers\PenghargaanController@hapuscekpenghargaan')->name('hapuscekpenghargaan');

//kelola prestasi dan penghargaan
//tampil
Route::get('/datasigasiprestasi', 'App\Http\Controllers\SigasiController@indexprestasi')->name('datasigasiprestasi');
Route::get('/datasigasipenghargaan', 'App\Http\Controllers\SigasiController@indexpenghargaan')->name('datasigasipenghargaan');
//export excel
Route::post('/exportprestasi', 'App\Http\Controllers\SigasiController@exportprestasi')->name('exportprestasi');
Route::post('/exportpenghargaan', 'App\Http\Controllers\SigasiController@exportpenghargaan')->name('exportpenghargaan');
//cetak
Route::post('/cetakprestasi', 'App\Http\Controllers\SigasiController@cetakprestasi')->name('cetakprestasi');
Route::post('/cetakpenghargaan', 'App\Http\Controllers\SigasiController@cetakpenghargaan')->name('cetakpenghargaan');
Route::get('/tampilcetakprestasi', 'App\Http\Controllers\SigasiController@tampilcetakprestasi')->name('tampilcetakprestasi');
//tambah prestasi dan penghargaan
Route::get('/tambahsigasi', 'App\Http\Controllers\SigasiController@create')->name('tambahsigasi');
Route::post('/tambahdatasigasi', 'App\Http\Controllers\SigasiController@createdata')->name('tambahdatasigasi');
//tambah bukti
Route::post('/tambahbuktiprestasi', 'App\Http\Controllers\SigasiController@tambahbuktiprestasi')->name('tambahbuktiprestasi');
Route::post('/tambahbuktipenghargaan', 'App\Http\Controllers\SigasiController@tambahbuktipenghargaan')->name('tambahbuktipenghargaan');
//tindak lanjut
Route::get('/tindaksigasi/{sigasi}', 'App\Http\Controllers\SigasiController@tindak')->name('tindaksigasi');
Route::post('/tindaklanjutsigasi/{sigasi}', 'App\Http\Controllers\SigasiController@tindaklanjutsigasi')->name('tindaklanjutsigasi');
//validasi
Route::get('/validasiprestasi/{id_sigasi}', 'App\Http\Controllers\SigasiController@validasiprestasi')->name('validasiprestasi');
//lihat bukti
Route::get('/lihatbuktisigasi/{id_bukti_prestasi}', 'App\Http\Controllers\SigasiController@lihatbukti')->name('lihatbuktisigasi');
Route::get('/lihatbuktisigasi2/{id_bukti_penghargaan}', 'App\Http\Controllers\SigasiController@lihatbukti2')->name('lihatbuktisigasi2');
Route::get('/lihatbuktisigasisurat/{id_sigasi}', 'App\Http\Controllers\SigasiController@lihatbuktisurat')->name('lihatbuktisurat');
Route::get('/lihaturaiankronologis/{id_sigasi}', 'App\Http\Controllers\SigasiController@lihaturaiankronologis')->name('lihaturaiankronologis');
Route::get('/lihatbuktisuratadmin/{id_sigasi}', 'App\Http\Controllers\SigasiController@lihatbuktisuratadmin')->name('lihatbuktisuratadmin');
//ubah prestasi dan penghargaan
Route::get('/editsigasi/{sigasi}', 'App\Http\Controllers\SigasiController@editsigasi')->name('editsigasi');
Route::patch('/updatesigasi/{sigasi}', 'App\Http\Controllers\SigasiController@update')->name('updatesigasi');
Route::patch('/updatedatasigasi/{sigasi}', 'App\Http\Controllers\SigasiController@updatedatasigasi')->name('updatedatasigasi');
Route::patch('/beripenghargaan/{sigasi}', 'App\Http\Controllers\SigasiController@beripenghargaan')->name('beripenghargaan');
//hapus prestasi dan penghargaan
Route::get('/hapussigasi/{sigasi}', 'App\Http\Controllers\SigasiController@destroy')->name('hapussigasi');
Route::get('/hapussigasipenghargaan/{sigasi}', 'App\Http\Controllers\SigasiController@destroypenghargaan')->name('hapussigasipenghargaan');
Route::get('/hapusceksigasi/{sigasi}', 'App\Http\Controllers\SigasiController@hapusceksigasi')->name('hapusceksigasi');
//cari prestasi dan penghargaan
Route::get('/carisigasi', 'App\Http\Controllers\SigasiController@search')->name('carisigasi');
Route::get('/cariprestasi', 'App\Http\Controllers\SigasiController@searchprestasi')->name('cariprestasi');
//filter prestasi dan penghargaan
Route::post('/filtersigasi', 'App\Http\Controllers\SigasiController@filtersigasi')->name('filtersigasi');
Route::post('/filterprestasi', 'App\Http\Controllers\SigasiController@filterprestasi')->name('filterprestasi');

//kelola data personil
Route::get('/datapersonil', 'App\Http\Controllers\PersonilController@index')->name('datapersonil');
Route::get('/tambahpersonil', 'App\Http\Controllers\PersonilController@create')->name('tambahpersonil');
Route::post('/tambahdatapersonil', 'App\Http\Controllers\PersonilController@createdata')->name('tambahdatapersonil');
Route::post('/tambahdatapersoniltabel', 'App\Http\Controllers\PersonilController@createdatapersonil')->name('tambahdatapersoniltabel');
Route::get('/editpersonil/{personil}', 'App\Http\Controllers\PersonilController@edit')->name('editpersonil');
Route::patch('/updatepersonil/{personil}', 'App\Http\Controllers\PersonilController@update')->name('updatepersonil');
Route::get('/hapuspersonil/{personil}', 'App\Http\Controllers\PersonilController@destroy')->name('hapuspersonil');
Route::get('/caripersonil', 'App\Http\Controllers\PersonilController@search')->name('caripersonil');
Route::get('/hapuscekpersonil/{personil}', 'App\Http\Controllers\PersonilController@hapuscekpersonil')->name('hapuscekpersonil');

//kelola data pengguna
Route::get('/datapengguna', 'App\Http\Controllers\PenggunaController@index')->name('datapengguna');
Route::get('/listpengguna', 'App\Http\Controllers\PenggunaController@getPengguna')->name('pengguna.list');
Route::get('/tambahpengguna', 'App\Http\Controllers\PenggunaController@create')->name('tambahpengguna');
Route::post('/tambahdatapengguna', 'App\Http\Controllers\PenggunaController@createdata')->name('tambahdatapengguna');
Route::get('/editpengguna/{id}', 'App\Http\Controllers\PenggunaController@edit')->name('editpengguna');
Route::patch('/updatepengguna/{id}', 'App\Http\Controllers\PenggunaController@update')->name('updatepengguna');
Route::get('/hapuspengguna/{id}', 'App\Http\Controllers\PenggunaController@destroy')->name('hapuspengguna');
Route::get('/caripengguna', 'App\Http\Controllers\PenggunaController@search')->name('caripengguna');
Route::get('/hapuscekpengguna/{id}', 'App\Http\Controllers\PenggunaController@hapuscekpengguna')->name('hapuscekpengguna');
Route::get('/hapusbanyakadmin/{id}', 'App\Http\Controllers\AdminController@hapusbanyakadmin')->name('hapusbanyakadmin');

//kelola data admin
Route::get('/dataadmin', 'App\Http\Controllers\AdminController@index')->name('dataadmin');
Route::get('/listadmin', 'App\Http\Controllers\AdminController@getadmin')->name('admin.list');
Route::get('/tambahadmin', 'App\Http\Controllers\AdminController@create')->name('tambahadmin');
Route::post('/tambahdataadmin', 'App\Http\Controllers\AdminController@createdata')->name('tambahdataadmin');
Route::get('/editadmin/{user}', 'App\Http\Controllers\AdminController@edit')->name('editadmin');
Route::patch('/updateadmin/{user}', 'App\Http\Controllers\AdminController@update')->name('updateadmin');
Route::get('/hapusadmin/{user}', 'App\Http\Controllers\AdminController@destroy')->name('hapusadmin');
Route::get('/cariadmin', 'App\Http\Controllers\AdminController@search')->name('cariadmin');
Route::get('/hapuscekadmin/{user}', 'App\Http\Controllers\AdminController@hapuscekadmin')->name('hapuscekpengguna');

//kelola user
Route::get('/edituser/{user}', 'App\Http\Controllers\UserController@edit')->name('edituser');
Route::patch('/updateuser/{user}', 'App\Http\Controllers\UserController@update')->name('updateuser');