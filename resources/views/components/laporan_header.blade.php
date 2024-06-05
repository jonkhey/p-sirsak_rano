<table border="0" style="width: 100%; text-align: center; font-weight: bold;">
   <tr>
      {{-- <td rowspan="3" style="width: 15%"></td> --}}
      <td style="font-size: 20pt">
         {{ $appLaporan->value_1 }}
      </td>
      <td rowspan="3" style="width: 15%">
         <img class="" src="data:image/png;base64,{{ $profilApp->pict }}" height="100" alt="logo">
      </td>
   </tr>
   <tr>
      <td style="font-size: 15pt">
         {{ $profilApp->value_3 }}, {{ $profilApp->value_4 }}, {{ $profilApp->value_5 }}, {{ $profilApp->value_6 }},
         {{ $profilApp->value_7 }}
      </td>
   </tr>
   <tr>
      <td style="font-size: 13pt">
         Telp : {{ $profilApp->value_8 }} &emsp; &emsp; Email : {{ $profilApp->value_9 }}
      </td>
   </tr>
   <tr>
      <td colspan="2">
         <hr style="border: 1px solid black;">
      </td>
   </tr>
</table>
