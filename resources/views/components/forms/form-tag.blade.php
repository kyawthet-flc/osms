@php
$finalMetod = in_array($method, ['put', 'delete', 'post', 'patch'])? 'post': 'get';
@endphp
<form id="{{ $id }}" class="{{ $class }}" action="{{ $action }}" method="{{ $finalMetod }}" enctype="multipart/form-data">
    @if($method !== 'get')
        @csrf
    @endif

    @if( in_array($method, ['put', 'delete']) )
        {{ method_field($method) }}
    @endif

    {{$slot}}
</form>