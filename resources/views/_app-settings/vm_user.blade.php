<div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">{{ $dataMode == 'addUser' ? 'Tambah Data User' : 'Edit Data User' }}</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
   <form action="{{ url('aksi_data_user') }}" method="post" autocomplete="off" enctype="multipart/form-data">
      @php
         if ($dataMode == 'addUser') {
             $idUser = $noKtp = $nmUser = $tmpLahir = $tglLahir = $jk = $agama = $noTelp = $alamat = $userName = $email = $password = $roleId = $status = $foto = '';
         } else {
             $idUser = $userData->id;
             $noKtp = $userData->no_ktp;
             $nmUser = $userData->nama;
             $tmpLahir = $userData->tempat_lahir;
             $tglLahir = $userData->tanggal_lahir;
             $jk = $userData->jk;
             $agama = $userData->agama;
             $noTelp = $userData->no_telp;
             $alamat = $userData->alamat;
             $userName = $userData->joinUsers->username ?? '';
             $email = $userData->joinUsers->email ?? '';
             $password = '';
             $roleId = $userData->joinUsers->role_id ?? '';
             $status = $userData->status;
             $foto = $userData->image;
         }
      @endphp
      @csrf
      <input type="hidden" name="dataMode" value="{{ $dataMode }}">
      <input type="hidden" name="idUser" value="{{ $idUser }}">
      <div class="row">
         <div class="mb-3 row">
            <label for="lnoKtp" class="col-sm-3 col-form-label">No KTP</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="lnoKtp" name="noKtp" value="{{ $noKtp }}">
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lnmUser" class="col-sm-3 col-form-label">Nama User</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="lnmUser" name="nmUser" value="{{ $nmUser }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="ltmpLahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
            <div class="col-sm-5">
               <input type="text" class="form-control" id="ltmpLahir" name="tmpLahir" value="{{ $tmpLahir }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="ltglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-3">
               <input type="date" class="form-control" id="ltglLahir" name="tglLahir" value="{{ $tglLahir }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="ljk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-3">
               <select class="custom-select form-control" id="ljk" name="jk" required>
                  <option value="">:: Pilih ::</option>
                  <option value="L" {{ $jk == 'L' ? 'selected' : '' }}>Laki Laki</option>
                  <option value="P" {{ $jk == 'P' ? 'selected' : '' }}>Perempuan</option>
               </select>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lagama" class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-3">
               <select class="custom-select form-control" name="agama" id="lagama" required>
                  <option value="">:: Pilih ::</option>
                  @foreach ($rsAgama as $rs)
                     <option value="{{ $rs->kd_agama }}" @selected($rs->kd_agama == $agama)>{{ $rs->nm_agama }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lnoTelp" class="col-sm-3 col-form-label">No Telephone</label>
            <div class="col-sm-3">
               <input type="text" class="form-control" id="lnoTelp" name="noTelp" value="{{ $noTelp }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lalamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="lalamat" name="alamat" value="{{ $alamat }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="luserName" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="luserName" name="userName" value="{{ $userName }}" required>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lemail" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="lemail" name="email" value="{{ $email }}">
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lpassword" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" id="lpassword" name="password" value=""
                  {{ $dataMode == 'addUser' ? 'required' : '' }}>
               {!! $dataMode == 'editUser' ? '<code>kosongkan jika tidak ingin merubah password</code>' : '' !!}
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lroleId" class="col-sm-3 col-form-label">Role ID</label>
            <div class="col-sm-2">
               <select class="custom-select form-control" name="roleId" id="lroleId" required>
                  <option value="">:: Pilih ::</option>
                  @foreach ($rsRoles as $rs)
                     <option value="{{ $rs->id }}" @selected($rs->id == $roleId)>{{ $rs->role }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lstatus" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-2">
               <select class="custom-select form-control" id="lstatus" name="status" required>
                  <option value="">:: Pilih ::</option>
                  <option value="1" {{ $status == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ $status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
               </select>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="lpictures" class="col-sm-3 col-form-label">Foto User</label>
            <div class="col-sm-9">
               <div class="input-group">
                  <div class="row">
                     <div class="col-lg-3">
                        <img src="data:image/png;base64,{{ $foto }}" id="fotoUser" width="100%" />
                     </div>
                     <div class="col-lg-8">
                        @include('_app-settings.file_upload', ['name' => 'fotoUser'])
                        <code>foto harus berformat jpg / png</code>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="mb-3 row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Simpan Pengaturan Profile</button>
            </div>
         </div>
      </div>
   </form>
</div>
