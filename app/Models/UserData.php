<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserData extends Model
{
   use HasFactory;

   protected $table = 'user_data';
   protected $guarded = ['id'];

   public function joinMstAgama(): BelongsTo
   {
      return $this->belongsTo(MstAgama::class, 'kd_agama', 'kd_agama');
   }

   public function joinUsers()
   {
      return $this->belongsTo(User::class, 'id', 'user_id');
   }

   public function joinMstRoles()
   {
      return $this->belongsTo(MstRoles::class, 'kd_role', 'kd_role');
   }
}
