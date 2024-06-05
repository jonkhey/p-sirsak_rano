<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'user_id',
      'username',
      'email',
      'role_id',
      'is_active',
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
      'password',
      'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
   ];

   public function userData()
   {
      return UserData::where('id', auth()->user()->user_id)->first();
   }

   public function accessMenus()
   {
      return $this->hasMany(MenuAccess::class, 'user_id', 'role_id')->where('is_active', 1);
   }

   public function isCanAcces($idMenu)
   {
      return MenuAccess::where('user_id', auth()->user()->username)->where('detail_id', $idMenu)->where('is_active', 1)->first();
   }
}
