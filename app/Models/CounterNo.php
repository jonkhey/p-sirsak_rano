<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterNo extends Model
{
   use HasFactory;
   protected $table = 'counter_no';
   protected $primaryKey = 'jenis';
   protected $guarded = ['jenis'];
   public $incrementing = false;
   public $timestamps = false;
   public $keyType = 'string';
}
