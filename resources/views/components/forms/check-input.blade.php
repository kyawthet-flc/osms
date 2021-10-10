<div class="form-group {{ $errors->has($name) ? 'has-danger' : ''}} {{$col ?? null}}"> 
    <label for="{{$id}}">
        {!! $label !!}        
        @if ( !empty($required) )
            <span class="required-text-block">Required</span>
        @endif
    </label>    
    <input type="checkbox" 
        placeholder="{{$label ?? ''}}" 
        name="{{$name}}" 
        value="{{ $value }}"
        @if($checked) checked="checked" @endif
        id="{{$name}}" 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" 
        @if( $readOnly ) readonly="readonly" @endif
        @if( $disabled ) disabled="disabled" @endif
        @if(isset($attributes))
        @foreach($attributes as $key => $value)
            {{$key.'='."$value"}}
        @endforeach
        @endif
    >
    {!! $errors->first($name, '<div class="invalid-feedback">:message</div>') !!}
    
</div>