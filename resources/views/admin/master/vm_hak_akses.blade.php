<div class="modal-header bg-{{ $styleApp->value_10 }}">
   <h5 class="modal-title">Hak Akses</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <form action="{{ url('master_hak_akses') }}" id="formHakAkses" method="post" autocomplete="off">
      @csrf
      <input type="hidden" name="dataMode" value="{{ $dataMode }}">
      <input type="hidden" name="dataUSer" value="{{ $userData->id }}">
      @php
         $userName = $users ? $users->username : '';
      @endphp

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Nama</label>
         <div class="col-sm-5">
            <input type="text" class="form-control" name="nama" value="{{ $userData->nama }}" readonly>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Username</label>
         <div class="col-sm-5">
            <input type="text" class="form-control" name="userName" id="userName" value="{{ $userName }}" {{ $users ? 'readonly' : '' }}
               required>
         </div>
      </div>

      <div class="form-group row">
         <label class="col-sm-3 col-form-label">Password</label>
         <div class="col-sm-5">
            <input type="password" class="form-control" name="password" value="" {{ $users ? '' : 'required' }}>
            <code>Kosongkan jika tidak ingin merubah password</code>
         </div>
      </div>
      <hr>
      <div class="form-group row">
         <div class="col-sm-5">
            <select class="custom-select form-control" name="kdMenu" id="lkdMenu" required>
               <option value="">:: Pilih ::</option>
               @foreach ($menuHeader as $rsh)
                  <option value="##{{ $rsh->menu_id }}">{{ $rsh->menu_nama }}</option>
               @endforeach
               @foreach ($menuDetail as $rsd)
                  <option value="&&{{ $rsd->detail_id }}">--{{ $rsd->title }}</option>
               @endforeach
            </select>
         </div>
         <div class="col-sm-7">
            <button type="submit" id="submit" class="btn btn-info">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
      <hr>
      <div id="tableUser"></div>
   </form>
</div>

<script>
   dataTabelUser();

   function dataTabelUser() {
      let userName = $('#userName').val()
      $.ajax({
         type: "get",
         url: "{{ url('master_hak_akses/vt_hak_akses') }}/{{ $userData->id }}/" + userName,
         success: function(data) {
            $("#tableUser").html(data);
         }
      });
   }

   $('#formHakAkses').submit(function(e) {
      e.preventDefault();

      if ($('#lkdMenu').val() == '') {
         toastr.error('Kode Menu Belum Di Pilih');
         return;
      }

      $('#submit').attr('disabled', true);

      $.ajax({
         url: $(this).attr('action'),
         type: "POST",
         data: $(this).serialize(),
         beforeSend: function() {
            $('#preLoadJs').show();
         },
         success: function(data) {
            if (data.success) {
               toastr.success(data.success)
               $('#userName').attr('readonly', true);
            } else {
               toastr.warning(data.warning)
            }
         },
         complete: function() {
            $('#preLoadJs').hide();
            $('#submit').attr('disabled', false);
            $('#lkdMenu').val('')
            dataTabelUser();
         },
         error: function(jqXHR, textStatus, errorThrown) {
            toastr.error('Data Gagal Di Update')
         }
      });
   });

   function hapus_hakAkses(id1, id2, id3) {
      if (confirm("Yakin akan dihapus ?")) {
         $.ajax({
            url: "{{ url('master_hak_akses/hapus_hak_akses') }}/" + id1 + '/' + id2 + '/' + id3,
            type: 'get',
            datatype: 'JSON',
            beforeSend: function() {
               $('#preLoadJs').show();
            },
            success: function(data) {
               if (data.success) {
                  toastr.success(data.success)
               } else {
                  toastr.warning(data.warning)
               }
            },
            complete: function() {
               $('#preLoadJs').hide();
               dataTabelUser();
            },
            error: function(jqXHR, textStatus, errorThrown) {
               toastr.error('Data Gagal Di Update')
            }
         });
      }
   }
</script>
