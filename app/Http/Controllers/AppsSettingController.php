<?php

namespace App\Http\Controllers;

use App\Models\MstAgama;
use App\Models\MstRoles;
use App\Models\SettingApps;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppsSettingController extends Controller
{
   public function index()
   {
      $data['title'] = 'Pengaturan Aplikasi';
      $data['zonaWaktu'] = ['7' => '+7 (WIB)', '8' => '+8 (WITA)', '9' => '+9 (WIT)'];
      $data['appProfil'] = SettingApps::find('appProfil');
      $data['appStyle'] = SettingApps::find('appStyle');

      $data['colorApps'] = [
         ''          => 'Default',
         'primary'   => 'Primary',
         'secondary' => 'Secondary',
         'info'      => 'Info',
         'success'   => 'Success',
         'danger'    => 'Danger',
         'indigo'    => 'Indigo',
         'purple'    => 'Purple',
         'pink'      => 'Pink',
         'navy'      => 'Navy',
         'lightblue' => 'Lightblue',
         'teal'      => 'Teal',
         'cyan'      => 'Cyan',
         'dark'      => 'Dark',
         'gray-dark' => 'Gray Dark',
         'gray'      => 'Gray',
         'light'     => 'Light',
         'warning'   => 'Warning',
         'white'     => 'White',
         'orange'    => 'Orange',
      ];

      $data['cardColor'] = [
         ''          => 'Default',
         'primary'   => 'Primary',
         'secondary' => 'Secondary',
         'info'      => 'Info',
         'success'   => 'Success',
         'danger'    => 'Danger',
         'dark'      => 'Dark',
         'muted'     => 'Muted',
         'light'     => 'Light',
         'warning'   => 'Warning',
         'white'     => 'White',
      ];

      $userDataModel = UserData::orderBy('nama', 'asc')->get();
      $userData = [];
      foreach ($userDataModel as $rs) {
         $userData[] = [
            'id'        => $rs->id,
            'noKtp'     => $rs->no_ktp,
            'nama'      => $rs->nama,
            'tempatLahir'  => $rs->tempat_lahir,
            'tanggalLahir' => $rs->tanggal_lahir,
            'jk'        => $rs->jk,
            'agama'     => $rs->joinMstAgama->nm_agama,
            'noTelp'    => $rs->no_telp,
            'alamat'    => $rs->alamat,
            'image'     => $rs->image,
            'status'    => $rs->status,
         ];
      }

      $data['userData'] = $userData;

      return view('_app-settings.app_settings', $data);
   }

   public function editProfilePerusahaan(Request $request)
   {
      $getAppProfil = SettingApps::find('appProfil');

      $request->validate([
         'logoPerusahaan' => ['image', 'mimes:png,jpg,jpeg'],
      ]);

      $items = explode(",", $request->items);
      $input = [
         "value_1"   => $request->nmPerusahaan,
         "value_2"   => $request->insPerusahaan,
         "value_3"   => $request->alamat,
         "value_4"   => $request->kelurahan,
         "value_5"   => $request->kecamatan,
         "value_6"   => $request->kabupaten,
         "value_7"   => $request->provinsi,
         "value_8"   => $request->noTelp,
         "value_9"   => $request->noTelp2,
         "value_10"  => $request->motto,
         "value_11"  => $request->timeZone,
         "value_12"  => $request->footer,
         'items'     => json_encode($items),
      ];
      if ($file = $request->file('logoPerusahaan')) {
         // $file_name = $file->getClientOriginalName();
         // $file->move(public_path('/frontend/images/favicon'), $file_name);
         // $input['pict'] = $file_name;

         $input['pict'] = base64_encode(file_get_contents($file));
      }

      ########## Save Logs ##########################################################################
      saveLogs('-', $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
      ###############################################################################################

      $getAppProfil->update($input);
      return to_route('app_settings')->with('success', 'Pengaturan profile berhasil diubah!');
   }

   public function editStylePerusahaan(Request $request)
   {
      $getAppStyle = SettingApps::find('appStyle');

      $input = [
         "value_1"   => $request->darkMode ? 'dark-mode' : null,
         "value_2"   => $request->smallText ? 'text-sm' : null,
         "value_3"   => $request->appsColor ? 'bg-' . $request->appsColor : null,
         "value_4"   => $request->appsColor ? 'bg-' . $request->appsColor : null,
         "value_5"   => $request->appsColor ? 'sidebar-light-' . $request->appsColor : null,
         "value_6"   => $request->sbCollapse ? 'sidebar-collapse' : null,
         // "value_7"   => $request->sbChillIndent? 'sidebar-collapse' :null,
         "value_8"   => $request->sbFlat ? 'nav-flat' : null,
         "value_9"   => $request->ftFixed ? 'layout-footer-fixed' : null,
         "value_10"  => $request->cardColor,
         "value_11"  => $request->preLoader,
         "value_12"  => $request->topNav,
      ];

      ########## Save Logs ##########################################################################
      saveLogs('-', $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
      ###############################################################################################

      $getAppStyle->update($input);
      return to_route('app_settings')->with('success', 'Pengaturan profile berhasil diubah!');
   }

   public function vmUser($id1, $id2)
   {
      $data['dataMode'] = $id1;
      $data['userData'] = UserData::find($id2);
      $data['rsAgama'] = MstAgama::get();
      $data['rsRoles'] = MstRoles::get();

      return view('_app-settings.vm_user', $data);
   }

   public function aksiUser(Request $request)
   {
      $request->validate([
         'nmUser'    => ['required'],
         'tmpLahir'  => ['required'],
         'tglLahir'  => ['required', 'date'],
         'jk'        => ['required', 'size:1'],
         'agama'     => ['required', 'size:3'],
         'alamat'    => ['required'],
         'userName'  => ['required', 'max:10'],
         'roleId'    => ['required', 'numeric', 'max:2'],
         'status'    => ['required', 'numeric', 'size:1'],
      ]);

      if ($request->dataMode == 'addUser') {
         $request->validate([
            'password'  => ['required', 'min:3'],
         ]);
      }

      if ($request->dataMode == 'editUser') {
         $request->validate([
            'idUser'  => ['required', 'numeric'],
         ]);
      }

      $userName = $request->userName;
      $email = $request->email;

      DB::beginTransaction();
      try {
         ########## Save Logs ##########################################################################
         saveLogs($userName, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
         ###############################################################################################

         switch ($request->dataMode) {
            case 'addUser':
               $cekUserName = User::where('username', $userName)->first();
               if ($cekUserName) {
                  return back()->with('dangerCard', 'Username atau email sudah di pakai, harap gunakan yang lain');
               }

               $id = UserData::insertGetId([
                  'no_ktp'       => $request->noKtp,
                  'nama'         => $request->nmUser,
                  'tempat_lahir' => $request->tmpLahir,
                  'tanggal_lahir'   => $request->tglLahir,
                  'jk'           => $request->jk,
                  'agama'        => $request->agama,
                  'no_telp'      => $request->noTelp,
                  'alamat'       => $request->alamat,
                  'status'       => $request->status,
               ]);

               if ($file = $request->file('fotoUser')) {
                  $input['image'] = base64_encode(file_get_contents($file));
                  UserData::where('id', $id)->update($input);
               }

               User::insert([
                  'user_id'      => $id,
                  'username'     => $userName,
                  'email'        => $email,
                  'password'     => Hash::make($request->password),
                  'role_id'      => $request->roleId,
                  'is_active'    => $request->status,
               ]);
               break;

            case 'editUser':

               $UserData = UserData::where('id', $request->idUser)->first();
               $UserData->update([
                  'no_ktp'       => $request->noKtp,
                  'nama'         => $request->nmUser,
                  'tempat_lahir' => $request->tmpLahir,
                  'tanggal_lahir'   => $request->tglLahir,
                  'jk'           => $request->jk,
                  'agama'        => $request->agama,
                  'no_telp'      => $request->noTelp,
                  'alamat'       => $request->alamat,
                  'status'       => $request->status,
               ]);

               if ($file = $request->file('fotoUser')) {
                  $input['image'] = base64_encode(file_get_contents($file));
                  UserData::where('id', $request->idUser)->update($input);
               }

               $User = User::where('user_id', $request->idUser)->first();
               $User->update([
                  'username'     => $userName,
                  'email'        => $email,
                  'role_id'      => $request->roleId,
                  'is_active'    => $request->status,
               ]);

               if ($request->password) {
                  User::where('user_id', $request->idUser)->update(['password' => Hash::make($request->password)]);
               }
               break;

            default:
               return to_route('app_settings')->with('danger', 'Hmmmm,,,,!!!!!!');
               break;
         }

         DB::commit();
         return back()->with('successCard', 'Data Berhasil Disimpan');
      } catch (\Throwable $th) {
         DB::rollBack();
         return back()->with('dangerCard', 'Maaf Data Gagal Disimpan ' . $th->getMessage());
      }
   }
}
