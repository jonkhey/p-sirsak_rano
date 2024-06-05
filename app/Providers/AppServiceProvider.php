<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    */
   public function register(): void
   {
      //
   }

   /**
    * Bootstrap any application services.
    */
   public function boot(): void
   {
      try {
         DB::connection()->getPdo();

         $profilApp = null;
         $styleApp = null;
         try {
            $profilApp = \App\Models\SettingApps::find('appProfil');
            $styleApp = \App\Models\SettingApps::find('appStyle');
         } catch (\Throwable $th) {
         }
         \Carbon\Carbon::setLocale('id');
         config(['app.locale' => 'id']);
         $timezone_map = [
            '7' => 'Asia/Jakarta',
            '8' => 'Asia/Makassar',
            '9' => 'Asia/Jayapura',
         ];
         if ($profilApp && $styleApp) {
            date_default_timezone_set($timezone_map[$profilApp->value_11]);
            \Illuminate\Support\Facades\View::share('profilApp', $profilApp);
            \Illuminate\Support\Facades\View::share('styleApp', $styleApp);
         }
      } catch (\Exception $e) {
         abort(503, 'Koneksi database gagal : ' . $e->getMessage());
      }
   }
}
