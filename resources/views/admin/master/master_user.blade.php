@extends('_layouts.app_template')
@section('headerCSS')
   @include('components.datatables_css')
@endsection
@section('body')
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-{{ $styleApp->value_10 }}">
            <div class="card-header">
               <h3 class="card-title">Halaman Master {{ $titleForm }}</h3>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <button type="button" data-mode="addUser" data-id="0" class="userDataa btn btn-{{ $styleApp->value_10 }}" data-toggle="modal"
                     data-target="#modalForm">
                     Tambah Master {{ $titleForm }}
                  </button>
               </div>
               @include('components.alert_card')
               <table id="example2" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>No KTP</th>
                        <th>Nama </th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>JK</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($userData as $rs)
                        <tr>
                           <td> {{ $loop->iteration }} </td>
                           <td> {!! $rs['noKtp'] !!} </td>
                           <td> {!! $rs['nama'] !!} </td>
                           <td> {!! $rs['tempatLahir'] !!} </td>
                           <td>{{ tanggalK($rs['tanggalLahir']) }}</td>
                           <td>{{ $rs['jk'] == 'L' ? 'Laki - Laki' : ($rs['jk'] == 'P' ? 'Perempuan' : 'Tidak Di Ketahui') }}</td>
                           <td>{{ $rs['nmRole'] }}</td>
                           <td>
                              <button type="button" class="userDataa btn btn-warning" data-id="{{ $rs['id'] }}" data-mode="editUser"
                                 data-toggle="modal" data-target="#modalForm">
                                 Edit
                              </button>
                              {{-- @if ($rs['urutRole'] <= 3) --}}
                              <button type="button" class="hakAkses btn btn-warning" data-id="{{ $rs['id'] }}" data-mode="hakAkses"
                                 data-toggle="modal" data-target="#modalHakAkses">
                                 Hak Akses
                              </button>
                              {{-- @endif --}}
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
         <div class="modal-content" id="modalUser">

         </div>
      </div>
   </div>
   <div class="modal fade" id="modalHakAkses" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
         <div class="modal-content" id="modalAkses">

         </div>
      </div>
   </div>
@endsection
@section('footerJS')
   <script>
      $('.userDataa').click(function() {
         var id1 = $(this).attr("data-mode");
         var id2 = $(this).attr("data-id");

         $.ajax({
            url: "{{ url('mst_user/vm_user') }}/" + id1 + '/' + id2,
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

   <script>
      $('.hakAkses').click(function() {
         var id1 = $(this).attr("data-mode");
         var id2 = $(this).attr("data-id");

         $.ajax({
            url: "{{ url('master_hak_akses/vm_hak_akses') }}/" + id1 + '/' + id2,
            type: "GET",
            beforeSend: function() {
               $('#preLoadJs').show();
            },
            success: function(data) {
               $('#modalAkses').html(data);
            },
            complete: function() {
               $('#preLoadJs').hide();
            },
         });
      });
   </script>

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

   @include('components.datatables_js')
@endsection
