<?php

namespace App\Http\Controllers;

use App\Models\SettingApps;
use App\Models\UserData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
      $data['titleForm'] = title_url();
      $data['appGambar'] = SettingApps::where('jenis', 'appFoto')->first();
      $data['userData'] = new UserData();

      return view('admin.dashboard', $data);
   }

   public function comingSoon()
   {
      $data['titleForm'] = title_url();

      return view('admin.comingsoon', $data);
   }

   public function maintanance()
   {
      $data['titleForm'] = title_url();

      return view('admin.maintanance', $data);
   }
}
