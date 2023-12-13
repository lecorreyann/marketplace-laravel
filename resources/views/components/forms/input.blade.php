<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ isset($value) ? $value : '' }}" placeholder="" @class(['form-control', 'is-invalid' => $errors->has($name)])
        @isset($required) required="{{ $required }}" @endisset
        @isset($autocomplete) autocomplete="{{ $autocomplete }}" @endisset />
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
