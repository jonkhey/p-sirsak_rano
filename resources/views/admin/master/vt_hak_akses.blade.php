<table class="table table-bordered table-striped">
   <thead>
      <tr>
         <th>#</th>
         <th>User ID</th>
         <th>Menu Nama</th>
         <th>Menu Detail</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($menuAccess as $rs)
         <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {!! $rs['userName'] !!} </td>
            <td> {!! $rs['menuName'] !!} </td>
            <td> {!! $rs['detailName'] !!} </td>
            <td>
               <button type="button" name="btnHapus"
                  onclick="hapus_hakAkses('{!! $rs['userName'] !!}','{!! $rs['menuId'] !!}','{!! $rs['detailId'] !!}')" class="btn btn-danger btn-sm"
                  title="Hapus Obat"> <i class="fas fa-trash-alt"> </i></button>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>
