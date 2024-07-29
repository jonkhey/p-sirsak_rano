<div class="modal-header bg-{{ $styleApp->value_10 }}">
   <h4 class="modal-title">Shipping Instruction</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   @php
      $roles = auth()->user()->userData()->joinMstRoles->urutan_role;
      $kdRole = auth()->user()->userData()->kd_role;

      if ($dataMode == 'addPelaporan') {
          $kdLaporan = 'LP' . date('ymd') . '0000';
          $tglLaporan = date('Y-m-d');
          $noKontainer = $si = $suratPenugasan = $keterangan = $tglPengiriman = $nmSupir = $ketersediaanTruck = $fotoTruck = $nomorPelat = '';
      }

      if ($dataMode == 'editPelaporan') {
          $kdLaporan = $pelaporanPengiriman->kd_laporan;
          $tglLaporan = $pelaporanPengiriman->tgl_laporan;
          $noKontainer = $pelaporanPengiriman->no_kontainer;
          $si = $pelaporanPengiriman->si;
          $suratPenugasan = $pelaporanPengiriman->surat_penugasan;
          $keterangan = $pelaporanPengiriman->keterangan_laporan;
          $tglPengiriman = $pelaporanPengiriman->tgl_pengiriman;
          $nmSupir = $pelaporanPengiriman->nm_supir;
          $ketersediaanTruck = $pelaporanPengiriman->ketersediaan_truck;
          $fotoTruck = $pelaporanPengiriman->foto_truck;
          $nomorPelat = $pelaporanPengiriman->nomor_pelat;
      }
   @endphp
   <form action="{{ url('pelaporan_pengiriman') }}" method="post" autocomplete="off" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="kdLaporan" value="{{ $kdLaporan }}" required readonly>
      <input type="hidden" name="dataMode" value="{{ $dataMode }}" required readonly>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Tanggal</label>
         <div class="col-sm-2">
            <input type="date" class="form-control" name="tglLaporan" value="{{ $tglLaporan }}" @required($dataMode == 'addPelaporan') @readonly($kdRole != 'RL00002')>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Shipping Instruction</label>
         {{-- <div class="col-sm-6">
            <input type="text" class="form-control" name="si" value="{{ $si }}" @required($dataMode == 'addPelaporan') @readonly($kdRole != 'RL00002')>
         </div> --}}
         @if ($kdRole == 'RL00002')
            <div class="col-sm-4">
               <input type="file" class="form-control" name="si" value="{{ $si }}">
               <code>file harus berformat pdf, maksimal 1MB</code>
            </div>
         @endif
         @if ($si)
            <div class="col-sm-4">
               <a class="btn btn-sm btn-success" href="{{ url('pelaporan_pengiriman/download', ['id1' => encrypt($kdLaporan), 'id2' => encrypt('si')]) }}"><i
                     class="fas fa-download"></i> Download File</a>
            </div>
         @endif
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">No Kontainer</label>
         {{-- <div class="col-sm-6">
            <input type="text" class="form-control" name="noKontainer" value="{{ $noKontainer }}" @required($dataMode == 'addPelaporan') @readonly($kdRole != 'RL00002')>
         </div> --}}
         @if ($kdRole == 'RL00002')
            <div class="col-sm-4">
               <input type="file" class="form-control" name="noKontainer" value="{{ $noKontainer }}">
               <code>file harus berformat pdf, maksimal 1MB</code>
            </div>
         @endif
         @if ($noKontainer)
            <div class="col-sm-4">
               <a class="btn btn-sm btn-success" href="{{ url('pelaporan_pengiriman/download', ['id1' => encrypt($kdLaporan), 'id2' => encrypt('noKontainer')]) }}"><i
                     class="fas fa-download"></i> Download File</a>
            </div>
         @endif
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Surat Penugasan</label>
         @if ($kdRole == 'RL00002')
            <div class="col-sm-4">
               <input type="file" class="form-control" name="suratPenugasan" value="{{ $suratPenugasan }}">
               <code>file harus berformat pdf, maksimal 1MB</code>
            </div>
         @endif
         @if ($suratPenugasan)
            <div class="col-sm-4">
               <a class="btn btn-sm btn-success" href="{{ url('pelaporan_pengiriman/download', ['id1' => encrypt($kdLaporan), 'id2' => encrypt('suratPenugasan')]) }}"><i
                     class="fas fa-download"></i> Download File</a>
            </div>
         @endif
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Keterangan</label>
         <div class="col-sm-7">
            <textarea class="form-control" name="keterangan" cols="30" rows="7" @required($dataMode == 'addPelaporan') @readonly($kdRole != 'RL00002')>{{ $keterangan }}</textarea>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Tanggal Pengiriman</label>
         <div class="col-sm-2">
            <input type="date" class="form-control" name="tglPengiriman" value="{{ $tglPengiriman }}" @required($dataMode == 'editPelaporan') @readonly($kdRole != 'RL00003')>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Ketersediaan Truck</label>
         <div class="col-sm-2">
            <input type="number" class="form-control" name="ketersediaanTruck" value="{{ $ketersediaanTruck }}" @required($dataMode == 'editPelaporan') @readonly($kdRole != 'RL00003')>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Nama Sopir</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="nmSupir" value="{{ $nmSupir }}" @required($dataMode == 'editPelaporan') @readonly($kdRole != 'RL00003')>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Pelat Nomor Truck</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="nomorPelat" value="{{ $nomorPelat }}" @required($dataMode == 'editPelaporan') @readonly($kdRole != 'RL00003')>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Foto Truck</label>
         <div class="col-sm-9">
            <div class="input-group">
               <div class="row">
                  @if ($dataMode == 'editPelaporan' && $kdRole == 'RL00003')
                     <div class="col-lg-12">
                        @include('components.file_upload', ['name' => 'fotoTruck'])
                        <code>foto harus berformat jpg / png, maksimal 1MB</code>
                     </div>
                  @else
                     <label for="">-</label>
                  @endif
                  @if ($fotoTruck)
                     <div class="col-lg-12">
                        <img src="{{ url('storage/foto-lap-pengiriman/' . $fotoTruck) }}" alt="{{ $fotoTruck }}" id="fotoTruck" style="width: 100%;">
                     </div>
                  @endif
               </div>
            </div>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-2 col-form-label"></label>
         <div class="col-sm-9">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Simpan</button>
         </div>
      </div>
   </form>
</div>
