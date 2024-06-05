<?php

use App\Models\CounterNo;
use App\Models\MenuDetail;
use App\Models\MstCounter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (!function_exists('autoCode')) {
   function autoCode($kode)
   {
      DB::beginTransaction();
      try {
         if (strlen($kode) == 3) {
            $substrKarakter = '-4';
         } else if (strlen($kode) == 2) {
            $substrKarakter = '-5';
         }

         $no = "100000";
         $mstCount = MstCounter::where('kd_counter', $kode)->first();

         if (!$mstCount) {
            return 'XXXXXXX';
         }

         $tambah = MstCounter::where('kd_counter', $kode)->first()->update(['no_counter' => $mstCount->no_counter + 1]);
         $nomor = MstCounter::where('kd_counter', $kode)->value('no_counter');

         if ($tambah === 0) {
            throw new \Exception("Data tidak di temukan");
         }

         $data = $no + $nomor;
         $nobukti = $kode . substr($data, $substrKarakter);

         DB::commit();

         return $nobukti;
      } catch (\Throwable $th) {
         DB::rollBack();
         return 'XXXXXXX';
      }
   }

   // function autoCodeOld($kode)
   // {
   //    $karakter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   //    $panjangKarakter = strlen($karakter);
   //    $kode_wedding = '';
   //    for ($i = 0; $i < 5; $i++) {
   //       $kode_wedding .= $karakter[rand(0, $panjangKarakter - 1)];
   //    }
   //    return $kode . $kode_wedding;
   // }
}

function title_url()
{
   $url = url()->current();
   $path = parse_url($url, PHP_URL_PATH);
   $path = ltrim($path, '/');
   $segments = explode('/', $path);
   $url1 = $segments[0];
   $dataTitle = MenuDetail::where('url', 'LIKE', '%' . $url1 . '%')->first()->title_name ?? '';
   return $dataTitle;
}

function noTransaksi($jenis)
{
   DB::beginTransaction();
   try {
      $tglNowCount = date('Y-m-d');

      if (strlen($jenis) == 3) {
         $substrKarakter = '-3';
      } else if (strlen($jenis) == 2) {
         $substrKarakter = '-4';
      }

      $no = "100000";
      if (CounterNo::where('tanggal', $tglNowCount)->where('jenis', $jenis)->first() == NULL) {
         $nomor = 1;
         $update = CounterNo::where('jenis', $jenis)->first()->update(['no_counter' => $nomor, 'tanggal' => date('Y-m-d')]);

         if ($update === 0) {
            throw new \Exception("Data tidak di temukan");
         }
      } else {
         $di = CounterNo::where('tanggal', $tglNowCount)->where('jenis', $jenis)->first();
         $tambah = CounterNo::where('tanggal', $tglNowCount)->where('jenis', $jenis)->first()->update(['no_counter' => $di->no_counter + 1]);
         $nomor = CounterNo::where('tanggal', $tglNowCount)->where('jenis', $jenis)->orderBy('no_counter', 'desc')->value('no_counter');

         if ($tambah === 0) {
            throw new \Exception("Data tidak di temukan");
         }
      }

      $data = $no + $nomor;
      $nobukti = $jenis . Carbon::parse($tglNowCount)->translatedFormat('ymd') . substr($data, $substrKarakter);

      DB::commit();

      return $nobukti;
   } catch (\Throwable $th) {
      DB::rollBack();
      return null;
   }
}
