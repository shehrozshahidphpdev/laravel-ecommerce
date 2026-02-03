@props([
    'method' => 'POST',
    'media' => false,
    'action' => '#',
    'id' => null,
])

<form 
    action="{{ $action }}"
    id="{{ $id ?? '' }}"
    {{ $attributes }}
    method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}"
    @if($media) enctype="multipart/form-data" @endif
>
    @csrf
    @if(!in_array($method, ['GET', 'POST']))
        @method($method)
    @endif

    {{-- THIS IS THE SLOT --}}
    {{ $slot }}
</form>
