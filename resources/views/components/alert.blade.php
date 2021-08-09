@if(session('message'))
    <div class="alert alert-info {{ $class ?? ''}}">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
