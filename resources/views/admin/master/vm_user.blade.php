<div class="modal-header bg-{{ $styleApp->value_10 }}">
   <h4 class="modal-title">{{ $dataMode == 'addUser' ? 'Tambah Data' : 'Edit Data' }}</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <form action="{{ url('mst_user') }}" method="post" autocomplete="off" enctype="multipart/form-data">
      @php
         if ($dataMode == 'addUser') {
             $idUser = $noKtp = $nmUser = $tmpLahir = $tglLahir = $jk = $kdAgama = $noTelp = $alamat = $userName = $email = $password = $status = $foto = '';
             $kdRole = '';
         } else {
             $idUser = $userData->id;
             $noKtp = $userData->no_ktp;
             $nmUser = $userData->nama;
             $tmpLahir = $userData->tempat_lahir;
             $tglLahir = $userData->tanggal_lahir;
             $jk = $userData->jk;
             $kdAgama = $userData->kd_agama;
             $noTelp = $userData->no_telp;
             $alamat = $userData->alamat;
             $userName = $userData->joinUsers->username ?? '';
             $email = $userData->joinUsers->email ?? '';
             $password = '';
             $status = $userData->status;
             $foto = $userData->image;
             $kdRole = $userData->kd_role;
         }
      @endphp
      @csrf
      <input type="hidden" name="dataMode" value="{{ $dataMode }}">
      <input type="hidden" name="idUser" value="{{ $idUser }}">

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Nomor NIK</label>
         <div class="col-sm-4">
            <input type="number" class="form-control" name="noKtp" value="{{ $noKtp }}">
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Nama</label>
         <div class="col-sm-5">
            <input type="text" class="form-control" name="nmUser" value="{{ $nmUser }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
         <div class="col-sm-3">
            <input type="text" class="form-control" name="tmpLahir" value="{{ $tmpLahir }}" required>
         </div>
         <div class="col-sm-3">
            <input type="date" class="form-control" name="tglLahir" value="{{ $tglLahir }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
         <div class="col-sm-4">
            <select class="custom-select form-control" name="jk" required>
               <option value="">:: Pilih ::</option>
               <option value="L" {{ $jk == 'L' ? 'selected' : '' }}>Laki Laki</option>
               <option value="P" {{ $jk == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Agama</label>
         <div class="col-sm-4">
            <select class="custom-select form-control" name="kdAgama" required>
               <option value="">:: Pilih ::</option>
               @foreach ($rsAgama as $rs)
                  <option value="{{ $rs->kd_agama }}" @selected($rs->kd_agama == $kdAgama)>{{ $rs->nm_agama }}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">No Telephone</label>
         <div class="col-sm-4">
            <input type="number" class="form-control" name="noTelp" value="{{ $noTelp }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Alamat</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" name="alamat" value="{{ $alamat }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Jabatan</label>
         <div class="col-sm-5">
            <select class="custom-select form-control" name="kdRole" id="lkdRole" required>
               <option value="">:: Pilih ::</option>
               @foreach ($rsRoles as $rsj)
                  <option value="{{ $rsj->kd_role }}" @selected($rsj->kd_role == $kdRole)>{{ $rsj->nm_role }}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Foto User</label>
         <div class="col-sm-9">
            <div class="input-group">
               <div class="row">
                  <div class="col-lg-3">
                     <img src="data:image/png;base64,{{ $foto }}" id="fotoUser" width="100%" />
                  </div>
                  <div class="col-lg-8">
                     @include('components.file_upload', ['name' => 'fotoUser'])
                     <code>foto harus berformat jpg / png, maksimal 1MB</code>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label"></label>
         <div class="col-sm-9">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Simpan</button>
         </div>
      </div>
   </form>
</div>
