<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
   protected $table = 'menu_access';
   protected $guarded = [];
   protected $primaryKey = 'detail_id';
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';

   public function user()
   {
      return $this->belongsTo(User::class, 'user_id', 'username');
   }

   public function menu()
   {
      return $this->belongsTo(MenuHeader::class, 'menu_id', 'menu_id');
   }
}
