<script>
    @if (isset($errors) && $errors->any())
        $(document).ready(function(){
            var html = '';

            @foreach ($errors->all() as $error)
                html += '{{ $error }}<br>';
            @endforeach
            
            Swal.fire({
                html: html,
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            })
        });
    @elseif(session('success'))
        $(document).ready(function(){
            var html = "{{ session('success') }}";
            
            Swal.fire({
                html: html,
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            })
        });
    @elseif(session('warning'))
        $(document).ready(function(){
            var html = "{{ session('warning') }}";
            
            Swal.fire({
                html: html,
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            })
        });
    @elseif(session('default'))
        $(document).ready(function(){
            var html = "{{ session('default') }}";
            
            Swal.fire({
                html: html,
                icon: 'default',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            })
        });
    @elseif(session('error'))
        $(document).ready(function(){
            var html = "{{ session('error') }}";
            
            Swal.fire({
                html: html,
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            })
        });
    @endif
</script>
{{-- @if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 class="text-strong text-center">{{ session('success') }}</h4>
    </div>
@elseif(session('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 class="text-strong text-center">{{ session('warning') }}</h4>
    </div>
@elseif(session('default'))
    <div class="alert alert-default">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 class="text-strong text-center">{{ session('default') }}</h4>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 class="text-strong text-center">{{ session('error') }}</h4>
    </div>
@endif --}}