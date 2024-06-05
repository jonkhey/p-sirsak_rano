<?php

namespace App\Http\Controllers;

use App\Models\MenuAccess;
use App\Models\MenuDetail;
use App\Models\MenuHeader;
use App\Models\MstAgama;
use App\Models\MstJenis;
use App\Models\MstKanal;
use App\Models\MstKelompok;
use App\Models\MstKondisi;
use App\Models\MstRoles;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterController extends Controller
{
   public function index()
   {
      return to_route('/')->with('danger', 'Loo Looo Gak Bahaya Taaaa !!!');
   }

   public function masterUser()
   {
      $data['titleForm'] = title_url();
      $userDataModel = UserData::orderBy('kd_role', 'asc')->get();
      $userData = [];
      foreach ($userDataModel as $rs) {
         $userData[] = [
            'id'           => $rs->id,
            'noKtp'        => $rs->no_ktp,
            'nama'         => $rs->nama,
            'tempatLahir'  => $rs->tempat_lahir,
            'tanggalLahir' => $rs->tanggal_lahir,
            'jk'           => $rs->jk,
            'noTelp'       => $rs->no_telp,
            'kdRole'       => $rs->kd_role,
            'nmRole'       => $rs->joinMstRoles->nm_role,
            'urutRole'     => $rs->joinMstRoles->urutan_role,
         ];
      }

      $data['userData'] = $userData;

      return view('admin.master.master_user', $data);
   }

   public function vmUser($id1, $id2)
   {
      $data['dataMode'] = $id1;
      $data['userData'] = UserData::find($id2);
      $data['rsAgama'] = MstAgama::get();
      $data['rsRoles'] = MstRoles::get();

      return view('admin.master.vm_user', $data);
   }

   public function vmHakAkses($id1, $id2)
   {
      $data['dataMode'] = $id1;
      $data['userData'] = UserData::find($id2);
      $users = User::where('user_id', $id2)->first();
      if ($users) {
         $data['users'] = User::where('user_id', $id2)->first();
      } else {
         $data['users'] = [];
      }

      $data['menuHeader'] = MenuHeader::select('menu_id', 'menu_nama')->where('is_active', 1)->where('is_detail', 0)->get();
      $data['menuDetail'] = MenuDetail::select('menu_id', 'detail_id', 'title')->where('is_active', 1)->get();

      return view('admin.master.vm_hak_akses', $data);
   }

   public function vtHakAkses($id1, $id2 = '')
   {
      $userData = UserData::find($id1);
      if (!$userData) {
         return "Data Tidak Di Temukan";
      }

      $menuAccessM = MenuAccess::where('user_id', $id2)->get();
      if (!$menuAccessM) {
         return "Data Akses Belum Ada";
      }

      $menuAccess = [];
      foreach ($menuAccessM as $rs) {
         $menuAccess[] = [
            'userName'     => $rs->user_id,
            'menuId'       => $rs->menu_id,
            'menuName'     => MenuHeader::where('menu_id', $rs->menu_id)->first()->menu_nama ?? '',
            'detailId'     => $rs->detail_id,
            'detailName'   => MenuDetail::where('detail_id', $rs->detail_id)->first()->title ?? '',
         ];
      }

      $data['menuAccess'] = $menuAccess;

      return view('admin.master.vt_hak_akses', $data);
   }

   public function hapusHakAkses(Request $request, $id1, $id2, $id3 = '')
   {
      $menuAccess = MenuAccess::where('user_id', $id1)->where('menu_id', $id2)->where('detail_id', $id3)->first();
      if (!$menuAccess) {
         return response()->json(['warning' => 'Data Tidak Ditemukan'], 201);
      }

      ########## Save Logs ##########################################################################
      $dataAksi = ['id1' => $id1, 'id2' => $id2, 'id3' => $id3];
      saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($dataAksi));
      ###############################################################################################

      MenuAccess::where('user_id', $id1)->where('menu_id', $id2)->where('detail_id', $id3)->delete();

      return response()->json(['success' => 'Data Berhasil Dihapus'], 200);
   }

   public function saveHakAkses(Request $request)
   {
      $request->validate([
         'dataMode'  => ['required'],
         'dataUSer'  => ['required', 'numeric'],
         'userName'  => ['required'],
         'kdMenu'    => ['required'],
      ]);

      $cekUser = UserData::where('id', $request->dataUSer)->first();
      if (!$cekUser) {
         return response()->json(['warning' => 'Data Tidak Ditemukan'], 201);
      }

      $jenisMenu = substr($request->kdMenu, 0, 2);
      $kodeMenu = substr($request->kdMenu, 2);

      DB::beginTransaction();
      try {
         ########## Save Logs ##########################################################################
         saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
         ###############################################################################################

         User::updateOrCreate([
            'user_id'      => $request->dataUSer,
         ], [
            'username'     => $request->userName,
            'email'        => '-',
            'password'     => '',   // Hash::make($request->password)
            'is_active'    => 1,
         ]);

         if ($request->password) {
            User::where('user_id', $request->dataUSer)->update(['password' => Hash::make($request->password)]);
         }

         if ($jenisMenu == '##') {
            $menuHeader = MenuHeader::where('menu_id', $kodeMenu)->first();
            if (!$menuHeader) {
               return response()->json(['warning' => 'Data kode tidak ditemukan'], 200);
            }

            MenuAccess::updateOrCreate([
               'user_id'      => $request->userName,
               'menu_id'      => $kodeMenu,
               'detail_id'    => '',
            ], [
               'is_active'    => 1,
            ]);
         } elseif ($jenisMenu == '&&') {
            $menuAccess = MenuAccess::where('user_id', $request->userName)->where('detail_id', $kodeMenu)->first();
            if ($menuAccess) {
               return response()->json(['warning' => 'Data sudah pernah disimpan'], 200);
            }

            $menuDetail = MenuDetail::where('detail_id', $kodeMenu)->first();
            if (!$menuDetail) {
               return response()->json(['warning' => 'Data kode tidak ditemukan'], 200);
            }

            MenuAccess::updateOrCreate([
               'user_id'      => $request->userName,
               'menu_id'      => $menuDetail->menu_id,
               'detail_id'    => $menuDetail->detail_id
            ], [
               'is_active'    => 1,
            ]);
         } else {
            return response()->json(['warning' => 'Jenis Kode Tidak Di Temukan'], 201);
         }

         DB::commit();
         return response()->json(['success' => 'Data Berhasil Disimpan'], 200);
      } catch (\Throwable $th) {
         DB::rollBack();
         return response()->json(['warning' => 'Maaf Data Gagal Disimpan ' . $th->getMessage()], 201);
      }
   }

   public function saveMasterUser(Request $request)
   {
      $request->validate([
         'nmUser'    => ['required'],
         'tmpLahir'  => ['required'],
         'tglLahir'  => ['required', 'date'],
         'jk'        => ['required', 'size:1'],
         'kdAgama'   => ['required', 'size:3'],
         'alamat'    => ['required'],
         'fotoUser'  => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
      ]);

      // if ($request->dataMode == 'addUser') {
      //    $request->validate([
      //       'password'  => ['required', 'min:3'],
      //    ]);
      // }

      if ($request->dataMode == 'editUser') {
         $request->validate([
            'idUser'  => ['required', 'numeric'],
         ]);
      }

      switch ($request->dataMode) {
         case 'addUser':
            DB::beginTransaction();
            try {
               ########## Save Logs ##########################################################################
               saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
               ###############################################################################################

               // $cekUserName = User::where('username', $userName)->first();
               // if ($cekUserName) {
               //    return back()->with('dangerCard', 'Username atau email sudah di pakai, harap gunakan yang lain');
               // }

               $userData = UserData::create([
                  'no_ktp'       => $request->noKtp,
                  'no_kk'        => $request->noKK,
                  'nama'         => $request->nmUser,
                  'tempat_lahir' => $request->tmpLahir,
                  'tanggal_lahir'   => $request->tglLahir,
                  'jk'           => $request->jk,
                  'kd_agama'     => $request->kdAgama,
                  'no_telp'      => $request->noTelp,
                  'alamat'       => $request->alamat,
                  'status'       => 1,
                  'kd_role'      => $request->kdRole,
               ]);

               if ($file = $request->file('fotoUser')) {
                  $input['image'] = base64_encode(file_get_contents($file));
                  UserData::where('id', $userData->id)->update($input);
               }

               // User::insert([
               //    'user_id'      => $userData->id,
               //    'username'     => '-',
               //    'email'        => '-',
               //    'password'     => '',   // Hash::make($request->password)
               //    'role_id'      => 2,
               //    'is_active'    => 1,
               // ]);

               DB::commit();
               return back()->with('successCard', 'Data Berhasil Disimpan');
            } catch (\Throwable $th) {
               DB::rollBack();
               return back()->with('dangerCard', 'Maaf Data Gagal Disimpan ' . $th->getMessage());
            }
            break;

         case 'editUser':
            DB::beginTransaction();
            try {
               ########## Save Logs ##########################################################################
               saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
               ###############################################################################################

               $UserData = UserData::where('id', $request->idUser)->first();
               $UserData->update([
                  'no_ktp'       => $request->noKtp,
                  'no_kk'        => $request->noKK,
                  'nama'         => $request->nmUser,
                  'tempat_lahir' => $request->tmpLahir,
                  'tanggal_lahir'   => $request->tglLahir,
                  'jk'           => $request->jk,
                  'kd_agama'     => $request->kdAgama,
                  'no_telp'      => $request->noTelp,
                  'alamat'       => $request->alamat,
                  'status'       => 1,
                  'kd_role'      => $request->kdRole,
               ]);

               if ($file = $request->file('fotoUser')) {
                  $input['image'] = base64_encode(file_get_contents($file));
                  UserData::where('id', $request->idUser)->update($input);
               }

               // $User = User::where('user_id', $request->idUser)->first();
               // $User->update([
               //    'username'     => '-',
               //    'email'        => '-',
               //    'role_id'      => $request->roleId,
               //    'is_active'    => $request->status,
               // ]);

               // if ($request->password) {
               //    User::where('user_id', $request->idUser)->update(['password' => Hash::make($request->password)]);
               // }

               DB::commit();
               return back()->with('successCard', 'Data Berhasil Disimpan');
            } catch (\Throwable $th) {
               DB::rollBack();
               return back()->with('dangerCard', 'Maaf Data Gagal Disimpan ' . $th->getMessage());
            }
            break;

         default:
            return to_route('app_settings')->with('danger', 'Hmmmm,,,,!!!!!!');
            break;
      }
   }

   public function masterRole()
   {
      $data['titleForm'] = title_url();
      $data['mstRole'] = MstRoles::get();

      return view('admin.master.master_role', $data);
   }

   public function vmRole($id1, $id2)
   {
      $data['dataMode'] = $id1;
      if ($id1 == 'editRole') {
         $data['dataRole'] = MstRoles::find($id2);
      }

      return view('admin.master.vm_role', $data);
   }

   public function saveMasterRole(Request $request)
   {
      $request->validate([
         'kdRole'  => ['required'],
         'nmRole'  => ['required'],
         'isActive'     => ['required', 'size:1'],
      ]);

      switch ($request->dataMode) {
         case 'addRole':
            $kdRole = autoCode('RL');
            $cekKode = MstRoles::find($kdRole);
            if ($cekKode) {
               $kdRole = autoCode('RL');
            }

            break;

         case 'editRole':
            $kdRole = $request->kdRole;
            $cekData = MstRoles::find($kdRole);
            if (!$cekData) {
               return to_route('mst_role')->with('warningCard', 'Maaf kode tidak di kenali, harap di ulangi');
            }

            break;

         default:
            return to_route('/')->with('danger', 'Hmmmm,,,,!!!!!!');
            break;
      }

      DB::beginTransaction();
      try {
         ########## Save Logs ##########################################################################
         saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
         ###############################################################################################

         MstRoles::updateOrCreate([
            'kd_role'   => $kdRole,
         ], [
            'nm_role'   => $request->nmRole,
            'urutan_role'  => $request->urutanRole,
            'is_active' => $request->isActive,
         ]);

         DB::commit();
         return back()->with('success', 'Data Berhasil Disimpan');
      } catch (\Throwable $th) {
         DB::rollBack();
         return back()->with('dangerCard', 'Maaf Data Gagal Disimpan ' . $th->getMessage());
      }
   }
}
