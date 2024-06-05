<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstCounter extends Model
{
   use HasFactory;
   protected $table = 'mst_counter';
   protected $primaryKey = 'kd_counter';
   protected $guarded = ['kd_counter', 'nm_counter'];
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';
}
