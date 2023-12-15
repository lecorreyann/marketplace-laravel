<div class="mb-3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="{{ $id }}" name="{{ $name }}"
            value="{{ $value }}" @if (old($name) || (isset($checked) && $checked === true)) checked @endif /><label class="form-check-label"
            for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
</div>
