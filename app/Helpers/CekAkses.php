<?php

use App\Models\MenuDetail;
use App\Models\MenuHeader;

function getMenu()
{
   $userId = auth()->user()->username;

   return MenuHeader::whereIn('menu_id', function ($query) use ($userId) {
      $query->select('menu_id')
         ->from('menu_access')
         ->where('user_id', $userId)
         ->where('is_active', 1);
   })
      ->where('is_active', 1)
      ->orderBy('urut')
      ->get();

   // return auth()->user()->accessMenus()->with('menu')->get();
}


function getSubMenu($menu_id)
{
   $_menu_id = strip_tags($menu_id);
   $userId = auth()->user()->username;

   return MenuDetail::whereIn('detail_id', function ($query) use ($_menu_id, $userId) {
      $query->select('detail_id')
         ->from('menu_access')
         ->where('menu_id', $_menu_id)
         ->where('is_active', 1)
         ->where('user_id', $userId);
   })
      ->where('is_active', 1)
      ->where('is_show', 1)
      ->get();

   // return MenuHeader::find($_menu_id)->submenus()->where('is_active', 1)->get();
}
