<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function index()
   {
      return view('auth.login');
   }

   public function _login(Request $request)
   {
      $request->validate([
         'username' => ['required'],
         'password' => ['required'],
      ]);

      $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();

      if (!Hash::check($request->password, $user?->password)) {
         saveLogs($request->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', 'Login PS | ' . $request->username . ' | ' . $request->password);

         return back()->with('dangerCard', 'Login gagal, cek kembali username dan password Anda!');
      }

      if (!$user) {
         saveLogs($request->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', 'Login US | ' . $request->username);

         return back()->with('dangerCard', 'Login gagal, cek kembali username dan password Anda!');
      }

      if (!$user->is_active) {
         saveLogs($request->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', 'Login NA | ' . $request->username);

         return back()->with('dangerCard', 'Akun anda sudah di nonaktifkan, silahkan hubungi admin');
      }

      saveLogs($request->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', 'Login OK | ' . $request->username);

      $request->session()->regenerate();
      auth()->login($user);
      return redirect()->intended('/');
   }

   public function logout(Request $request)
   {
      ########## Save Logs ##########################################################################
      saveLogs(auth()->user()->username, $request->ip(), json_encode(getLocationInfo()), __FUNCTION__, '-', json_encode($request->all()));
      ###############################################################################################

      auth()->guard('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return to_route('login');
   }
}
