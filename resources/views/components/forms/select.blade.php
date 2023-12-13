@php
    $option_key = $option_key ?? 'id';
    $option_value = $option_value ?? 'name';
@endphp
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select @class(['form-select', 'is-invalid' => $errors->has($name)]) name="{{ $name }}" id="{{ $name }}"
        @isset($required) required="{{ $required }}" @endisset>
        <option value="">Select {{ $label }}</option>
        @foreach ($options as $option)
            <option value="{{ $option[$option_key] }}"
                {{ old($name) == $option[$option_key] || (isset($value) && $option[$option_key] == $value) ? 'selected' : '' }}>
                {{ $option[$option_value] }}
            </option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
