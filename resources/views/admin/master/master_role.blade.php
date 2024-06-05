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
                  <button type="button" data-mode="addRole" data-id="0" class="dataModall btn btn-{{ $styleApp->value_10 }}" data-toggle="modal"
                     data-target="#modalForm">
                     Tambah Master {{ $titleForm }}
                  </button>
               </div>
               @include('components.alert_card')
               <table id="example2" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Kode {{ $titleForm }}</th>
                        <th>Nama {{ $titleForm }}</th>
                        <th>Urutan {{ $titleForm }}</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($mstRole as $rs)
                        <tr>
                           <td> {{ $loop->iteration }} </td>
                           <td> {!! $rs['kd_role'] !!} </td>
                           <td> {!! $rs['nm_role'] !!} </td>
                           <td> {!! $rs['urutan_role'] !!} </td>
                           <td> {!! $rs['is_active'] == 1 ? '<b> Aktif </b>' : 'Tidak Aktif' !!} </td>
                           <td>
                              <button type="button" class="dataModall btn btn-warning" data-id="{{ $rs['kd_role'] }}" data-mode="editRole"
                                 data-toggle="modal" data-target="#modalForm">
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
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
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
            url: "{{ url('mst_role/vm_role') }}/" + id1 + '/' + id2,
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

   @include('components.datatables_js')
@endsection
