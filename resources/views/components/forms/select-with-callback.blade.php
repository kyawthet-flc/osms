<div class="form-group {{ $errors->has($name) ? 'has-danger' : '' }}"> 
    <label for="{{ $id }}">
     {!! $label !!}        
      @if ( !empty($required) )
          <span class="required-text-block">Required</span>
      @endif
    </label> <br/>
    <select {{ $attributes }} class="form-control {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" id="{{ $name }}" name="{{ $name }}" 
          @if( $readOnly ) readonly="readonly" @endif
          @if( $disabled ) disabled="disabled" @endif>
         <option value="">{{ isset($textareaSelectLabel)? $textareaSelectLabel : 'Please Select' }}</option>
         {{ $slot }}
    </select>
  @if($errors->has($name))
      <label class="error mt-2 text-danger">{{ $errors->first($name) }}</label>
  @endif
</div>