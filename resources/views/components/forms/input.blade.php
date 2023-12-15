<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ isset($value) ? $value : '' }}" placeholder="" @class(['form-control', 'is-invalid' => $errors->has($name)])
        @if (isset($required) && $required) required @endif
        @isset($autocomplete) autocomplete="{{ $autocomplete }}" @endisset
        @if (isset($readonly) && $readonly) readonly @endif />
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
