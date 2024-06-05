<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstAgama extends Model
{
   protected $table = 'mst_agama';
   protected $guarded = ['kd_agama'];
   protected $primaryKey = 'kd_agama';
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';
}
