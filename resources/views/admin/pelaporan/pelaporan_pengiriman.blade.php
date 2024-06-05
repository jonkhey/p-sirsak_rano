@extends('_layouts.app_template')
@section('headerCSS')
   @include('components.datatables_css')
@endsection
@section('body')
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-{{ $styleApp->value_10 }}">
            <div class="card-header">
               <h3 class="card-title">Halaman Pelaporan Pengiriman</h3>
            </div>
            <div class="card-body">
               <div class="form-group">
                  @if (auth()->user()->userData()->joinMstRoles->urutan_role == 2)
                     <button type="button" data-mode="addPelaporan" data-id="0" class="dataModall btn btn-{{ $styleApp->value_10 }}" data-toggle="modal" data-target="#modalForm">
                        Tambah Pelaporan Pengiriman
                     </button>
                  @endif
               </div>
               @include('components.alert_card')
               <table id="example2" class="table table-bordered table-striped table-sm" style="font-size: 14px">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>No Kontainer</th>
                        <th>SI</th>
                        <th>Surat Tugas</th>
                        <th>Keterangan</th>
                        <th>Tgl Kirim</th>
                        <th>Nama Supir</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($laporanPengiriman as $rs)
                        <tr>
                           <td> {{ $loop->iteration }} </td>
                           <td> {!! $rs->kd_laporan !!} </td>
                           <td> {!! tanggal($rs->tgl_laporan) !!} </td>
                           <td> {!! $rs->no_kontainer !!} </td>
                           <td> {!! $rs->si !!} </td>
                           <td>
                              @if ($rs->surat_penugasan)
                                 <a class="btn btn-sm btn-success" href="{{ url('pelaporan_pengiriman/download', ['id1' => encrypt($rs->kd_laporan), 'id2' => encrypt(0)]) }}"><i
                                       class="fas fa-download"></i></a>
                              @endif
                           </td>
                           <td> {!! nl2br($rs->keterangan_laporan) !!} </td>
                           <td> {!! $rs->tgl_pengiriman ? tanggal($rs->tgl_pengiriman) : '' !!} </td>
                           <td> {!! $rs->nm_supir !!} </td>
                           <td>
                              <button type="button" class="dataModall btn btn-sm btn-warning" data-id="{{ $rs->kd_laporan }}" data-mode="editPelaporan" data-toggle="modal"
                                 data-target="#modalForm">
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
   </div>
   <div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
         <div class="modal-content" id="modalFormData">

         </div>
      </div>
   </div>
@endsection
@section('footerJS')
   <script>
      $('.dataModall').click(function() {
         var id1 = $(this).attr("data-mode");
         var id2 = $(this).attr("data-id");

         $.ajax({
            url: "{{ url('pelaporan_pengiriman_vm') }}/" + id1 + '/' + id2,
            type: "GET",
            beforeSend: function() {
               $('#preLoadJs').show();
            },
            success: function(data) {
               $('#modalFormData').html(data);
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
