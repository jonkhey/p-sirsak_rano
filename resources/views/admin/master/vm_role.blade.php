<div class="modal-header bg-{{ $styleApp->value_10 }}">
   <h4 class="modal-title">{{ $dataMode == 'addRole' ? 'Tambah Data' : 'Edit Data' }}</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <form action="{{ url('mst_role') }}" method="post" autocomplete="off">
      @php
         if ($dataMode == 'addRole') {
             $kdRole = 'KodeOtomatis';
             $nmRole = $urutanRole = '';
             $isActive = 0;
         } else {
             $kdRole = $dataRole->kd_role;
             $nmRole = $dataRole->nm_role;
             $urutanRole = $dataRole->urutan_role;
             $isActive = $dataRole->is_active;
         }
      @endphp
      @csrf
      <input type="hidden" name="dataMode" value="{{ $dataMode }}">

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Kode Role</label>
         <div class="col-sm-4">
            <input type="text" class="form-control" name="kdRole" value="{{ $kdRole }}" readonly>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Nama Role</label>
         <div class="col-sm-4">
            <input type="text" class="form-control" name="nmRole" value="{{ $nmRole }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Urutan Role</label>
         <div class="col-sm-4">
            <input type="number" class="form-control" name="urutanRole" value="{{ $urutanRole }}" required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Aktif</label>
         <div class="col-sm-4">
            <select class="custom-select form-control" name="isActive" required>
               <option value="">:: Pilih ::</option>
               <option value="1" {{ $isActive == '1' ? 'selected' : '' }}>Aktif</option>
               <option value="0" {{ $isActive == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
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
