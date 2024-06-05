@extends('_layouts.settings_template')
@section('body')
   <main>
      <div class="album py-3 bg-light">
         <div class="container">
            <div class="d-flex align-items-start">
               <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-appProfile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-appProfile" type="button"
                     role="tab" aria-controls="v-pills-appProfile" aria-selected="false">Profile</button>
                  <button class="nav-link" id="v-pills-appStyle-tab" data-bs-toggle="pill" data-bs-target="#v-pills-appStyle" type="button"
                     role="tab" aria-controls="v-pills-appStyle" aria-selected="true">App&nbsp;Style</button>
                  <button class="nav-link" id="v-pills-users-tab" data-bs-toggle="pill" data-bs-target="#v-pills-users" type="button" role="tab"
                     aria-controls="v-pills-users" aria-selected="false">Users</button>
                  <button class="nav-link" id="v-pills-modul-tab" data-bs-toggle="pill" data-bs-target="#v-pills-modul" type="button" role="tab"
                     aria-controls="v-pills-modul" aria-selected="false">Master&nbsp;Modul</button>
               </div>
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-appProfile" role="tabpanel" aria-labelledby="v-pills-appProfile-tab">
                     <div class="card">
                        <div class="card-body">
                           <form action="{{ url('edit_profil_perusahaan') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                              @csrf
                              @method('put')
                              <div class="row">
                                 <div class="mb-3 row">
                                    <label for="lNmPerusahaan" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lNmPerusahaan" name="nmPerusahaan"
                                          value="{{ $appProfil->value_1 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lInsPerusahaan" class="col-sm-3 col-form-label">Inisial Perusahaan</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lInsPerusahaan" name="insPerusahaan"
                                          value="{{ $appProfil->value_2 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lAlamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lAlamat" name="alamat" value="{{ $appProfil->value_3 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lKelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lKelurahan" name="kelurahan" value="{{ $appProfil->value_4 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lKecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lKecamatan" name="kecamatan" value="{{ $appProfil->value_5 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lKabupaten" class="col-sm-3 col-form-label">Kabupaten</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lKabupaten" name="kabupaten"
                                          value="{{ $appProfil->value_6 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lProvinsi" class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lProvinsi" name="provinsi" value="{{ $appProfil->value_7 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lnoTelp" class="col-sm-3 col-form-label">Nomor Telephone</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lnoTelp" name="noTelp" value="{{ $appProfil->value_8 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lnoTelp2" class="col-sm-3 col-form-label">Nomor Telephone II</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lnoTelp2" name="noTelp2" value="{{ $appProfil->value_9 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lmotto" class="col-sm-3 col-form-label">Motto</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lmotto" name="motto" value="{{ $appProfil->value_10 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="ltimeZone" class="col-sm-3 col-form-label">Time Zone</label>
                                    <div class="col-sm-9">
                                       <select class="form-select" id="ltimeZone" name="timeZone">
                                          @foreach ($zonaWaktu as $zw => $val)
                                             <option value="{{ $zw }}" @selected($appProfil->value_11 == $zw)>
                                                {{ $val }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lfooter" class="col-sm-3 col-form-label">Footer</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="lfooter" name="footer" value="{{ $appProfil->value_12 }}">
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="litems" class="col-sm-3 col-form-label">Items</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="litems" name="items"
                                          value="{{ $appProfil->items ? implode(',', json_decode($appProfil->items)) : '' }}">
                                       <code>inputan di pisahkan dengan koma | ex: abc,def,ghi</code>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lpictures" class="col-sm-3 col-form-label">Logo Perusahaan</label>
                                    <div class="col-sm-9">
                                       <div class="input-group">
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <img src="data:image/png;base64,{{ $appProfil->pict }}" id="logoPerusahaan" width="100%" />
                                             </div>
                                             <div class="col-lg-8">
                                                @include('_app-settings.file_upload', [
                                                    'name' => 'logoPerusahaan',
                                                ])
                                                <code>logo harus berformat jpg / png</code>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                       <button type="submit" class="btn btn-info">Simpan Pengaturan Profile</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-appStyle" role="tabpanel" aria-labelledby="v-pills-appStyle-tab" style="bord">
                     <div class="card">
                        <div class="card-body">
                           <form action="{{ url('edit_style_perusahaan') }}" method="post" autocomplete="off">
                              @csrf
                              @method('put')
                              <div class="row">
                                 <div class="mb-3 row">
                                    <label for="ldarkMode" class="col-sm-3 col-form-label">Dark Mode</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="ldarkMode" name="darkMode"
                                             {{ $appStyle->value_1 == 'dark-mode' ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class=" mb-3 row">
                                    <label for="lsmallText" class="col-sm-3 col-form-label">Small Text</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="lsmallText" name="smallText"
                                             {{ $appStyle->value_2 == 'text-sm' ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lappsColor" class="col-sm-3 col-form-label">Warna Aplikasi</label>
                                    <div class="col-sm-9">
                                       <select class="form-select" id="lappsColor" name="appsColor">
                                          @foreach ($colorApps as $clr => $val)
                                             <option value="{{ $clr }}" @selected($appStyle->value_3 == 'bg-' . $clr) class="bg-{{ $clr }}">
                                                {{ $val }}
                                             </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lsbCollapse" class="col-sm-3 col-form-label">Sidebar Collapse</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="lsbCollapse" name="sbCollapse"
                                             {{ $appStyle->value_6 == 'sidebar-collapse' ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 {{-- <div class="mb-3 row">
                                 <label for="lsbChillIndent" class="col-sm-3 col-form-label">Sidebar ChillIndent</label>
                                 <div class="col-sm-9">
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" id="lsbChillIndent" name="sbChillIndent">
                                    </div>
                                 </div>
                              </div> --}}
                                 <div class="mb-3 row">
                                    <label for="lsbFlat" class="col-sm-3 col-form-label">Sidebar Flat</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="lsbFlat" name="sbFlat"
                                             {{ $appStyle->value_8 == 'nav-flat' ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lftFixed" class="col-sm-3 col-form-label">Footer Fixed </label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="lftFixed" name="ftFixed"
                                             {{ $appStyle->value_9 == 'layout-footer-fixed' ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lcardColor" class="col-sm-3 col-form-label">Card Color</label>
                                    <div class="col-sm-9">
                                       <select class="form-select" id="lcardColor" name="cardColor">
                                          @foreach ($cardColor as $clr => $val)
                                             <option value="{{ $clr }}" @selected($appStyle->value_10 == $clr) class="bg-{{ $clr }}">
                                                {{ $val }}
                                             </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="lpreLoader" class="col-sm-3 col-form-label">Pre Loader</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="lpreLoader" name="preLoader"
                                             {{ $appStyle->value_11 ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label for="ltopNav" class="col-sm-3 col-form-label">Top Nav</label>
                                    <div class="col-sm-9">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="ltopNav" name="topNav"
                                             {{ $appStyle->value_12 ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                       <button type="submit" class="btn btn-info">Simpan Pengaturan Profile</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                     <div class="card">
                        <div class="card-body">
                           <button type="button" data-mode="addUser" data-id="0" class="userDataa btn btn-primary btn-sm mb-2"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Tambah User
                           </button>

                           <table class="table table-striped" id="myTable" style="font-size : 13px">
                              <thead>
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor KTP</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">JK</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($userData as $index => $rs)
                                    <tr>
                                       <td>{{ $index + 1 }}</td>
                                       <td>{{ $rs['nama'] }}</td>
                                       <td>{{ $rs['noKtp'] }}</td>
                                       <td>{{ $rs['tempatLahir'] }}</td>
                                       <td>{{ tanggalK($rs['tanggalLahir']) }}</td>
                                       <td>{{ $rs['jk'] == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
                                       <td>
                                          {!! $rs['image'] ? '<img src="data:image/png;base64,' . $rs['image'] . '" id="foto user" height="100px" />' : '' !!}
                                       </td>
                                       <td>{{ $rs['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                       <td>
                                          <button type="button" data-id="{{ $rs['id'] }}" data-mode="editUser"
                                             class="userDataa btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                             Edit
                                          </button>
                                       </td>
                                    </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-modul" role="tabpanel" aria-labelledby="v-pills-modul-tab">
                     <div class="card">
                        <div class="card-body">Master Modul</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>

   <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
         <div class="modal-content" id="modalUser">
         </div>
      </div>
   </div>
@endsection

@section('ownScript')
   <script type="text/javascript">
      function preview_image(event) {
         var id = event.target.id;
         var reader = new FileReader();
         reader.onload = function() {
            var output = document.getElementById(id);
            output.src = reader.result;
            // output.setAttribute('width', '100px');
            // output.setAttribute('height', '100px');
         }
         reader.readAsDataURL(event.target.files[0]);
      }
   </script>

   <script>
      $('.userDataa').click(function() {
         var id1 = $(this).attr("data-mode");
         var id2 = $(this).attr("data-id");

         $.ajax({
            url: "{{ url('/app_settings/vm_user') }}/" + id1 + '/' + id2,
            type: "GET",
            beforeSend: function() {
               $('#preLoadJs').show();
            },
            success: function(data) {
               $('#modalUser').html(data);
            },
            complete: function() {
               $('#preLoadJs').hide();
            },
         });
      });
   </script>
@endsection
