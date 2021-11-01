<div class="form-group  {{ $errors->has($name) ? 'has-danger' : ''}}">
    <label for="{{$id}}">
        {!! $label !!}        
        @if ( !empty($required) )
            <span class="required-text-block">Required</span>
        @endif
    </label>
    <textarea id="{{$id}}" 
        @if( $readOnly ) readonly="readonly" @endif
        @if( $disabled ) disabled="disabled" @endif name="{{$name}}" placeholder="{{$placeholder}}" {{ $attributes->merge(['class' => 'form-control ' . $class]) }}>{{$value}}</textarea>

    {!! $errors->first($name, '<div class="invalid-feedback d-block">:message</div>') !!}
    
</div>