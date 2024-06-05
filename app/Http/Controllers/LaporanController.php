<?php

namespace App\Http\Controllers;

use App\Models\AnggaranDetail;
use App\Models\AnggaranHeader;
use App\Models\InventarisBarang;
use App\Models\MstBarang;
use App\Models\SettingApps;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function index()
   {
      $data['titleForm'] = title_url();

      return view('admin.comingsoon', $data);
   }

   // public function lapMstBarang()
   // {
   //    $data['titleForm'] = title_url();
   //    $data['mstBarang'] = MstBarang::get();

   //    return view('admin.laporan.master_barang', $data);
   // }
}
