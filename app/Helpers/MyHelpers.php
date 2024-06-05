<?php

use App\Models\DataLog;
use Stevebauman\Location\Facades\Location;

if (!function_exists('bulan')) {
   function bulan1($bulan)
   {
      switch ($bulan) {
         case 1:
            $bulan = "Januari";
            break;
         case 2:
            $bulan = "Februari";
            break;
         case 3:
            $bulan = "Maret";
            break;
         case 4:
            $bulan = "April";
            break;
         case 5:
            $bulan = "Mei";
            break;
         case 6:
            $bulan = "Juni";
            break;
         case 7:
            $bulan = "Juli";
            break;
         case 8:
            $bulan = "Agustus";
            break;
         case 9:
            $bulan = "September";
            break;
         case 10:
            $bulan = "Oktober";
            break;
         case 11:
            $bulan = "November";
            break;
         case 12:
            $bulan = "Desember";
            break;
         default:
            $bulan = Date('F');
            break;
      }
      return $bulan;
   }
}

if (!function_exists('bulan')) {
   function bulan2($bulan)
   {
      switch ($bulan) {
         case 1:
            $bulan = "Jan";
            break;
         case 2:
            $bulan = "Feb";
            break;
         case 3:
            $bulan = "Mar";
            break;
         case 4:
            $bulan = "Apr";
            break;
         case 5:
            $bulan = "Mei";
            break;
         case 6:
            $bulan = "Jun";
            break;
         case 7:
            $bulan = "Jul";
            break;
         case 8:
            $bulan = "Agu";
            break;
         case 9:
            $bulan = "Sep";
            break;
         case 10:
            $bulan = "Okt";
            break;
         case 11:
            $bulan = "Nov";
            break;
         case 12:
            $bulan = "Des";
            break;
         default:
            $bulan = Date('F');
            break;
      }
      return $bulan;
   }
}

if (!function_exists('bulan')) {
   function bulan3($bulan)
   {
      switch ($bulan) {
         case 1:
            $bulan = "01";
            break;
         case 2:
            $bulan = "02";
            break;
         case 3:
            $bulan = "03";
            break;
         case 4:
            $bulan = "04";
            break;
         case 5:
            $bulan = "05";
            break;
         case 6:
            $bulan = "06";
            break;
         case 7:
            $bulan = "07";
            break;
         case 8:
            $bulan = "08";
            break;
         case 9:
            $bulan = "09";
            break;
         case 10:
            $bulan = "10";
            break;
         case 11:
            $bulan = "11";
            break;
         case 12:
            $bulan = "12";
            break;
         default:
            $bulan = Date('F');
            break;
      }
      return $bulan;
   }
}

if (!function_exists('tanggal')) {
   function tanggal($tanggal)
   {
      $a = explode('-', $tanggal);
      $tanggal = $a['2'] . " " . bulan1($a['1']) . " " . $a['0'];
      return $tanggal;
   }
}

if (!function_exists('tanggalK')) {
   function tanggalK($tanggal)
   {
      $a = explode('-', $tanggal);
      $tanggal = $a['2'] . " " . bulan2($a['1']) . " " . $a['0'];
      return $tanggal;
   }
}

if (!function_exists('tanggalS')) {
   function tanggalS($tanggal)
   {
      $a = explode('-', $tanggal);
      $tanggal = $a['2'] . "-" . bulan3($a['1']) . "-" . $a['0'];
      return $tanggal;
   }
}

if (!function_exists('hitung_umur')) {
   function hitung_umur($tgl_lahir, $tgl_now)
   {
      $tanggal = new DateTime($tgl_lahir);
      $today = new DateTime($tgl_now);
      $y = $today->diff($tanggal)->y;
      $m = $today->diff($tanggal)->m;
      $d = $today->diff($tanggal)->d;
      return $y . " thn " . $m . " bln " . $d . " hr";
   }
}

function namahari($tanggal)
{
   $tgl = substr($tanggal, 8, 2);
   $bln = substr($tanggal, 5, 2);
   $thn = substr($tanggal, 0, 4);

   $info = date('w', mktime(0, 0, 0, $bln, $tgl, $thn));

   switch ($info) {
      case '0':
         return "Minggu";
         break;
      case '1':
         return "Senin";
         break;
      case '2':
         return "Selasa";
         break;
      case '3':
         return "Rabu";
         break;
      case '4':
         return "Kamis";
         break;
      case '5':
         return "Jumat";
         break;
      case '6':
         return "Sabtu";
         break;
   };
}

function bln_romawi($bulan)
{
   if ($bulan == '01') {
      return 'I';
   } else if ($bulan == '02') {
      return 'II';
   } else if ($bulan == '03') {
      return 'III';
   } else if ($bulan == '04') {
      return 'IV';
   } else if ($bulan == '05') {
      return 'V';
   } else if ($bulan == '06') {
      return 'VI';
   } else if ($bulan == '07') {
      return 'VII';
   } else if ($bulan == '08') {
      return 'VIII';
   } else if ($bulan == '09') {
      return 'IX';
   } else if ($bulan == '10') {
      return 'X';
   } else if ($bulan == '11') {
      return 'XI';
   } else if ($bulan == '12') {
      return 'XII';
   } else {
      return 'Error';
   }
}

// ----------------------------------------------------------------------------
function rupiah($angka)
{
   $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.') . ',-';
   return $hasil_rupiah;
}

function pembulatan($angka)
{
   $hasil_pembulatan = round($angka / 100) * 100;
   if ($hasil_pembulatan < 100) {
      $hasil_fix = 100;
   } else {
      $hasil_fix = $hasil_pembulatan;
   }
   return $hasil_fix;
}

function format_indo($angka)
{
   $hasil_format = number_format($angka, 0, ',', '.');
   return $hasil_format;
}

function saveLogs($userId, $ipAddress, $location, $function, $noBukti, $dataAksi)
{
   DataLog::create([
      'kd_user'         => $userId,
      'ip'              => $ipAddress,
      'location'        => $location,
      'function'        => $function,
      'nobuktitransaksi'   => $noBukti,
      'aksi'               => $dataAksi,
   ]);
}

function getLocationInfo()
{
   try {
      $ip = request()->ip();
      return Location::get($ip);
   } catch (Exception $e) {
      return 'Terjadi kesalahan: ' . $e->getMessage();
   }
}
