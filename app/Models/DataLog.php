<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLog extends Model
{
   use HasFactory;
   protected $table = 'data_log';
   protected $fillable = ['kd_user', 'ip', 'location', 'function', 'nobuktitransaksi', 'aksi'];
}
