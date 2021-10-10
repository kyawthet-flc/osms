<div class="form-group {{ $errors->has($name) ? 'has-danger' : ''}} {{$col ?? null}}"> 
<label for="{{$id}}">
        {!! $label !!}
        @if ( empty($required) )
        @else
            <span class='text-danger'>*</span>
        @endif
    </label>

    <input type="text"
        name="{{$name}}" 
        list="{{$name}}-list"
        value="{{old($name) ?? $value}}" 
        autocomplete="off"
        id="{{$name}}" 
        placeholder="{{ $placeholder }}" 
        class="form-control flexdatalist {{ $errors->has($name) ? 'is-invalid' : ''}} {{$class ?? null}}" 
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
 
  <datalist id="{{$name}}-list">
      @foreach($list as $lis)
         <option value="{!! $lis !!}">{!! $lis !!}</option> 
      @endforeach      
  </datalist>