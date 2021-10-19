<div class="form-group {{ $errors->has($name) ? 'has-danger' : '' }}">
 
    <label for="{{ $id }}">
      {!! $label !!}        
        @if ( !empty($required) )
            <span class="required-text-block">Required</span>
        @endif
    </label><br/>

  <select {{ $attributes }} class="form-control {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" id="{{ $name }}" name="{{ $name }}" 
        @if( $readOnly ) readonly="readonly" @endif
        @if( $disabled ) disabled="disabled" @endif
        >
  <option value="">{{ $textareaSelectLabel? $textareaSelectLabel : 'Please Select' }}</option>
    @foreach($list as $key=>$value)
      <option 
        value="{!! $key !!}" {{ old($name, $selected) == $key ? "selected": "" }}>
        {!! $value !!}
      </option>
    @endforeach
  </select>

  {!! $errors->first($name, '<div class="invalid-feedback">:message</div>') !!}
  
</div>