<div class="form-group"> 
   
    <button
        name="{{$name}}"  {{ $attributes }}
        id="{{$name}}" 
        class="form-control {{$class}} {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" 
        {{ $disabled }} {{ $readonly }}
    >{{ $label }}</button>
    
</div>