<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
   protected $table = 'menu_detail';
   protected $guarded = ['detail_id'];
   protected $primaryKey = 'detail_id';
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';

   public function menu()
   {
      return $this->belongsTo(MenuHeader::class, 'menu_id', 'menu_id');
   }

   public static function getSubMenu()
   {
      return MenuDetail::select('menu_detail.*', 'menu_header.menu')->join('menu_header', 'menu_header.menu_id', '=', 'menu_detail.menu_id')->get();
   }
}
