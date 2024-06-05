<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstRoles extends Model
{
   protected $table = 'mst_roles';
   protected $primaryKey = 'kd_role';
   protected $guarded = [];
   public $keyType = 'string';
   public $timestamps = false;
}
