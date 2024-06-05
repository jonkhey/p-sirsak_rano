<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingApps extends Model
{
   use HasFactory;
   protected $table = 'setting_apps';
   protected $primaryKey = 'jenis';
   protected $guarded = ['jenis'];

   public $incrementing = false;
   public $keyType = 'string';
}
