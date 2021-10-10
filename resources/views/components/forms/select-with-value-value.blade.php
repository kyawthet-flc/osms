<div class="form-group {{ $errors->has($name) ? 'has-danger' : '' }}">
 
    <label for="{{ $id }}">
    {!! $label !!}        
        @if ( !empty($required) )
            <span class="required-text-block">Required</span>
        @endif
    </label> <br/>

  <select class="form-control {{ $class }}" id="{{ $id }}" name="{{ $name }}" 
        @if( $readOnly ) readonly="readonly" @endif
        @if( $disabled ) disabled="disabled" @endif>
  <option value="">{{ isset($textareaSelectLabel)? $textareaSelectLabel : 'Please Select' }}</option>
    @foreach($list as $key=>$value)
      <option 
        value="{{ $value }}"
        {{ old($name, $selected) == $value ? 'selected': '' }}>
        {!! $value !!}
      </option>
    @endforeach
  </select>

  @if($errors->has($name))
      <label class="error mt-2 text-danger">{{ $errors->first($name) }}</label>
  @endif

</div>