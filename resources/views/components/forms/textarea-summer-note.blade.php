<div class="form-group  {{ $errors->has($attributes['name']) ? 'has-danger' : ''}}">
    <label for="">
        {{ $attributes['label']  }}
    </label>
    <textarea name="{{$name}}"
              placeholder="{{ isset($attributes['placeholder']) ?? $attributes['placeholder'] }}" class="summernote-lib">
        {!! $attributes['value'] !!}
    </textarea>

    {!! $errors->first($attributes['name'], '<div class="invalid-feedback d-block">:message</div>') !!}

</div>
