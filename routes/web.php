<?php

use App\Http\Controllers\AppsSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/welcome', 'welcome');
Route::get('/home', function () {
   return redirect('/');
});

Route::middleware('guest')->group(function () {
   Route::controller(AuthController::class)->group(function () {
      Route::get('login', 'index')->name('login');
      Route::post('login', '_login');
   });
});

Route::middleware('auth')->group(function () {
   Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
   // -------------------------------------------------------------------------

   Route::controller(HomeController::class)->group(function () {
      Route::get('/', 'index')->name('/');
      Route::get('maintanance', 'maintanance')->name('maintanance');
      Route::get('coming_soon', 'comingSoon')->name('coming_soon');
   });

   Route::controller(MasterController::class)->group(function () {
      Route::get('mst_user', 'masterUser')->name('mst_user');
      Route::get('mst_user/vm_user/{id1}/{id2}', 'vmUser');
      Route::post('mst_user', 'saveMasterUser');
      ##################################################################################
      Route::get('master_hak_akses/vm_hak_akses/{id1}/{id2}', 'vmHakAkses');
      Route::get('master_hak_akses/vt_hak_akses/{id1}/{id2?}', 'vtHakAkses');
      Route::get('master_hak_akses/hapus_hak_akses/{id1}/{id2}/{id3?}', 'hapusHakAkses');
      Route::post('master_hak_akses', 'saveHakAkses');
      ##################################################################################
      // Route::get('mst_agama', 'masterAgama')->name('mst_agama');
      ##################################################################################
      Route::get('mst_role', 'masterRole')->name('mst_role');
      Route::get('mst_role/vm_role/{id1}/{id2}', 'vmRole');
      Route::post('mst_role', 'saveMasterRole');
      ##################################################################################
   });

   Route::controller(PelaporanController::class)->group(function () {
      Route::get('pelaporan_pengiriman', 'pelaporanPengiriman')->name('pelaporan_pengiriman');
      Route::get('pelaporan_pengiriman_vm/{id1}/{id2}', 'pelaporanPengirimanVm');
      Route::post('pelaporan_pengiriman', 'savePelaporanPengiriman');

      Route::get('pelaporan_pengiriman/download/{id1}/{id2}', 'downloadFile');
      ##################################################################################
   });

   Route::controller(LaporanController::class)->group(function () {
      // Route::get('lap_mst_barang', 'lapMstBarang')->name('lap_mst_barang');
      // Route::get('lap_mst_barang_cetak/{id1}', 'lapMstBarangCetak');
   });
});

Route::controller(AppsSettingController::class)->group(function () {
   Route::get('app_settings', 'index')->name('app_settings');
   Route::put('edit_profil_perusahaan', 'editProfilePerusahaan');
   Route::put('edit_style_perusahaan', 'editStylePerusahaan');
   Route::get('/app_settings/vm_user/{id1}/{id2}', 'vmUser');
   Route::post('aksi_data_user', 'aksiUser');
});
