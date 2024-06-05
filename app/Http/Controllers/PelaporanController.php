<?php

namespace App\Http\Controllers;

use App\Models\LaporanPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelaporanController extends Controller
{
   public function index()
   {
      return to_route('/')->with('danger', 'Loo Looo Gak Bahaya Taaaa !!!');
   }

   public function pelaporanPengiriman()
   {
      $data['titleForm'] = title_url();
      $data['laporanPengiriman'] = LaporanPengiriman::orderBy('tgl_laporan', 'desc')->get();

      return view('admin.pelaporan.pelaporan_pengiriman', $data);
   }

   public function pelaporanPengirimanVm($id1, $id2)
   {
      $data['dataMode'] = $id1;

      if ($id2 !== 0) {
         $data['pelaporanPengiriman'] = LaporanPengiriman::where('kd_laporan', $id2)->first();
      }

      return view('admin.pelaporan.pelaporan_pengiriman_vm', $data);
   }

   public function savePelaporanPengiriman(Request $request)
   {
      $request->validate([
         'kdLaporan'    => ['required', 'size:12'],
         'dataMode'     => ['required'],
         'tglLaporan'   => ['required', 'date'],
      ]);

      DB::beginTransaction();
      try {
         ########## Save Logs ##########################################################################
         saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
         ###############################################################################################

         switch ($request->dataMode) {
            case 'addPelaporan':
               $noTrans = noTransaksi('LP');
               while (LaporanPengiriman::where('kd_laporan', $noTrans)->exists()) {
                  $noTrans = noTransaksi('LP');
               }

               $laporanPengiriman = [
                  'kd_laporan'   => $noTrans,
                  'tgl_laporan'  => $request->tglLaporan,
                  'no_kontainer' => $request->noKontainer,
                  'si'           => $request->si,
                  'keterangan_laporan' => $request->keterangan,
                  'user_laporan' => auth()->user()->username,
               ];

               $file = $request->file('suratPenugasan');
               if ($file) {
                  $request->validate([
                     'suratPenugasan'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $noTrans . '_' . time() . '.' . $file->getClientOriginalExtension();
                  $file->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $laporanPengiriman['surat_penugasan'] = $fileName;
               }

               LaporanPengiriman::create($laporanPengiriman);
               break;

            case 'editPelaporan':
               $laporanPengiriman = LaporanPengiriman::where('kd_laporan', $request->kdLaporan)->first();

               if (!$laporanPengiriman) {
                  return back()->with('warning', 'Maaf kode Transaksi tidak di temukan');
               }

               $updateData = [
                  'tgl_pengiriman' => $request->tglPengiriman,
                  'nm_supir' => $request->nmSupir,
                  'ketersediaan_truck' => $request->ketersediaanTruck,
                  'user_armada' => auth()->user()->username,
               ];

               $file = $request->file('fotoTruck');
               if ($file) {
                  $request->validate([
                     'fotoTruck'  => 'required|image|mimes:jpeg,jpg,png|max:1204',
                  ]);

                  $fileName =  $request->kdLaporan . '_' . time() . '.' . $file->getClientOriginalExtension();
                  $file->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $updateData['foto_truck'] = $fileName;
               }

               LaporanPengiriman::where('kd_laporan', $request->kdLaporan)->update($updateData);
               break;

            default:
               return to_route('/')->with('danger', 'Hmmmm,,,,!!!!!!');
               break;
         }
         DB::commit();
         return back()->with('success', 'Data Berhasil Di Simpan');
      } catch (\Throwable $th) {
         DB::rollBack();
         return back()->with('dangerCard', 'Maaf Data Gagal Disimpan ' . $th->getMessage());
      }
   }

   public function downloadFile($id1, $id2)
   {
      $kdLaporan = decrypt($id1);
      $nmFile = decrypt($id2);

      $laporanPengiriman = LaporanPengiriman::where('kd_laporan', $kdLaporan)->first();

      if (!$laporanPengiriman) {
         return back()->with('warning', 'Maaf kode Transaksi tidak di temukan');
      }

      $filePath = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->surat_penugasan}");

      if (file_exists($filePath)) {
         return response()->download($filePath);
      } else {
         return redirect()->back()->with('error', 'File tidak ditemukan.');
      }
   }
}
