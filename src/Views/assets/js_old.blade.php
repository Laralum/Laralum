<!-- Initialization of tooltips -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@if(Session::has('error'))
    <script>
        $(function() {
            swal({
              title: '{{trans('laralum::general.whops')}}',
              type: 'error',
              html:'{{Session::get('error')}}',
              confirmButtonText:'{{trans('laralum::general.okai')}}',
            });
        });
    </script>
@endif

@if(Session::has('info'))
    <script>
        $(function() {
            swal({
              title: '{{trans('laralum::general.info')}}',
              type: 'info',
              html:'{{Session::get('info')}}',
              confirmButtonText:'{{trans('laralum::general.okai')}}',
            });
        });
    </script>
@endif

@if(Session::has('success'))
    <script>
        $(function() {
            swal({
              title: '{{trans('laralum::general.success')}}',
              type: 'success',
              html:'{{Session::get('success')}}',
              confirmButtonText:'{{trans('laralum::general.okai')}}',
            });
        });
    </script>
@endif

@if(count($errors->all()))
    <script>
        $(function() {
            swal({
              title: '{{trans('laralum::general.invalid_form')}}',
              type: 'error',
              html:'@foreach($errors->all() as $error) {{$error}}<br/>@endforeach',
              confirmButtonText:'{{trans('laralum::general.okai')}}',
            });
        });
    </script>
@endif
