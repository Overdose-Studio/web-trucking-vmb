{{-- success --}}
@if (session('success'))
    <div class="alert alert-success p-2">
        <p class="m-0">
            {{ session('success') }}
        </p>
    </div>
@endif
{{-- error --}}
@if ($errors->any() || session('error'))
    <div class="alert alert-danger p-2">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li>
            @endif
        </ul>
    </div>
@endif
