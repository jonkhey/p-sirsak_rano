<!DOCTYPE html>
<html>
@php
   $title = 'File Foto';
   $keFoto = $uploadFile->ket_foto;
   $file = $uploadFile->image;
@endphp

<head>
   <title>{{ $title }}</title>
</head>

<body>
   <h4>{{ $keFoto }}</h4>
   <img src="data:image/png;base64,{{ $file }}" class="img-fluid mb-2" alt="white sample" />
</body>

</html>
