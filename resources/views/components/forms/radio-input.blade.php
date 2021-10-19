<div class="form-group seperate-validation-wrapper {{ $errors->has($name) ? 'has-danger' : ''}} {{$col ?? null}}"> 
    <label class="d-block" for="{{ $name }}" id="{{ $name }}">
        {!! $label !!}        
        @if ( !empty($required) )
            <span class="required-text-block">Required</span>
        @endif
    </label>

    @foreach($list as $key => $list)
    <label for="{{ $key }}">
    <input type="radio" 
        placeholder="{{$label ?? ''}}" 
        name="{{ $name }}" 
        @if( old($name,$checked) == $key) checked="checked" @endif
        id="{{ $key }}" 
        value="{{ $key }}" 
        class="{{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}"
    />
    {{ $list }}
    </label>&nbsp;&nbsp;&nbsp;
    @endforeach
    <div class="validation-msg-holder"></div>
    
    {!! $errors->first($name, '<div class="invalid-feedback">:message</div>') !!}
</div>