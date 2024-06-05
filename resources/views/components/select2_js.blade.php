<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
   $(function() {
      $('.select2').select2()
      $('.select2bs4').select2({
         theme: 'bootstrap4'
      })
   })
</script>
