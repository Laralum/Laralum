<!-- Initialization of tooltips -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

@if(Session::has('error'))
    <script>
        $(function() {
            swal({
              title: 'Whoops!',
              type: 'error',
              timer: 4000,
              html:'{{Session::get('error')}}',
              confirmButtonText:'Okai',
            })
        })
    </script>
@endif

@if(Session::has('info'))
    <script>
        $(function() {
            swal({
              title: 'Info',
              type: 'info',
              timer: 4000,
              html:'{{Session::get('info')}}',
              confirmButtonText:'Okai',
            })
        })
    </script>
@endif

@if(Session::has('success'))
    <script>
        $(function() {
            swal({
              title: 'Success!',
              type: 'success',
              timer: 4000,
              html:'{{Session::get('success')}}',
              confirmButtonText:'Okai',
            })
        })
    </script>
@endif
