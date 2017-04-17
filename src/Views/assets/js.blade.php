@php $delay = 0; $increment = 150; @endphp
<script>
    var notyf = new Notyf({ delay: 5000 });
    @if(Session::has('error'))
        notyf.alert("{{ Session::get('error') }}");
        @php $delay += $increment; @endphp
    @elseif(Session::has('success'))
        notyf.confirm("{{ Session::get('success') }}");
        @php $delay += $increment; @endphp
    @endif
    @foreach($errors->all() as $error)
        setTimeout(function() {
            notyf.alert("{{ $error }}");
        }, {{ $delay }});
        @php $delay += $increment; @endphp
    @endforeach
</script>
