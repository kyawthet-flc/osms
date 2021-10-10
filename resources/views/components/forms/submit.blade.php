<div class="form-group text-center"> 
   
    <input 
        type="submit" {{ $attributes }}
        value="{{ $label }}"
        name="{{$name}}" 
        id="{{$name}}" 
        class="btn btn-success {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" 
        {{ $disabled }} {{ $readonly }}
    />
    
</div>