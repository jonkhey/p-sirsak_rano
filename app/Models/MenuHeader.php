<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuHeader extends Model
{
   use HasFactory;
   protected $table = 'menu_header';
   protected $guarded = ['menu_id'];
   protected $primaryKey = 'menu_id';
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';

   public function submenus()
   {
      return $this->hasMany(MenuDetail::class, 'menu_id');
   }
}
