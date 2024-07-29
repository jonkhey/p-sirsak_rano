<?php

namespace App\Http\Controllers;

use App\Models\LaporanPengiriman;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PelaporanController extends Controller
{
   public function index()
   {
      return to_route('/')->with('danger', 'Loo Looo Gak Bahaya Taaaa !!!');
   }

   public function pelaporanPengiriman()
   {
      $data['titleForm'] = title_url();
      $data['laporanPengiriman'] = LaporanPengiriman::where('is_hapus', 0)->orderBy('tgl_laporan', 'desc')->get();
      $data['noTelp'] = UserData::where('kd_role', 'RL00003')->first()->no_telp;

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
                  // 'no_kontainer' => $request->noKontainer,
                  // 'si'           => $request->si,
                  'keterangan_laporan' => $request->keterangan,
                  'user_laporan' => auth()->user()->username,

                  'tgl_pengiriman' => $request->tglPengiriman,
                  'nm_supir' => $request->nmSupir,
                  'ketersediaan_truck' => $request->ketersediaanTruck,
                  'user_armada' => auth()->user()->username,
                  'nomor_pelat' => $request->nomorPelat,
               ];

               $fileSI = $request->file('si');
               if ($fileSI) {
                  $request->validate([
                     'si'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $noTrans . '-SI_' . time() . '.' . $fileSI->getClientOriginalExtension();
                  $fileSI->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $laporanPengiriman['si'] = $fileName;
               }

               $fileNoKontainer = $request->file('noKontainer');
               if ($fileNoKontainer) {
                  $request->validate([
                     'noKontainer'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $noTrans . '-NK_' . time() . '.' . $fileNoKontainer->getClientOriginalExtension();
                  $fileNoKontainer->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $laporanPengiriman['no_kontainer'] = $fileName;
               }

               $fileSuratPenugasan = $request->file('suratPenugasan');
               if ($fileSuratPenugasan) {
                  $request->validate([
                     'suratPenugasan'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $noTrans . '-SP_' . time() . '.' . $fileSuratPenugasan->getClientOriginalExtension();
                  $fileSuratPenugasan->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $laporanPengiriman['surat_penugasan'] = $fileName;
               }

               $fileFotoTruck = $request->file('fotoTruck');
               if ($fileFotoTruck) {
                  $request->validate([
                     'fotoTruck'  => 'required|image|mimes:jpeg,jpg,png|max:1204',
                  ]);

                  $fileName =  $noTrans . '-FT_' . time() . '.' . $fileFotoTruck->getClientOriginalExtension();
                  $fileFotoTruck->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $laporanPengiriman['foto_truck'] = $fileName;
               }

               LaporanPengiriman::create($laporanPengiriman);
               break;

            case 'editPelaporan':
               $laporanPengiriman = LaporanPengiriman::where('kd_laporan', $request->kdLaporan)->first();

               if (!$laporanPengiriman) {
                  return back()->with('warning', 'Maaf kode Transaksi tidak di temukan');
               }

               $updateData = [
                  'tgl_laporan'  => $request->tglLaporan,
                  // 'no_kontainer' => $request->noKontainer,
                  // 'si'           => $request->si,
                  'keterangan_laporan' => $request->keterangan,
                  'user_laporan' => auth()->user()->username,

                  'tgl_pengiriman' => $request->tglPengiriman,
                  'nm_supir' => $request->nmSupir,
                  'ketersediaan_truck' => $request->ketersediaanTruck,
                  'user_armada' => auth()->user()->username,
                  'nomor_pelat' => $request->nomorPelat,
               ];

               $fileSI = $request->file('si');
               if ($fileSI) {
                  $request->validate([
                     'si'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $request->kdLaporan . '-SI_' . time() . '.' . $fileSI->getClientOriginalExtension();
                  $fileSI->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $updateData['si'] = $fileName;
               }

               $fileNoKontainer = $request->file('noKontainer');
               if ($fileNoKontainer) {
                  $request->validate([
                     'noKontainer'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $request->kdLaporan . '-NK_' . time() . '.' . $fileNoKontainer->getClientOriginalExtension();
                  $fileNoKontainer->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $updateData['no_kontainer'] = $fileName;
               }

               $fileSuratPenugasan = $request->file('suratPenugasan');
               if ($fileSuratPenugasan) {
                  $request->validate([
                     'suratPenugasan'  => 'required|mimes:pdf|max:1204',
                  ]);

                  $fileName = $request->kdLaporan . '-SP_' . time() . '.' . $fileSuratPenugasan->getClientOriginalExtension();
                  $fileSuratPenugasan->storeAs('foto-lap-pengiriman', $fileName, 'public');

                  $updateData['surat_penugasan'] = $fileName;
               }

               $fileFotoTruck = $request->file('fotoTruck');
               if ($fileFotoTruck) {
                  $request->validate([
                     'fotoTruck'  => 'required|image|mimes:jpeg,jpg,png|max:1204',
                  ]);

                  $fileName =  $request->kdLaporan . '-FT_' . time() . '.' . $fileFotoTruck->getClientOriginalExtension();
                  $fileFotoTruck->storeAs('foto-lap-pengiriman', $fileName, 'public');

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
      $jnsFile = decrypt($id2);

      $laporanPengiriman = LaporanPengiriman::where('kd_laporan', $kdLaporan)->first();

      if (!$laporanPengiriman) {
         return back()->with('warning', 'Maaf kode Transaksi tidak di temukan');
      }

      switch ($jnsFile) {
         case 'si':
            $filePath = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->si}");
            break;

         case 'noKontainer':
            $filePath = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->no_kontainer}");
            break;

         case 'suratPenugasan':
            $filePath = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->surat_penugasan}");
            break;

         default:
            # code...
            break;
      }


      if (file_exists($filePath)) {
         return response()->download($filePath);
      } else {
         return redirect()->back()->with('dangerCard', 'File tidak ditemukan.');
      }
   }

   public function showFile($nmFolder, $filename)
   {
      $path = storage_path('app/public/' . $nmFolder . '/' . $filename);

      if (!File::exists($path)) {
         abort(404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
   }

   public function deletePelaporan(Request $request, $id1, $id2, $id3)
   {
      $kdLaporan = decrypt($id1);
      $nmFolder = decrypt($id2);
      $mode = decrypt($id3);

      $laporanPengiriman = LaporanPengiriman::where('kd_laporan', $kdLaporan)->first();

      if (!$laporanPengiriman) {
         return back()->with('warning', 'Maaf kode Transaksi tidak di temukan');
      }

      $fileSI = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->si}");
      $fileNoKontainer = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->no_kontainer}");
      $fileSuratPenugasan = storage_path("app/public/foto-lap-pengiriman/{$laporanPengiriman->surat_penugasan}");
      // $filePath = storage_path("app/public/uploads/{$fileHeader->nm_file}");

      DB::beginTransaction();
      try {
         (File::exists($fileSI)) ? unlink($fileSI) : '';
         (File::exists($fileNoKontainer)) ? unlink($fileNoKontainer) : '';
         (File::exists($fileSuratPenugasan)) ? unlink($fileSuratPenugasan) : '';
         $laporanPengiriman->update(['is_hapus' => 1]);

         ########## Save Logs ##########################################################################
         $dataAksi = ['id1' => $id1, 'id2' => $id2, 'id3' => $id3];
         saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($dataAksi));
         ###############################################################################################
         DB::commit();
         return back()->with('success', 'Data Berhasil DiHapus');
      } catch (\Throwable $th) {
         DB::rollBack();
         return back()->with('dangerCard', 'Maaf Data Gagal DiHapus ' . $th->getMessage());
      }
   }
}
