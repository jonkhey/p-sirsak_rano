<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstBulan extends Model
{
   protected $table = 'mst_bulan';
   protected $guarded = ['kd_bulan'];
   protected $primaryKey = 'kd_bulan';
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';
}
