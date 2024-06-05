<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengiriman extends Model
{
   use HasFactory;
   protected $table = 'laporan_pengiriman';
   protected $primaryKey = 'kd_laporan';
   protected $fillable = [
      'kd_laporan',
      'tgl_laporan',
      'no_kontainer',
      'si',
      'surat_penugasan',
      'keterangan_laporan',
      'user_laporan',
      'tgl_pengiriman',
      'foto_truck',
      'nm_supir',
      'ketersediaan_truck',
      'user_armada',
      'keterangan_kirim',
   ];
   public $incrementing = false;
   public $keyType = 'string';
}
